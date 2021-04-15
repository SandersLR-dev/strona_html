<?php
    
    session_start();

    if(isset($_POST['email']))
    {
        $OK=true;
        //sprawdzenie nicka
        $nick = $_POST['login'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $rola = $_POST['funkcja'];
        //dlugosc nicka
        if((strlen($nick)<3) || (strlen($nick)>30))
        {
            $OK=false;
            $_SESSION['e_nick']="Login musi posiadac od 3 do 30 znakow";
        }
        
        if(ctype_alnum($nick)==false)
        {
            $OK = false;
            $_SESSION['e_nick']= "Login może składać sie tylko z liter i cyfr";
        }
        
        //Sprawdzanie email
        $email=$_POST['email'];
        $emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
        
        if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false)||($email!=$emailB))
        {
            $OK = false;
            $_SESSION['e_email']="Podaj poprawny adres";
        }
        
        //Sprawdzanie hasła
        
        $haslo1 = $_POST['haslo'];
        $haslo2 = $_POST['haslo2'];
        
        if((strlen($haslo1)<4)||(strlen($haslo1)>20))
        {
             $OK = false;
            $_SESSION['e_haslo']="haslo musi posiadac od 4 do 20 znakow";
        }
        
        if($haslo1!=$haslo2)
        {
            $OK = false;
            $_SESSION['e_haslo']="Podane hasla nie sa identyczne";
        }
        
        $haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);
        
            $_SESSION['fr_nick'] = $nick;
            $_SESSION['fr_email'] = $email;
            $_SESSION['fr_haslo1'] = $haslo1;
            $_SESSION['fr_haslo2'] = $haslo2;
        
        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        try
        {
            $polaczenie = new mysqli($host,$user,$pass,$db);
            if($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                //czy email juz istnieje?
                $rezultat = $polaczenie->query("SELECT * FROM user WHERE email='$email'");
                
                if(!$rezultat)throw new Exception($polaczenie->error);
                
                if($rezultat->num_rows>0)
                {
                    $OK=false;
                    $_SESSION['e_email']="Istnieje już takie konto";
                }
                
                //czy login juz istnieje?
                $rezultat = $polaczenie->query("SELECT * FROM user WHERE Login='$nick'");
                
                if(!$rezultat)throw new Exception($polaczenie->error);
                
                $liczbanickow = $rezultat->num_rows;
                if($liczbanickow>0)
                {
                    $OK=false;
                    $_SESSION['e_nick']="Istnieje już taki nick";
                }
                
                if($OK == true)
                {
                    //echo "Udana walidacja";exit();
                    
                    if($polaczenie->query("INSERT INTO user (login,haslo,imie,nazwisko,email,rolaid) VALUES ('$nick','$haslo_hash','$imie','$nazwisko','$email','$rola')"))
                    {   
                        $rezult=$polaczenie->query("SELECT * FROM user WHERE login='$nick'");
                        $wiersz=$rezult->fetch_assoc();
                        $id=$wiersz['UserID'];
                        if($rola==2)
                        {
                            $polaczenie->query("INSERT INTO uczen (userid) VALUES ('$id')");
                        }
                        else
                        {
                            $polaczenie->query("INSERT INTO nauczyciel (userid) VALUES ('$id')");
                        }
                        $_SESSION['udanarejestracja']=true;
                        header('Location: index.php');
                    }
                    else
                    {
                        throw new Exception($polaczenie->error);
                    }
                }
                
                $polaczenie->close();
            }
        }
        catch(Exception $e)
        {
            echo '<span style="color:red;">Błąd serwera! </span>';
            echo '<br/>Informacja deweloperska: '.$e;
        }
        
    }

?>

<!DOCTYPE html>
<html>
<title>Logowanie</title>
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
        
         
        margin-left:480px;
        margin-right: 400px;
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
        <div class="w3-container">
         <h4 class="w3-center">Rejestracja</h4>
         <p class="w3-center"><img src="men.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
            </div>
        
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
                
              <h6 class="w3-center" class="w3-border w3-padding">Witaj!!!</h6>
              
                <form method="post" action="register.php">
            
            
            
            <label>Login<br/> <input name="login" type="text"></label><br/>
            
            <?php
                if(isset($_SESSION['e_nick']))
                {
                    echo '<div class = "error">'.$_SESSION['e_nick'].'</div>';
                    unset($_SESSION['e_nick']);
                }
            ?>
            
            <label>E-mail<br/><input name="email" type="text"></label><br/>
            
            <?php
                if(isset($_SESSION['e_email']))
                {
                    echo '<div class = "error">'.$_SESSION['e_email'].'</div>';
                    unset($_SESSION['e_email']);
                }
            ?>
            
            <label>Hasło<br/><input name="haslo" type="password"></label><br/>
            
             <?php
                if(isset($_SESSION['e_haslo']))
                {
                    echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
                    unset($_SESSION['e_haslo']);
                }
            ?>
            
            <label>Powtórz hasło <br/><input name="haslo2" type="password"></label><br/>
            
            
            <label>Imię <br/><input name="imie" type="text"></label><br/>
            <label>Nazwisko <br/><input name="nazwisko" type="text"></label><br/>
            <label>Wybierz funkcje: </label><br/>
            
            <input type="radio" name="funkcja" value="1">Nauczyciel<br/>
            <input type="radio" name="funkcja" value="2" checked>Uczen
            
            <br/><br/>
            <input type="submit" name="register" class="w3-button w3-theme" value="Zarejestruj" />
            
        </form>
                
            </div>
          </div>
        </div>
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
