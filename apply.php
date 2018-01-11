
        <?php require('header.html'); ?>
        <body>
        <?php include('nav.html'); ?>

            <div class="container">
            <div class="page-header">
                <h1>Ansök</h1>    
            </div>
            <div class="col-sm-10">
                <div class="thumbnail">
                    <img src="img/Karnevalen06 43.jpg" alt="Karnevalen06 43">
                </div>
                <p>Här kan du ansöka om en funktionärsposition till Lundakarnevalen 2018</p>
                <h3>Som funktionär får du bland annat:</h3>
                <li>Ha kul!</li>
                <li>Delta i alla aktiviteter under karnevalen</li>
                <li>Röra dig fritt inom karnevalområdet</li>
                <li>Gratis mat och alkoholfri dricka</li>

                <h3>Skicka in din ansökan nedan:</h3>
            </div>
        </div>
        <?php function renderForm($firstname, $surname, $email, $phone_no, $section, $error) { ?>
            <div class="container">
                <?php 
                    // display sections
                    include('view_sections.php'); 

                    // if errors, display them
                    if ($error != '') {
                        echo '<div class="alert alert-danger"><strong>Error: </strong>'.$error.'</div>'; 
                    }
                ?>
                <form action="" method="post"> 
                    <div class="form-group">
                        <label for="usr">Förnamn*</label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo $firstname?>"/>
                    </div>
                    <div class="form-group">
                        <label for="usr">Efternamn*</label>
                        <input type="text" class="form-control" name="surname" value="<?php echo $surname?>"/>
                    </div>
                    <div class="form-group">
                        <label for="usr">Email*</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $email?>"/>
                    </div>
                    <div class="form-group">
                        <label for="usr">Telefonnummer</label>
                        <input type="text" class="form-control" name="phone_no" value="<?php echo $phone_no?>"/>
                        </div>
                        <div class="form-group">
                        <label for="usr">Sektion*</label>
                        <select class="form-control" name="section_name"/>
                            <?php 
                            include('./connection/config.php'); 
                            $sql = "SELECT * FROM Section"; 
                            $result = mysqli_query($conn, $sql)
                            or die(mysqli_error());
                    
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row['name'] == $_GET['section']){
                                        echo '<option selected>'.$row['name'].'</option>'; 
                                    } else {
                                        echo '<option>'.$row['name'].'</option>'; 
                                    }
                                }
                            }
                            mysqli_close($conn); 
                            ?>
                        </select>
                    </div>
                    <p>* Krävs </p>
                    <input type="submit" name="submit" class="btn btn-primary" value="Ansök">
                </form>
            </div>  
        </body>
        </html>
<?php  
}

//connect to database
include('./connection/config.php');

//check if form has been submitted, if true process form and save to DB
if(isset($_POST['submit'])) {
    // set all variables using real_escape_string to protect the query
    $email = $_POST['email']; 
    $firstname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['first_name'])); 
    $surname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['surname'])); 
    $phone_no = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phone_no'])); 
    $section = $_POST['section_name']; 

    //check required fields
    if ($firstname == '' || $surname == '' || $email == '' || $section == '') {
        $error = 'Fyll i alla stjärnmarkerade fält'; 
        renderForm($email, $firstname, $surname, $phone_no, $section, $error); 
    } else {
        //if everything is OK: 

        // Email admin
        mailAdmin("ericnilssont@gmail.com", $section, $firstname, $surname, $email, $phone_no); 
        //and alert user that everything is processed and OK
        alert("Thank you for your application. Your application is being processed. You will be contacted shortly by email or phone."); 
        //redirect back to WHERE??
        header("Location: view.php"); 
    }
} else {
    // if the form hasn't been submitted, display it again
    renderForm('','','','','',''); 
}

// function alert user
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

// function mail admin
function mailAdmin($to, $section, $firstname, $surname, $email, $phone_no) {
    $subject="Someone has applied to join $section!"; 
    $msg = "$firstname $surname has applied to join $section\n 
            Email: $email \n
            Phone number: $phone_no \n"; 

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70); 

    // send email
    mail($to, $subject, $msg); 
}
require('footer.php'); 
?>