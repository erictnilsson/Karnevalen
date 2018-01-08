<?php 
    include('./connection/config.php'); 
    session_start(); 

    $user_check = $_SESSION['login_user']; 
    $sql = "SELECT username FROM Login WHERE username='$user_check'";
    $ses_result = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_assoc($ses_result); 

    $login_session = $row['username']; 

    if(!isset($login_session)) {
        mysqli_close($conn); 
        header("Location: login.php"); 
    }
?>