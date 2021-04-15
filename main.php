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
try
{
    $polaczenie = new mysqli($host,$user,$pass,$db);
    if($polaczenie->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {   
        
        if($rezultat=$polaczenie->query("SELECT * FROM przedmiotyuser WHERE UserID='$id'"))
        {
            $wyniki = mysqli_fetch_all($rezultat,MYSQLI_ASSOC);
        }
        
    }
    
    
}
catch(Exception $e)
{
    echo '<span style="color:red;">Błąd serwera! </span>';
    //echo '<br/>Informacja deweloperska: '.$e;
}


?>


<html>

    <head>
        <title>Korepetycje</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
        <link rel="stylesheet" href="style.css">
        
        <style>
        .pole
            {
                border: medium solid black;
                color:red;
                float: left;
                width: 30%;
                padding: 5px;
                margin: 2px;
               
            }
            
        .sub
            {
                padding-top: 10px;
                clear: both;
                
            }
        </style>
        
    </head>
    <body>
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
        
        <!----------------------------------------------------------------------------->
        <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">Profil</h4>
         <p class="w3-center"><img src="men.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko']; ?>
            </p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?php if($_SESSION['rola']==2)
            {
                echo "Uczeń";
            }
            elseif($_SESSION['rola']==1)
            {
               echo "Nauczyciel";
            }
            else
            {
                echo "Brak roli";
            } ?> </p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['data']; ?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          
          <button onclick="location.href='spotkania.php'" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Moje spotkania</button>
          
        </div>      
      </div>
      <br>
      
      <!-- Interests --> 
      <div class="w3-card w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Przedmioty</p>
          <p>
              <?php
              foreach($wyniki as $wynik){
                $pID = htmlspecialchars($wynik["PrzedmiotID"]);
                //echo $pID;
                
                $rezultat=$polaczenie->query("SELECT * FROM przedmiot WHERE PrzedmiotID='$pID'");
                $wiersz=$rezultat->fetch_assoc();
                //echo $wiersz['Nazwa'];
                echo ' <span class="w3-tag w3-small w3-theme-d1">';
                echo  $wiersz['Nazwa'] ;
                echo '</span> ';
                
                
            }
              ?>
          </p>
        </div>
      </div>
      <br>
      
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Opis</h6>
              <p contenteditable="true" class="w3-border w3-padding"><?php echo $_SESSION['opis']; ?></p>
              
            </div>
          </div>
        </div>
      </div>
      
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="men.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        
        <h4>Jan Kowalski</h4><br>
        <hr class="w3-clear">
        <p>Świetna strona dzięki niej sporo się nauczyłem i dziś mogę uczyć innych. Polecam każdemu. Dzielcie się swoją wiedzą. Uczcie innych.</p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
              <img src="zaba.jpg" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
              <img src="zaba.jpg" style="width:100%" alt="Nature" class="w3-margin-bottom">
          </div>
        </div>
        
      </div>
      
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="men.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        
        <h4>Michał Nowak</h4><br>
        <hr class="w3-clear">
        <p>“Sama wiedza nie wystarczy, trzeba jeszcze umieć ją stosować.” Johann Wolfgang Goethe</p>
       
      </div>  

      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="men.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        
        <h4>Adam Polak</h4><br>
        <hr class="w3-clear">
        
        <img src="zaba.jpg" style="width:100%" class="w3-margin-bottom">
        <p>“Ucz się tak, jakbyś niczego jeszcze nie osiągnął, i lękaj się, byś nie stracił tego, co już osiągnąłeś.” Konfuncjusz</p>
        
      </div> 
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Nadchodzące wydarzenie:</p>
          <img src="las.jpg" alt="Forest" style="width:100%;">
          <p><strong>Sesja</strong></p>
          <p>Luty 2021</p>
          
        </div>
      </div>
      <br>
      
      
      <br>
      
      <br>
      
      
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
        
        

        <!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Dominik Snopek 2020</h5>
</footer>
        

    </body>
</html>