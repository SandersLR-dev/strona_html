<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
}

    
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
        $imie=$_POST['imie'];
        $nazwisko=$_POST['nazwisko'];
        $opis=$_POST['opis'];  
        $id = $_SESSION['id'];
        $data = $_POST['data'];
        
        if($polaczenie->query("UPDATE user SET Imie ='$imie', Nazwisko ='$nazwisko', Opis ='$opis',Dataurodzenia='$data' WHERE UserID='$id'"))
        {
            $_SESSION['zmienionodane']=true;
            $_SESSION['opis']=$opis;
            $_SESSION['imie']=$imie;
            $_SESSION['nazwisko']=$nazwisko;
            $_SESSION['id']=$id;
            $_SESSION['data']=$data;
            
            header('Location: main.php');
        }
        else
        {
            throw new Exception($polaczenie->error);
        }
        
        
        $polaczenie->close();
    }
}
catch(Exception $e)
{
    echo '<span style="color:red;">Błąd serwera! </span>';
    echo '<br/>Informacja deweloperska: '.$e;
}
    

  
    

?>