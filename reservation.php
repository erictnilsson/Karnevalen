<?php include('header.html'); ?>
<body>
    <?php 
    include('nav.html');
    include('aside.php');

    function renderForm($event_id, $firstname, $surname, $email, $show_title, $date, $no_seatings, $address, $av_seats, $error){ ?>
        <?php 
        // if errors, display them
        if ($error !='') {
            echo '<div class="alert alert-danger"><strong>Error: </strong>'.$error.'</div>'; 
        }
        ?>
        <form action="" id="formfield" method="post">
            <div class="container">
                <div class="form-group">
                    <label for="usr">Förnamn*</label>
                    <input type="text" class="form-control" name="firstname"value="<?php echo $firstname?>"/>
                </div>
                <div class="form-group">
                    <label for="usr">Efternamn*</label>
                    <input type="text" class="form-control" name="surname"value="<?php echo $surname?>"/>
                </div>
                <div class="form-group">
                    <label for="usr">Email*</label>
                    <input type="text" class="form-control" name="email"value="<?php echo $email?>"/>
                </div>
            </div>

            <div class="container">
            <!-- Hidden field (as it is not a user input) with av_seats-->
                <input type="hidden" name="av_seats" value=<?php echo $av_seats?>>

                <div class="form-group">
                    <label for="usr">Evenemang</label>
                    <input type="text" class="form-control" name="show_title"value="<?php echo $show_title?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="usr">Datum</label>
                    <input type="text" class="form-control" name="date" value="<?php echo $date?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="usr">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $address?>" readonly/>
                </div>
            </div>

            <div class="container">
                <div class="form-group">
                    <label for="usr">Antal biljetter</label>
                    <input type="text" class="form-control" name="no_tickets" value="<?php echo $no_tickets = 1?>"/>
                    <?php 
                        if($av_seats < 25) {
                            echo '<span class="label label-warning">Biljetter kvar: '.$av_seats.'</span>'; 
                        } else {
                            echo '<span class="label label-success">Biljetter kvar: '.$av_seats.'</span>'; 
                        }
                    ?>
                </div>
            </div>

            <div class="container">
                <input type="submit" name="submit" class="btn btn-primary" value="Reservera">
                <a href="view_events.php" class="btn btn-default" role="button">Avbryt</a>
                </div>
        </form>
</body>

<?php 
    }
    //connect to DB
    include('./connection/config.php'); 

    //check if the form has been submitted. If true, process the form and save to DB
    if(isset($_POST['submit'])) {
        // set all variables using real_escape_string to protect the query
        $event_id = $_GET['event_id']; 
        $email= mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
        $firstname= mysqli_real_escape_string($conn, htmlspecialchars($_POST['firstname'])); 
        $surname= mysqli_real_escape_string($conn, htmlspecialchars($_POST['surname'])); 
        $show_title= mysqli_real_escape_string($conn, htmlspecialchars($_POST['show_title']));
        $address= mysqli_real_escape_string($conn, htmlspecialchars($_POST['address']));
        $date= mysqli_real_escape_string($conn, htmlspecialchars($_POST['date']));
        $no_tickets = mysqli_real_escape_string($conn, htmlspecialchars($_POST['no_tickets'])); 
        $av_seats = mysqli_real_escape_string($conn, htmlspecialchars($_POST['av_seats']));

        // make sure no_tickets is an integer as it is used arithmetically 
        settype($no_tickets, "integer"); 

        //check all required fields
        if ($firstname == '' || $surname == '' || $email == '' || $no_tickets == '') {
            $error = 'Fyll i alla stjärnmarkerade fält'; 
            renderForm($event_id, $firstname, $surname, $email, $show_title, $date, $no_seatings, $address, $av_seats, $error);
        
        // check the number of tickets entered
        } else if ($no_tickets < 1 || $no_tickets > $av_seats) {
            $error = 'Ange rätt mängd biljetter'; 
            renderForm($event_id, $firstname, $surname, $email, $show_title, $date, $no_seatings, $address, $av_seats, $error);
        
        // If everything is OK and validated
        } else {
            // create the amount of tickets entered
            for($i = 0; $i < $no_tickets; $i++) {
                $sql = "INSERT INTO Reservation(first_name, surname, email, event_id) VALUES('$firstname', '$surname', '$email', $event_id);"; 
                if(!mysqli_query($conn, $sql)) {
                    die('Error: '.mysqli_error($conn)); 
                }
            }
            // if the query was OK, prepare receipt by getting the reservation/ticket IDs 
            $result = mysqli_query($conn, "SELECT id FROM Reservation WHERE email='$email' AND event_id=$event_id;")
            or die(mysqli_error()); 
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $tickets .= ", " . $row['id'];  
                }
            }
    
            // close the connection as it is not used anymore
            mysqli_close(); 


            // once stored: 
            // mail the receipt to the entered email
            mailReceipt($email, $firstname, $surname, $show_title, $date, $address, $no_tickets, $tickets); 
            // and alert the user that everything is processed and OK
            alert("Tack för din reservation. Kvittot har skickats till din mailadress: $email.");     
        } 


    } else {
        // if the form hasn't been submitted, get the data from the DB and display the form
        // get the id from the URL (if it exists), making sure that it is valid and numeric
        if (isset($_GET['event_id']) && is_numeric($_GET['event_id'])) {
            //query DB
            $event_id = $_GET['event_id']; 
            $sql = "SELECT e.*, 
                        (SELECT COUNT(*) 
                         FROM Reservation r
                         WHERE e.id = r.event_id) AS count
                    FROM `event` e WHERE e.id=$event_id;"; 

            $result = mysqli_query($conn, $sql)
            or die(mysqli_error());
            $row = mysqli_fetch_array($result); 

            // set all variables
            if ($row) {
                $event_id = $row['id'];
                $show_title = $row['show_title']; 
                $date = $row['date']; 
                $no_seatings = $row['no_seatings']; 
                $address = $row['address']; 
                $av_seats = $no_seatings - $row['count']; 
                //and render form
                renderForm($event_id, '', '', '', $show_title, $date, $no_seatings, $address, $av_seats, '');

        } else {
            // if nothing turned up
            echo "No Result!"; // handle better
        } 
    } else {
        // if the GET isnt valid
        echo "ERROR"; // handle better
    }
}

// alert function: calling the JS alert function, displaying message
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');
    window.location.href='view_events.php'; 
    </script>";
}

// mail function for receipt
function mailReceipt($to, $firstname, $surname, $event, $date, $address, $no_tickets, $tickets){
    $subject="Reservationskvitto för $event";
    
    $msg = "Kvitto för $firstname $surname: \n
            Förnamn: $firstname \n
            Efternamn: $surname \n
            Evenemang: $event \n
            Datum: $date \n
            Address: $address \n
            Antal biljetter: $no_tickets \n
            Biljett-id: $tickets \n"; 

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70); 

    // send email
    mail($to, $subject, $msg);
}

require('footer.php'); 
?>
                