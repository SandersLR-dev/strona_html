<?php

session_start();
if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{
    header('Location: main.php');
    exit();
}





?>

<!DOCTYPE html>
<html>
<title>Korepetycje</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    
.middle
    {
        
         
        margin-left: 200px;
        margin-right: 200px;
        float: left;
        padding: 10px;
    }
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="index.php"
     class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Korepetycje</a>
  
  <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i> Zarejestruj się!!!</a>
  
  
  <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
    <img src="men.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar"> Zaloguj się!!!
  </a>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="login.php" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px;">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    
    <!-- End Left Column -->
    <!--</div>
    
    <!-- Middle Column -->

    <div class="middle" >
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Witaj!!!</h6>
              <p contenteditable="true" class="w3-border w3-padding">
                  <?php 
                  if((isset($_SESSION['udanarejestracja'])))
                    {
                        unset($_SESSION['udanarejestracja']);
                      echo "Dziękujemy za rejestrację !!! Zaloguj się aby korzystać z serwisu !!!";
                    }
                  else
                  {
                      echo "Zarejestruj się i dołącz do tysięcy użytkowników już dziś !!!";
                  
                          }
                    ?>
                </p>
              
            </div>
          </div>
        </div>
      </div>
      
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="men.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity"></span>
        <h4>Jan Nowak</h4><br>
        <hr class="w3-clear">
        <p>Jestem bardzo zadowolony z tego serwisu. Dzięki niemu rozwinąłem skrzydła.</p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
              <img src="edukacja.png" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
              
          </div>
        </div>
        
         
      </div>
      
     
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Dominik Snopek 2020</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p></p>
</footer>
 

</body>
</html> 
