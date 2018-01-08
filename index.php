<?php require('header.html'); ?>
<style>

  @keyframes slidy {
  0% { left: 0%; }
  20% { left: 0%; }
  25% { left: -100%; }
  45% { left: -100%; }
  50% { left: -200%; }
  70% { left: -200%; }
  75% { left: -300%; }
  95% { left: -300%; }
  100% { left: -400%; }
  }
  
  body { margin: 0; }
  
  
  div#slider { 
      width: 100%;
      overflow: hidden;
      padding-top: 10px;
      margin-left: 1rem;
    
  }
  
  div#slider figure img{ 
      width: 20%; float: left; 
  }
  div#slider figure{ 
    position: relative;
    width: 500%;
    margin: 0;
    left: 0;
    text-align: left;
    font-size: 0;
    animation: 30s slidy infinite linear; 
  }
  
  </style>
<body>
    <!-- navbar -->
    <?php require('nav.html'); ?>
    <style type="text/css">
    
    .jumbotron{

	  background: url("img/Karneval2010031.jpg") center center no-repeat;
    background-size: cover;
    color: white;
              }
    </style>

    <div class="container">
        <div class="jumbotron text-center">
            <h1>Lundakarnevalen 2018</h1>
            <p>Välkomna till Lundakarnevalen 2018 hemsida</p>
        </div>
    </div>
    <?php include('aside.php');?>
    <?php include('section.html');?>
    <div class="main">
        <div class="row col-sm-4">
            <h2 align="center">Nyheter</h2>
                <div class="col-sm-12">
                    <div class="card" style="padding-left: 40px">
                        <img class="card-img-top" src="img/Karnevalen2018Poster.jpg" alt="Card image cap" style="padding-top: 10px">
                        <h4 class="card-title">Affischen för Lundakarnevalen är släppt!</h4>
                        <p class="card-text"> Affischen valdes genom en tävling, som har varit öppen för allmänheten att skicka in bidrag till.
                                            Tävlingen startades i samband med att temat för Lundakarnevalen 2018 släpptes, vilket är Imaginalkarneval. I årets tävling kom fler bidrag in än någonsin,
                                            men i oktober lyckades karnevalskommittén unisont välja ett bidrag!</p>
                    </div>
                </div>
                     
            <div class="col-sm-12">
                <div class="card" style="padding-left: 40px">
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
    <?php require('footer.php'); ?>
</body>
   
