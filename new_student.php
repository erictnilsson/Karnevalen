<?php 
    function renderForm($firstname, $surname, $email, $phone_no, $section, $error) { ?>
        <?php require('header.html'); ?>
        <body>
            <div class="container">
            <h1> Registrera ny Funktionär</h1>
            <?php 
            //if errors, display them
            if ($error != '') {
                echo '<div class="alert alert-danger"><strong>Error: </strong>'.$error.'</div>'; 
            }
            ?>
            </div>
            <div class="container">
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
            <p>* Krävs </p>
            <input type="submit" name="submit" class="btn btn-primary" value="Registrera">
            <a href="view_admin.php" class="btn btn-default" role="button">Avbryt</a>
            </form>
            </div>
        </body>
        </html>
<?php
    }
//connect to DB
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
        // store form to DB
        $sql = "INSERT INTO Student VALUES('$firstname','$surname','$email', '$phone_no', '$section')"; 
        if(!mysqli_query($conn, $sql)) {
            die('Error: '.mysqli_error($conn)); 
        }

        //once stored, redirect back to view.php
        header("Location: view_admin.php"); 
    }
} else {
    // if the form hasn't been submitted, display it again
    renderForm('','','','','',''); 
}
?>