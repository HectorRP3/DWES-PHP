<?php
    require_once "../model/event.php";
    require_once "../model/specie.php";
    require_once "./EnterController.php";
    $events = Evento::GetAll();
    $species = Especie::GetAll();
    if(isset($_SESSION['Nickname'])){
        $userSuscripcion = User::checkSuscription($_SESSION['Nickname']);
    }else{
        $userSuscripcion = false;
    }
    require_once "../views/home.php";
?>