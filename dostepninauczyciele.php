<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
}

require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);
$id = $_SESSION['id'];

$przedmiot = $_POST['przedmiot'];
$_SESSION['wybranyprzedmiot']=$przedmiot;
try
{
    $polaczenie = new mysqli($host,$user,$pass,$db);
    if($polaczenie->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {   
        
        if($rezultat=$polaczenie->query("SELECT * FROM przedmiotyuser WHERE PrzedmiotID='$przedmiot'"))
        {
            $wyniki = mysqli_fetch_all($rezultat,MYSQLI_ASSOC);
        }
        
        if($rezultat=$polaczenie->query("SELECT * FROM przedmiot WHERE PrzedmiotID='$przedmiot'"))
        {
            $wybranyprzedmiot = $rezultat->fetch_assoc();
        }
        
        
    }
    
    
}
catch(Exception $e)
{
    echo '<span style="color:red;">Błąd serwera! </span>';
    //echo '<br/>Informacja deweloperska: '.$e;
}


?>

<!DOCTYPE html>
<html>
<title>Wybierz przedmiot</title>
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
        
        margin-right: 15%;
        margin-left: 15%;
        padding: 10px;
        
    }
    
.blok
    {
        margin: 1%;
        float:left;
        width: 23%;
        height: 300px;
        background-color: white;
        border-radius: 10px;
        border: 1px solid black;
        display: block;
        
        
        
    }
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
             <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
              <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
              <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Korepetycje</a>
              <a href="dostepneprzedmioty.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
              <a href="profil.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
              <a href="przedmiot.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
<!--
              <div class="w3-dropdown-hover w3-hide-small">
                <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></button>     
                <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                  <a href="#" class="w3-bar-item w3-button">One new friend request</a>
                  <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
                  <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
                </div>
              </div>
-->
              <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Log out">
                <img src="men.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
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

    <div class="middle">
        <div class="w3-container">
         <h4 class="w3-center"><?php echo $wybranyprzedmiot['Nazwa']; ?></h4>
         <p class="w3-center"><img src="nauka.jpg" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
        <h4 class="w3-center">Nauczyciele</h4>
            </div>
        
                <?php
                
                foreach($wyniki as $wynik){
                
                $nID = htmlspecialchars($wynik['UserID']);
                    
                $rezultat=$polaczenie->query("SELECT * FROM user WHERE UserID='$nID'");
                $wiersz=$rezultat->fetch_assoc();
                
                if($wiersz['RolaID']==1)
                {    
                echo '<div class="blok" >';
                    echo '<p class="w3-center"><img src="nauka.jpg"  class="w3-circle  w3-border-black" style="height:60px;width:60px;border:1px solid black" alt="Avatar"></p>';
                   echo '<h6  class="w3-center" class="w3-border w3-padding">';
                   echo $wiersz['Imie']." ".$wiersz['Nazwisko'];
                   echo '</h6>';
                    echo '<p class="w3-center" class="w3-border w3-padding">';
                   echo $wiersz['Opis'];
                   echo '</p>';
                   echo '<form method="post" action="korepetycje.php">';
                   echo '<div class="w3-center">';
                    echo'<button type="submit" name="naucz" value='.$wiersz['UserID'].' class="w3-button w3-theme w3-round-xlarge "><i ></i> Wybierz</button> ';
                   echo '</div>';
                   echo '</form>';       
                echo '</div>';
                }
                }
                ?>
            
          
        
    </div>
      <!--<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="men.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity"></span>
        <h4>Jacek Sasin</h4><br>
        <hr class="w3-clear">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
              <img src="edukacja.png" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
              
          </div>
        </div>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
         
      </div>
      
     
      
    <!-- End Right Column -->
    
    
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
