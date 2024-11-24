<?php
    require_once "../model/event.php";
    require_once "../model/user.php";
    session_start();
if(isset($_SESSION['Nickname'])){
    $evetoID = $_GET['event'];
    $karma = User::getKarma($_SESSION['Nickname']);
    $karma = $karma + 5;

    if(Evento::checkParticipacion($_SESSION['Nickname'],$evetoID)){
        header("location:./HomeController.php");
    }else{
        Evento::participarEvento($_SESSION['Nickname'],$evetoID);
        User::updateKarma($_SESSION['Nickname'],$karma);
        header("location:./HomeController.php");
    }
}else{
    header("location:./HomeController.php");
}
    
?>