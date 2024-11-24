<?php
    require_once "../model/event.php";
    require_once "../controller/ValidatorController.php";
    require_once "../model/user.php";
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = $_POST['Nombre'];
        $descripcion = $_POST['Descripcion'];
        $provincia = $_POST['Provincia'];
        $localidad = $_POST['Localidad'];
        $tipoTerreno = $_POST['TipoTerreno'];
        $tipoEvento = $_POST['TipoEvento'];
        $fecha = $_POST['Fecha'];
        $anfitrionID = $_SESSION['Nickname'];
        // $anfitrionID = "Juan23"; // cambiar cuando hagamos las sesiones
        $fechaAprobacion = $_POST['FechaAprobacion'];
        $especies = $_POST['especie'];
        $participantes=[];
        $Estado="Aprobado";
        $cuantasEspecies = $_POST['cantidad'];
        
        $validate = [validateCampo($nombre),
                    validateCampo($descripcion),
                    validateCampo($provincia),
                    validateCampo($localidad),
                    validateCampo($fecha),
                    validateCampo($fechaAprobacion),
                    validateCampo($especies),
                    validateInt($cuantasEspecies),
        ];
        if($especies == "default"){
            $error = "Error en la seleccion de especies";
            array_push($validate, false);
        }
        if($tipoTerreno == "default"){
            $error = "Error en la seleccion de tipo de terreno";
            array_push($validate, false);
        }
        if($tipoEvento == "default"){
            $error = "Error en la seleccion de tipo de evento";
            array_push($validate, false);
        }

        if(is_uploaded_file($_FILES['imagen']['tmp_name']) && $_FILES['imagen']['type']== 'image/png'){
            $nombreDirectorio = "../images/events/";
        
            $nombreFichero = $_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'],$nombreDirectorio.$nombreFichero);
            $imagen = $nombreDirectorio.$nombreFichero;
        }else{
            $error = "Error en la subida de la imagen";
            array_push($validate, false);
        }
        
        if(in_array(false, $validate)){
            header("Location: ../views/eventAdd.php?error");
        }

        $nombre = cleanCampo($nombre);
        $descripcion = cleanCampo($descripcion);
        $provincia = cleanCampo($provincia);
        $localidad = cleanCampo($localidad);
        $tipoTerreno = cleanCampo($tipoTerreno);
        $tipoEvento = cleanCampo($tipoEvento);
        $especies = cleanCampo($especies);

        $evento = new Evento(null,$nombre, $descripcion, $provincia, $localidad, $tipoTerreno, $tipoEvento, $fecha, $anfitrionID,$Estado,$fechaAprobacion,$participantes, $especies, $imagen);

        //añadir evento y especies   
        $evento->addEvent();
        $evento->EventoID = $evento->getID();
        $evento->addEventoSpecie($cuantasEspecies);
        $karma = User::getKarma($anfitrionID);
        $karma = $karma + 10;
        User::updateKarma($anfitrionID,$karma);
       header("Location: ./HomeController.php");
    }
    


?>