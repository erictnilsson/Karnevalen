<?php 
    require('session.php'); 
    require('header.html'); 
    require('nav.html'); 
?>
<body>

    <style type="text/css">
        
        .jumbotron{
            background-color: #5557cb;
            background-size: cover;
            color: white;
        }
    </style>


    <!-- Jumbotron -->
    <div class="container"> 
        <div class="jumbotron text-center">
            <h1>Admin-vy för '<?php echo $login_session ?>' </h1>
        </div>
    </div>

    <?php
    include('view_sections.php');
    // connect
    include('./connection/config.php'); 
    $sql = "SELECT * FROM Student"; 
    
    // get
    $result = mysqli_query($conn, $sql)
    or die(mysqli_error()); 

    // display
    ?>
    <div class="container">
        <h2>Funktionärer</h2>
        <div class="table-responsive">
            <table id ="studentTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>Förnamn</th>
                        <th>Efternamn</th>
                        <th>Emailadress</th>
                        <th>Telefonnummer</th>
                        <th>Tillhörande Sektion</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // echo result
                            echo '<tr>'; 
                            echo '<td>' . $row['first_name'] . '</td>';
                            echo '<td>' . $row['surname'] . '</td>'; 
                            echo '<td>' . $row['email'] . '</td>'; 
                            echo '<td>' . $row['phone_no'] . '</td>';  
                            echo '<td>' . $row['section_name'] . '</td>'; 
                            echo '<td> <a href="edit_student.php?email='.$row['email'].'" class="btn btn-default" role="button">Ändra</a>
                                       <a href="delete_student.php?email='.$row['email'].'" class="btn btn-danger" role="button">Ta bort</a> </td>'; 
                            echo '</tr>'; 
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
        <div class="container"> 
            <a href="new_student.php" class="btn btn-primary" role="button">Registrera funktionär</a>
            <a href="admin_mail.php" class="btn btn-primary" role="button">Skicka mail</a>
            <a href="logout.php" class="btn btn-warning" role="button">Logga ut</a>
        </div>

        <?php require('footer.php'); ?>
</body>
