<?php 
       include('header.html'); 
       include('nav.html'); 
       // connect
        include('./connection/config.php'); 

        if (!empty($_GET['show'])) {
            $sql = "SELECT e.*, 
            (SELECT COUNT(*) 
             FROM Reservation r
             WHERE e.id = r.event_id) AS Count
        FROM `event` e 
        WHERE e.date > NOW()
        AND e.show_title = '".$_GET['show']."'   
        ORDER BY date ASC";  
        } else {
            $sql = "SELECT e.*, 
                        (SELECT COUNT(*) 
                         FROM Reservation r
                         WHERE e.id = r.event_id) AS Count
                    FROM `event` e 
                    WHERE date > NOW() 
                    ORDER BY date ASC"; 
        }
       
        // get
        $result = mysqli_query($conn, $sql)
        or die(mysqli_error());  

        // display
    ?>
    <div class="container">
        <?php 
            if(!empty($_GET['show'])) {
                echo '<h2> Kommande föreställningar för '.$_GET['show'].'</h2>';
            } else {
                echo '<h2> Kommande föreställningar </h2>';
            }
        ?>
        <div class="panel-group">
            <?php 
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // echo result
                    $av_seats = $row['no_seatings'] - $row['Count']; 
                    echo '<div class="panel panel-default">';
                        echo '<div class="panel-heading">';
                            echo '<h3>'.$row['show_title'].'</h3>'; 
                            echo '<h5>'.$row['date'].'</h5>'; 
                        echo '</div>'; 
                        echo '<div class="panel-body">';
                            echo '<p> Totalt antal platser: '.$row['no_seatings'].'</p>'; 
                            echo '<p> Platser kvar: '.$av_seats.'</p>'; 
                            if($av_seats < 1) {
                                echo '<button type="button" class="btn btn-danger" disabled>Fullbokat</button>';
                            } else {
                                echo '<a href="reservation.php?event_id='.$row['id'].'" class="btn btn-success" role="button">Reservera</a>';
                            }
                        echo '</div>'; 
                        echo '<div class="panel-footer">'; 
                            echo '<p> Address: '.$row['address'].'</p>'; 
                        echo '</div>';  
                    echo '</div>'; 
                }
            }
            include('footer.php'); 
            ?> 
        </div>
    </div>