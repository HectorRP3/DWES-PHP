<?php
    session_start();
    require_once "../model/event.php";
    require_once "../model/user.php";
    require_once "../model/specie.php";

    $especie = Especie::getEspecieMasParticipacion();
    $usuario = User::getUsuarioMasKarma();
    $evento = Evento::getEventoMasParticipacion();

    $eventoCompleto = Evento::getEventoById($evento['EventoID']);
    require_once '../views/logros.php';
?>