<?php
   
    require_once '../model/event.php';
    require_once '../model/specie.php';
    require_once '../model/user.php';
    //Listar Eventos
    $events = Evento::getAllEvent();
    //Listar Species
    $species = Especie::getAllSpecie();
    //Chekear si esta suscrito
    session_start();
    if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])){
        $suscripcion = User::checkSuscription($_SESSION['nickname']);  
        $karma = User::getKarma($_SESSION['nickname']);
    }else{
        $suscripcion=false;
    }
    require_once (__DIR__).'/../views/home.php';
?>