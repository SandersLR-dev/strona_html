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

<!DOCTYPE HTML>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rejestracja</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="style.css">
        <style>
        .error
            {
                color:red;
                margin-top:10px;
                margin-bottom:10px;
            }
        </style>
    </head>
    <body>
        <div id= "container">
        <div id ="logo">
            <h1>Rejestracja</h1>
        </div>
            
        <div id="content_login">
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
        <div id ="footer_login">
            Dominik Snopek 2020
            
        </div>
        
        </div>
    </body>
</html>