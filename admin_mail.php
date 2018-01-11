<?php 
    require('header.html'); 
    require('nav.html'); 

    function renderForm($section, $title, $msg, $error) { 
        //if errors, display them
        if ($error !='') {
            echo '<div class="alert alert-danger"><strong>Error: </strong>'.$error.'</div>'; 
        }
?>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label for="usr">Till Sektion:</label>
                <select class="form-control" name="section_name"/>
                <?php 
                    include('./connection/config.php'); 
                    $sql = "SELECT * FROM Section"; 
                    $result = mysqli_query($conn, $sql)
                    or die(mysqli_error());
                
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '<option>'.$row['name'].'</option>'; 
                        }
                    }
                    mysqli_close($conn); 
                ?>
                </select>
        </div>

        <div class="form-group">
            <label for="usr">Title*</label>
            <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
        </div>

        <div class="form-group">
            <label for="comment">Email*</label>
            <textarea class="form-control" rows="5" name="msg" value="<?php echo $msg ?>"></textarea>
        </div>
        <p>* Krävs </p>
        <input type="submit" name="submit" class="btn btn-primary" value="Skicka">
        <a href="view_admin.php" class="btn btn-default" role="button">Avbryt</a>
    </form>
 </div>

<?php 
    } 
    require('footer.php');

    //check if the form has been submitted. If true, process the form and save to DB
    if(isset($_POST['submit'])) {
        $section = $_POST['section_name']; 
        $title = $_POST['title']; 
        $msg = $_POST['msg']; 

        //check required fields
        if ($section == '' || $title == '' || $msg == '') {
            $error = 'Fyll i alla stjärnmarkerade fält'; 
            renderForm($section, $title, $msg, $error); 
        } else {
            // email all students in section
            // connect to DB
            include('./connection/config.php'); 
            $sql = "SELECT email FROM Student WHERE section_name = '$section';"; 
            $result = mysqli_query($conn, $sql)
                    or die(mysqli_error());
                
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            admin_mail($row['email'], $title, $msg); 
                        }
                        alert("Mailet har skickats till ".$section); 
                    }
                    mysqli_close($conn); 
        }
    } else {
        // if the form hasn't been submitted, render form 
        renderForm($section, $title, $msg, '');
    }

    // alert function: calling the JS alert function, displaying message
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');
        window.location.href='view_admin.php'; 
        </script>";
    }

    // mail function
    function admin_mail($to, $title, $msg){ 
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70); 

        // send email
        mail($to, $title, $msg);
    }

?>

