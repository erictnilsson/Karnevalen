<?php 
    require('header.html'); 
?>
<body>
    <?php 
        require('nav.html'); 
        // connect
        include('./connection/config.php'); 
        $sql = "SELECT * FROM `Show`"; 

        // get
        $result = mysqli_query($conn, $sql)
        or die(mysqli_error()); 

        // display
    ?> 
    <div class="container">
        <h2> Evenemang </h2>
        <div class="panel-group">
            <?php 
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // echo result
                    echo '<div class="panel panel-default">';
                        echo '<div class="panel-heading">';
                            echo '<h3>'.$row['title'].'</h3>'; 
                        echo '</div>'; 
                        echo '<div class="panel-body">';
                            echo '<img src="'.$row['img'].'"width=1080px height=500px/>'; 
                            echo '<p>'.$row['description'].'</p>'; 
                        echo '</div>';  
                        echo '<div class="panel-footer">'; 
                            echo '<a href="view_events.php?show='.$row['title'].'" class="btn btn-default role="button">Reservera</a>'; 
                        echo '</div>'; 
                    echo '</div>'; 
                }
            }
            ?> 
        </div>
    </div>
    <?php 
        //include('view_events.php');
        include('footer.php'); 
     ?>
</body>