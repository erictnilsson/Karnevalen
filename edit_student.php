<?php
function renderForm($email, $firstname, $surname, $phone_no, $section, $error) { 
    include('header.html');?>
<body>
    <?php 
    //if errors, display them
    if ($error !='') {
        echo '<div class="alert alert-danger"><strong>Error: </strong>'.$error.'</div>'; 
    }
    ?>
    <form action="" method="post">
    <div class="container">
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
        <input type="text" class="form-control" name="email" value="<?php echo $email?>" readonly/>
    </div>
    <div class="form-group">
        <label for="usr">Telefonnummer</label>
        <input type="text" class="form-control" name="phone_no" value="<?php echo $phone_no?>"/>
        </div>
    <div class="form-group">
        <label for="usr">Tillhörande Sektion*</label>
        <select class="form-control" name="section_name"/>
            <?php 
            include('./connection/config.php'); 
            $sql = "SELECT * FROM Section"; 
            $result = mysqli_query($conn, $sql)
            or die(mysqli_error());
    
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['name'] == $section) {
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
    <p>* Required </p>
    <input type="submit" name="submit" class="btn btn-primary" value="Ändra">
    <a href="view.php" class="btn btn-default" role="button">Avbryt</a>
    </form>
    </div>
</body>
</html>
<?php
} 

// connect to DB
include('./connection/config.php'); 

//check if the form has been submitted. If true, process the form and save to DB
if(isset($_POST['submit'])) {
    $email = $_POST['email']; 
    $firstname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['first_name'])); 
    $surname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['surname'])); 
    $phone_no = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phone_no'])); 
    $section = $_POST['section_name']; 

    //check required fields
    if ($firstname == '' || $surname == '' || $email == '' || $section == '') {
        $error = 'Please fill in all required fields'; 
        renderForm($email, $firstname, $surname, $phone_no, $section, $error); 
    } else {
        // store form to DB
        $sql = "UPDATE Student SET first_name='$firstname', surname ='$surname', phone_no ='$phone_no', section_name='$section' WHERE email='$email';"; 
        if(!mysqli_query($conn, $sql)) {
            die('Error: '.mysqli_error($conn)); 
        }

        //once stored, redirect back to view.php
        header("Location: view_admin.php"); 
    }
} else {
    // if the form hasn't been submitted, get the data from the DB and display the form
    // get the email from the URL (if it exists), making sure that it is valid
    if (isset($_GET['email']) && $_GET['email'] != '') {
         
        // query DB
        $email = $_GET['email']; 
        $sql = "SELECT * FROM Student WHERE email='$email'"; 
        $result = mysqli_query($conn, $sql)
        or die(mysqli_error());
        $row = mysqli_fetch_array($result); 

        if ($row) {
            $email = $row['email'];
            $firstname = $row['first_name'];  
            $surname = $row['surname']; 
            $phone_no = $row['phone_no']; 
            $section = $row['section_name'];
            //display form
            renderForm($email, $firstname, $surname, $phone_no, $section, ''); 
        } else {
            echo "No Result!"; 
        } 
    } else {
        // if the email in URL isnt valid, display error
       echo "ERROR"; 
    }
}
?>
