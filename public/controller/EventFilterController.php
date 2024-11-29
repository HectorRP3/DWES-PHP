<?php

    require_once "../model/event.php";
    require_once "../controller/ValidatorController.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = $_POST['Nombre'];
        $tipoTerreno = $_POST['TipoTerreno'];
        $tipoEvento = $_POST['TipoEvento'];

        $validate = [validateCampo($nombre)];


        if(validateCampo($nombre)){
            $nombre = cleanCampo($nombre);
        }else{
            $error = "Error en el campo nombre";
            array_push($validate, false);
        }

        if(in_array(false, $validate)){
            header("Location: ../views/eventAdd.php?error");
        }
        if($tipoTerreno == "default" || $tipoEvento == "default"){
           $eventos = Evento::getByName($nombre);
        }else if($tipoTerreno == "default"){
            $eventos = Evento::getEventByTipoEvento($nombre, $tipoEvento);
        }else if($tipoEvento == "default"){
            $eventos = Evento::getEventByTipoTerreno($nombre, $tipoTerreno);
        }else{
            $eventos = Evento::getEventByNombreAndTipo($nombre, $tipoTerreno, $tipoEvento);
        }
        require_once "../views/eventAdd.php";
    }


?>