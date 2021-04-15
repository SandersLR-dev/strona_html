<?php

session_start();

if((!isset($_POST['login']))||(!isset($_POST['haslo'])))
{
    header('Location: login.php');
    exit();
}

require_once "connect.php";

$polaczenie = new mysqli($host,$user,$pass,$db);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".connect_errno;
}
else
{
$login=$_POST['login'];
$haslo=$_POST['haslo'];
    
$login = htmlentities($login,ENT_QUOTES,"UTF-8");
    
    
if($result = $polaczenie->query(
    sprintf("SELECT * FROM user WHERE login='%s'",   mysqli_real_escape_string($polaczenie,$login))))
{
    $ile_userow=$result->num_rows;
    if($ile_userow>0)
    {
        $wiersz = $result->fetch_assoc(); 
        
        if(password_verify($haslo,$wiersz['Haslo']))
        {
            $_SESSION['zalogowany']=true;
            $_SESSION['user'] = $wiersz['Login'];
            $_SESSION['id']=$wiersz['UserID'];
            $_SESSION['imie']=$wiersz['Imie'];
            $_SESSION['nazwisko']=$wiersz['Nazwisko'];
            $_SESSION['rola']=$wiersz['RolaID'];
            $_SESSION['opis']=$wiersz['Opis'];
            $_SESSION['data']=$wiersz['Dataurodzenia'];

            unset($_SESSION['blad']);
            $result->free_result();


            header('Location: main.php');
        }
        else   
        {
            $_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło!</span>';
            header('Location:login.php');
        }
    }else{
        
        $_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło!</span>';
        header('Location:login.php');
        
    }
}
    
    
$polaczenie->close();
}
?>