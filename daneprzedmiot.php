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
        $bt=$_POST['bt'];
        $przedmiot=$_POST['przedmioty'];
        $id = $_SESSION['id'];
        
        $rezultat = $polaczenie->query("SELECT * FROM przedmiotyuser WHERE PrzedmiotID='$przedmiot' and UserID = '$id'");
        
        if(!$rezultat)throw new Exception($polaczenie->error);
             
        $liczba = $rezultat->num_rows;
        
        if($bt==1)
        {
        if($liczba==0)
        {
        if($polaczenie->query("INSERT INTO przedmiotyuser ( PrzedmiotID , UserID ) VALUES ('$przedmiot','$id')"))
        {
            $_SESSION['zmienionodane']=true;
            $_SESSION['id']=$id;
            
            header('Location: main.php');
        }
        else
        {
            throw new Exception($polaczenie->error);
        }
        }
        else{
            header('Location: main.php');
        }
        
        $polaczenie->close();
        }
        else
        {
           if($liczba!=0)
           {
               if($polaczenie->query("DELETE FROM przedmiotyuser WHERE UserID='$id' AND PrzedmiotID='$przedmiot'"))
                   
            {
            $_SESSION['zmienionodane']=true;
            $_SESSION['id']=$id;
            
            header('Location: main.php');
        }
        else
        {
            throw new Exception($polaczenie->error);
        }
        }
        else{
            header('Location: main.php');
        }
        
        $polaczenie->close();
        }
    }
    
    
}
catch(Exception $e)
{
    echo '<span style="color:red;">Błąd serwera! </span>';
    echo '<br/>Informacja deweloperska: '.$e;
}
    

  
    

?>