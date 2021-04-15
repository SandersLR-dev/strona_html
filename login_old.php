<?php

session_start();
if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{
    header('Location: main.php');
    exit();
}

?>


<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Logowanie</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="container">
            <div id ="logo">
            <h1>Logowanie</h1>
            </div>
            
            <div id="content_login">
            <form method="post" action="logowanie.php">
                Login<br/>
                <label><input name="login" type="text" ></label><br/>
                Hasło<br/>
                <label> <input name="haslo" type="password"></label><br/><br/>
                <button type="submit" name="zaloguj">Zaloguj</button>
            </form>
        
            <?php
        
            if(isset($_SESSION['blad']))
            echo $_SESSION['blad'];
    
            ?>
            </div>
            <div id = "footer_login">
                Dominik Snopek 2020
            </div>
        </div>
        
    </body>
</html>