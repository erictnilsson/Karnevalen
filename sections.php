<?php 
    require('header.html'); 
?>
<body>
    <?php require('nav.html'); ?>

    <div class="container">
        <div class="page-header">
            <h1>Sektioner</h1>
        </div>
        <div class="container">
            <div class="thumbnail">
                <img src="img/Karnevalen06 47.jpg" alt="Karnevalen06 43">
            </div>
            <p>Nedan följer en lista på de olika sektionerna som är aktiva under Lundakarnevalen 2018. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto molestiae ratione aspernatur enim quibusdam laudantium voluptatum, mollitia itaque exercitationem facilis laborum tempora molestias modi sunt porro minus incidunt expedita vitae.</p>
            <h3>Sektionerna är:</h3>
        </div>
    </div>

    <?php 
        // connect
        include('./connection/config.php'); 

        if(!empty($_GET['section'])) {
            $sql = "SELECT * 
                    FROM Section 
                    WHERE name ='".$_GET['section']."';"; 
        } else {
            $sql = "SELECT * 
                    FROM Section;"; 
        }

        // get
        $result = mysqli_query($conn, $sql)
        or die(mysqli_error()); 

        // display
    ?>
    <div class="container">
        <?php 
            if(!empty($_GET['section'])) {
                echo '<h2>'.$_GET['section'].'</h2>';
            }
        ?>
    <div class="panel-group">
    <?php 
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // echo result
                echo '<div class="panel panel-default">';
                    echo '<div class="panel-heading">';
                        echo '<h1>'.$row['name'].'</h1>'; 
                    echo '</div>'; 
                    echo '<div class="panel-body">';
                        echo '<p>'.$row['description'].'</p>'; 
                    echo '</div>'; 
                    echo '<div class="panel-footer">'; 
                        echo '<p> Totalt antal platser: '.$row['capacity'].'</p>'; 
                        echo '<a href="apply.php?section='.$row['name'].'" class="btn btn-success" role="button">Ansök</a>';
                    echo '</div>';  
                echo '</div>'; 
                }
            }
            ?> 
        </div>
    </div>
    <?php require('footer.php'); ?>
</body>