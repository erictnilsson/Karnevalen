<?php require('./header.html'); ?>
<body>
    <!-- navbar -->
    <?php require('./nav.html'); ?>

    <style type="text/css">
    
    .jumbotron{
        background: url("./img/Karneval2010031.jpg") center center no-repeat;
        background-size: cover;
        color: white;
    }
    </style>


    <!-- Jumbotron -->
    <div class="container">
        <div class="jumbotron text-center"> 
            <img src="./img/logga.png" width =200px height=200px style="float:right">   
            <h1>Lundakarnevalen 2018</h1>
            <a href="./apply.php" class="btn btn-primary" role="button">Ansök till att bli Funkis</a>
        </div>
    </div>

    <?php include('./section.html');?>
    <?php include('./aside.html');?>
    <div class="main">
        <div class="row col-sm-4">
            <h2 align="center">Nyheter</h2>
            <div class="col-sm-12">
                <div class="card">
                    <!-- <img class="card-img-top" src="img/Karnevalen2018Poster.jpg" alt="Card image cap"> -->
                    <h4 class="card-title">Affischen för Lundakarnevalen är släppt!</h4>
                    <p class="card-text"> Affischen valdes genom en tävling, som har varit öppen för allmänheten att skicka in bidrag till.
                                            Tävlingen startades i samband med att temat för Lundakarnevalen 2018 släpptes, vilket är Imaginalkarneval. I årets tävling kom fler bidrag in än någonsin,
                                            men i oktober lyckades karnevalskommittén unisont välja ett bidrag!</p>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Pressinbjudan!</h4>
                        <p class="card-text"> Affischsläpp och invigning på Stortorget när Lundakarnevalen får nya kläder! LUND Torsdagen den 30 november kl 16:04.  Snart är det slut på grafisk ambivalens! Torsdagen den 30 november kl. 16:04 är det äntligen dags för Lundakarnevalen 2018 att ikläda sig sin rätta, imaginala skepnad. </p>        
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Affischen för Lundakarnevalen är släppt!</h4>
                            <p class="card-text"> Affischen valdes genom en tävling, som har varit öppen för allmänheten att skicka in bidrag till.
                                            Tävlingen startades i samband med att temat för Lundakarnevalen 2018 släpptes, vilket är Imaginalkarneval. I årets tävling kom fler bidrag in än någonsin,
                                            men i oktober lyckades karnevalskommittén unisont välja ett bidrag!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    <!-- footer -->
    <?php require('./footer.php'); ?>
</body>
   
