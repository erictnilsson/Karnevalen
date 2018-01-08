<?php 
// connect
include('./connection/config.php'); 

// check that the email is set in URL and is valid
if(isset($_GET['email']) && $_GET['email'] != '') {
    // get the PK value Email
    $email = $_GET['email']; 

    // delete the entry
    $sql = "DELETE FROM Student WHERE email='$email'";
    $result = mysqli_query($conn, $sql)
    or die(mysqli_error()); 
    
    //redirect back to the view
    header("Location: view_admin.php"); 
} else {
    // if it isn't set or it isn't valid, redirect back to view
    header("Location: view_admin.php"); 
}
?>