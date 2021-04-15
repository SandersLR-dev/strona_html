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
        
        if($rezultat=$polaczenie->query("SELECT * FROM przedmiot"))
        {
            
        }
        
    }
    
    
}
catch(Exception $e)
{
    echo '<span style="color:red;">Błąd serwera! </span>';
    echo '<br/>Informacja deweloperska: '.$e;
}




?>

<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Korepetycje</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="container">
        <div id="logo">
            
            <?php
            echo "<p>Witaj ".$_SESSION['user'].'! [<a href="logout.php">Wyloguj się!</a>]</p>';
            ?>
            <a href="main.php"><button>Profil</button></a>
        </div>
        <div id="content_login">
            
            
            <form method="post" action="daneprzedmiot.php">
            
            <label>Dodaj przedmiot</label>
            
            <select name="przedmioty">
            <?php
                
            while($wyniki = mysqli_fetch_array($rezultat))
            {
                echo'
                <option value='.$wyniki['PrzedmiotID'].'>'.$wyniki['Nazwa'].'
                </option>';
                
            }
                
            ?>
            
            </select>
            
            <br/><input type="submit" name="register" value="Dodaj" />
            
            </form>
            
        
        </div>
        <div id="footer_login">
            
        Dominik Snopek 2020
            
        </div>
        </div>

    </body>
</html>