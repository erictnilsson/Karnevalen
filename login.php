<?php
    session_start(); // starting session
    $error=''; // error variable

    if(isset($_POST['submit'])) {
        if(empty($_POST['user']) || empty($_POST['pass'])) {
            $error = "Username or Password is invalid"; 
        }  else {
        // Define username and password
        $user=$_POST['user']; 
        $pass=$_POST['pass']; 
        include('./connection/config.php'); 
    
        $sql = "SELECT * FROM Login WHERE username='$user' AND password='$pass';"; 
        $result= mysqli_query($conn, $sql); 
        
        if(mysqli_num_rows($result)>0) {
            $_SESSION['login_user']=$user; //init session
            header("Location: view_admin.php"); 
        } else {
            $error="Username or Password is invalid"; 
        }
        mysqli_close($conn); 
        }
    } 
    
    if(isset($_SESSION['login_user'])) {
        header("Location: view_admin.php"); 
    }

    require('header.html'); 
?>
    <body>
        <?php require('nav.html');?>
        <div class="container">
            <form class="form-signin" action="" method="post">       
                <h2 class="form-signin-heading">Logga in</h2>
                <input type="text" class="form-control" name="user" placeholder="Användarnamn" required="" autofocus="">
                <input type="password" class="form-control" name="pass" placeholder="Lösenord" required="">      
                <input name="submit" class="btn btn-lg btn-primary btn-block" type="submit" value="Logga in">   
                <span><?php echo $error;?></span>
            </form>
        </div>
        <?php require('footer.php');?>
    </body>
    </html>