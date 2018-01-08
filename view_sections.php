<?php 
// connect
include('./connection/config.php'); 
$sql = "SELECT s.*, 
            (SELECT COUNT(*)
             FROM Student st
             WHERE st.section_name = s.name) AS count
        FROM section s"; 
    
// get
$result = mysqli_query($conn, $sql)
or die(mysqli_error()); 

// display
?>
<div class="container">
        <h2>Sektioner</h2>
        <div class="table-responsive">
            <table id="sectionTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>Sektionsnamn</th>
                        <th>Antal Funktionärer</th>
                        <th>Maxkapacitet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            //echo result
                            echo '<tr>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['count'] . '</td>'; 
                            echo '<td>' . $row['capacity'] . '</td>';
                            echo '</tr>';                         
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>