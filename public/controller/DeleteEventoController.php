<?php
    $eventID = $_GET['event'];
    require_once "../model/event.php";
    Evento::deleteEvent($eventID);
    header("location:./HomeController.php");
?>