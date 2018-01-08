<?php require('header.html');?>
<body>
    <?php 
        require('nav.html');
            
        // connect
        include('./connection/config.php'); 

        $sql = "SELECT * FROM Section WHERE name='biljonsen';"; 
        
        // get
        $result = mysqli_query($conn, $sql)
        or die(mysqli_error());  

        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['name']; 
                $desc = $row['description']; 
            }
        }
    ?>
    <div class="container">
        <div class="page-header">
            <h1><?php echo $title?></h1>
        </div>
    <div class="container">
        <div class="thumbnail">
            <img src="img/Karnevalen06 12.jpg" alt="Karnevalen06 12">
        </div>
        <p> <?php echo $desc ?> </p>
    </div>
    
    <?php require('footer.php'); ?>
</body>
