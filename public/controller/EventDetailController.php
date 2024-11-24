<?php
    require_once "../model/event.php";
    $evento = Evento::getEventoById($_GET['event']);

    require_once "../views/eventDetail.php";

?>