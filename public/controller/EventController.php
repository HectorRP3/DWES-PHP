<?php
    session_start();
    require_once '../model/specie.php';
    require_once 'validate.php';
    require_once '../model/event.php';
    require_once '../model/user.php';
    /**
     * Funcion que inserta un evento en la base de datos
     * @return boolean true si se ha insertado correctamente, false en caso contrario
     */
    function insertarEvento(){
        if($_SERVER['REQUEST_METHOD']=="POST"){
           $nombre = $_POST["Nombre"];
           $descripcion = $_POST["Descripcion"];
           $provincia = $_POST['Provincia'];
           $localidad = $_POST['Localidad'];
           $tipoTerreno = $_POST['TipoTerreno'];
           $tipoEvento = $_POST['TipoEvento'];
           $fecha = $_POST['Fecha'];
           $especies = $_POST['especie'];
           $anfitrion = $_SESSION['nickname'];
           $imagen = $_FILES['imagen'];
           $cuantasEspecies = $_POST['cantidad'];            
            $validator = [
                validateCampo($nombre),
                validateCampo($descripcion),
                validateCampo($provincia),
                validateCampo($localidad),
                validateCampo($anfitrion),
                validateInt($cuantasEspecies),
            ];
            if($especies == "default"){
                array_push($validator, false);
            }
            if($tipoTerreno == "default"){
                array_push($validator, false);
            }
            if($tipoEvento == "default"){
                array_push($validator, false);
            }
            if(is_uploaded_file($_FILES['imagen']['tmp_name']) && $_FILES['imagen']['type']== 'image/png'){
                $nombreDirectorio = "../images/events/";
                $nombreFichero = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'],$nombreDirectorio.$nombreFichero);
                $imagen = $nombreDirectorio.$nombreFichero;
            }else{
                array_push($validator, false);
            }

            if(in_array(false, $validator)){
                header("Location: ../views/eventAdd.php?error");
            }
    
            $nombre = cleanCampo($nombre);
            $descripcion = cleanCampo($descripcion);
            $provincia = cleanCampo($provincia);
            $localidad = cleanCampo($localidad);
            $tipoTerreno = cleanCampo($tipoTerreno);
            $tipoEvento = cleanCampo($tipoEvento);
            $especies = cleanCampo($especies);
            $participantes =  [$anfitrion];

            $evento = new Evento(null,$nombre, $descripcion, $provincia, $localidad, $tipoTerreno, $tipoEvento, $fecha, $anfitrion,$participantes, $especies, $imagen);
            
            //añadir evento y especies   
            $evento->addEvent();
            $evento->EventoID = $evento->getID();
            $evento->addEventoSpecie($cuantasEspecies);
            $karma = User::getKarma($anfitrion);
            $karma = $karma + 4;
            User::updateKarma($anfitrion,$karma); 
            session_write_close();
            return true;   
        }
    }
    /**
     * Funcion que actualiza un evento en la base de datos
     * @return boolean true si se ha actualizado correctamente, false en caso contrario
     */
    function actualizarEvento(){
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $provincia = $_POST['provincia'];
            $localidad = $_POST['localidad'];
            $tipoTerreno = $_POST['TipoTerreno'];
            $tipoEvento = $_POST['TipoEvento'];
            $fecha = $_POST['fecha'];
            $anfitrion = $_SESSION['nickname'];
            $imagen = $_FILES['imagen'];
             $validator = [
                 validateCampo($nombre),
                 validateCampo($descripcion),
                 validateCampo($provincia),
                 validateCampo($localidad),
                 validateCampo($anfitrion),
             ];

             if($tipoTerreno == "default"){
                 array_push($validator, false);
             }
             if($tipoEvento == "default"){
                 array_push($validator, false);
             }
             if(is_uploaded_file($_FILES['imagen']['tmp_name']) && $_FILES['imagen']['type']== 'image/png'){
                 $nombreDirectorio = "../images/events/";
                 $nombreFichero = $_FILES['imagen']['name'];
                 move_uploaded_file($_FILES['imagen']['tmp_name'],$nombreDirectorio.$nombreFichero);
                 $imagen = $nombreDirectorio.$nombreFichero;
             }else{
                $imagen = Evento::getImagen($_GET['event']);
             }
 
             if(in_array(false, $validator)){
                return false;                  
             }
             
            $nombre = cleanCampo($nombre);
            $descripcion = cleanCampo($descripcion);
            $provincia = cleanCampo($provincia);
            $localidad = cleanCampo($localidad);
            $tipoTerreno = cleanCampo($tipoTerreno);
            $tipoEvento = cleanCampo($tipoEvento);
             
            $participantes = Evento::getParticipantes($_GET['event']);
            $evento = new Evento($_GET['event'],$nombre, $descripcion, $provincia, $localidad, $tipoTerreno, $tipoEvento, $fecha, $anfitrion,$participantes,null, $imagen);
            $evento->updateEvent();
            session_write_close();
            return true;
        }

    }
    function filterEvent($type,$filter){
        switch ($type){
            case "nombre":
                filterName($filter);
                break;
            case "ubicacion":
                filterUbicacion($filter);
                break;
            case "fecha":
                filterFecha($filter);
                break;
            case "user":
                filterUser($filter);
                break;
            case "terreno":
                filterTerreno($filter);
                break;
            case "evento":
                filterEvento($filter);
                break;
        }
    }
    /**
     * Funcion que redirige a la vista de eventos con los eventos filtrados
     */
    function redirecEvent($eventos){
        $eventos = $eventos;
        require_once "../views/eventAdd.php";
    }
    /**
     * Funcion que filtra los eventos por nombre
     */
    function filterName($filter){
        $eventos = Evento::getByName($filter);
        redirecEvent($eventos);
    }
    /**
     * Funcion que filtra los eventos por ubicacion
     */
    function filterUbicacion($filter){
        $eventos = Evento::getByUbicacion($filter);
        redirecEvent($eventos);

    }
    /**
     * Funcion que filtra los eventos por fecha
     */
    function filterFecha($filter){
        $eventos = Evento::getByFecha($filter);
        redirecEvent($eventos);

    }
    /**
     * Funcion que filtra los eventos por usuario
     */
    function filterUser($filter){
        $eventos = Evento::getByUserPropuesto($filter);
        redirecEvent($eventos);
    }
    /**
     * Funcion que filtra los eventos por tipo de terreno
     */
    function filterTerreno($filter){
        $eventos = Evento::getByTipoTerreno($filter);
        redirecEvent($eventos);
    }
    /**
     * Funcion que filtra los eventos por tipo de evento
     */
    function filterEvento($filter){
        $eventos = Evento::getByTipoEvento($filter);
        redirecEvent($eventos);
    }
    /**
     * Funcion que obtiene el filtro de la busqueda
     */
    function getFilter(){
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $filter = $_POST['filter'];
            
            if(validateCampo($filter)){
                $filter=cleanCampo($filter);
                return $filter;
            }
            return "";
        }
    }
    if(isset($_GET['action']) && !empty($_GET['action'])){
        $action=$_GET['action'];
    }else{
        //Establezco action por defecto para listar los Eventos 
        $action=6;
    }
    switch($action){
        case "1":
            //Alta de eventos
            if(insertarEvento()){
                require_once '../views/eventAdd.php';
            }else{
                require_once '../views/eventAdd.php?error="Erroralinsertar"';
            }
            break;
        case "2":
            //Modificacion de eventos
            if(actualizarEvento()){
                require_once 'homeController.php';
            }else{
                // como reenvio al mismo formulario con el error
                require_once 'homeController.php';
            }
            break;
        case "3":
            //Consulta detalle de su evento
            $evento = Evento::getEventoById($_GET['event']);
            $species = Especie::getAllSpecie();
            require_once '../views/eventDetail.php';
            break;
        case "4":
            //Busqueda de eventos
            $type = $_GET['event'];
            $filter = getFilter();
            if(isset($filter) && !empty($filter)){
                filterEvent($type,$filter);
            }  
            require_once '../views/eventAdd.php';
            break;
        case "5":
            //Calendario resumen de los eventos de los proximos tres meses
            $eventos = Evento::getAllEventByFecha();
            require_once '../views/eventCalendar.php';
            break;
        case "6":
            //Redirigir a formulario evento y cargar species
            $species = Especie::getAllSpecie();
            require_once "../views/eventAdd.php";
            break;
    }
?>
