<?php   
    session_start();
     require_once "../model/event.php";
     require_once "../model/user.php";
     require_once "../model/specie.php";

     /**
      * Funcion que se encarga de filtrar los logros segun el filtro seleccionado
      */
    function filtroLogros($filter){
        switch($filter){
            case "year":
                $especie = Especie::getEspecieMasParticipacion();
                $usuario = User::getUsuarioMasKarma();
                $evento = Evento::getEventoMasParticipacion();
                $eventoCompleto = Evento::getEventoById($evento['EventoID']);
                require_once '../views/logros.php';
                break;
            case "location":
                $especie = Especie::getEspecieMasParticipacion();
                $usuario = User::getUsuarioMasKarma();
                $evento = Evento::getEventoMasParticipacion();
                $eventoCompleto = Evento::getEventoById($evento['EventoID']);
                $eventoConMasLocalidad = Evento::getEventoConMasLocalidad();
                require_once '../views/logros.php';
                break;
            case "beneficios":
                $especie = Especie::getEspecieMasParticipacion();
                $usuario = User::getUsuarioMasKarma();
                $evento = Evento::getEventoMasParticipacion();
                $eventoCompleto = Evento::getEventoById($evento['EventoID']);
                $eventoConMasBeneficios = Evento::getEventoConMasBeneficios();
                require_once '../views/logros.php';
                break;
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
            $species = Especie::getAllByEvent();
            require_once "../views/specieList.php";
            break;
        case "2":
            $especie = Especie::getSpecieByID($_GET['specie']);
            require_once "../views/specieDetail.php";
        case "3":
            $especie = Especie::getEspecieMasParticipacion();
            $usuario = User::getUsuarioMasKarma();
            $evento = Evento::getEventoMasParticipacion();

            $eventoCompleto = Evento::getEventoById($evento['EventoID']);
            require_once '../views/logros.php';

            break;
        case "4":
            //Filtro por el ultimo año
            $filter = $_POST['filter'];
            filtroLogros($filter);
            break;
    }
?>