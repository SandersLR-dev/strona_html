<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
}

$godzstart=$_POST['godzstart'];
$godzkoniec=$_POST['godzkoniec'];
$data=$_POST['data'];
$opis=$_POST['opiskorepetycje'];
$przedmiot=$_SESSION['wybranyprzedmiot'];
$nauczyciel=$_SESSION['wybranynauczyciel'];
$id = $_SESSION['id'];

    
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
        
        if($polaczenie->query("INSERT INTO korepetycje ( przedmiotid , nauczycielid,uczenid,data,godzstart,godzkoniec,opis ) VALUES ('$przedmiot','$nauczyciel','$id','$data','$godzstart','$godzkoniec','$opis')"))
        {
            $_SESSION['zmienionodane']=true;
            $_SESSION['id']=$id;
            
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