<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
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
            
            
            <form method="post" action="dane.php">
            <!--<label>Login<br/> <input name="login" type="text" value="<?php //echo $_SESSION['user']; ?>"></label><br/>-->
            <label>Imię <br/><input name="imie" type="text" value="<?php echo $_SESSION['imie']; ?>"></label><br/>
            <label>Nazwisko <br/><input name="nazwisko" type="text" value="<?php echo $_SESSION['nazwisko']; ?>"></label><br/>
            <label>Data urodzenia:</label><br/>
            <input type="date" name="data" value="<?php echo $_SESSION['data']; ?>"><br/>
             
                
                Opis<br/>
            <textarea name="opis" cols="40" rows="5"><?php echo $_SESSION['opis']; ?></textarea>
            
            <br/><input type="submit" name="register" value="Zapisz" />
            
            </form>
            
        
        </div>
        <div id="footer_login">
            
        Dominik Snopek 2020
            
        </div>
        </div>

    </body>
</html>