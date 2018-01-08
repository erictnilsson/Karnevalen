<footer>
    <div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
            <div class="container">
                <div class="navbar-text pull-left">
                    <p class="text-left">© Lundakarnevalen 2018</p>  
                </div>
                <div class="navbar-text pull-right">
                    <p class="text-center" id="countdown"></p>
                </div>
            </div>
        </div>
</footer>

<?php 
include('./connection/config.php'); 

$sql = "SELECT * FROM time"; 
$result = mysqli_query($conn, $sql); 

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $end_time = $row["start_time"]; 
    } 
} else {
    echo "0 results"; 
}

mysqli_close($conn); 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
var end_time = new Date("<?php echo $end_time ?>").getTime();

var x = setInterval(function() {
    var now = new Date().getTime(); 

    var distance = end_time - now; 

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s " + " till startskottet" ;

    if (distance < 0) {
        clearInterval(x); 
        document.getElementById("countdown").innerHTML = "EXPIRED"; 
    }
}, 1000)
</script>