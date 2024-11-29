<?php
    require_once "../db/dataBase.php";
    class Evento{
        private $EventoID;
        private $Nombre;
        private $Descripcion;
        private $Provincia;
        private $Localidad;
        private $TipoTerreno;
        private $TipoEvento;
        private $Fecha;
        private $AnfitrionID;
        private $Estado;
        private $FechaAprobacion;
        private $participantes;
        private $especies;
        private $imagen;
        private $cantidad;

        public function __construct($EventoID,$Nombre, $Descripcion, $Provincia, $Localidad, $TipoTerreno, $TipoEvento, $Fecha, $AnfitrionID,$Estado, $FechaAprobacion,$participantes,$especies,$imagen){
            $this->EventoID = $EventoID;
            $this->Nombre = $Nombre;
            $this->Descripcion = $Descripcion;
            $this->Provincia = $Provincia;
            $this->Localidad = $Localidad;
            $this->TipoTerreno = $TipoTerreno;
            $this->TipoEvento = $TipoEvento;
            $this->Fecha = $Fecha;
            $this->AnfitrionID = $AnfitrionID;
            $this->Estado = $Estado;
            $this->FechaAprobacion = date("Y-m-d");
            $this->participantes = [];
            $this->especies = $especies;
            $this->imagen = $imagen;

        }

        public function __get($name)
        {
            if(property_exists($this, $name)){
                return $this->$name;
            }
            return null;
        }

        public function __set($name, $value)
        {
            if(property_exists($this, $name)){
                $this->$name = $value;
            }
        }
        /**
         * Devuelve todos los eventos
         */
        public static function GetAll() : array{
            $events = [];
            reforestaDB->connect();
            $stmt=reforestaDB->executeQuery("SELECT * FROM Eventos");
            while($row=$stmt->fetch()){
                $par=[];
                $spe=[];
                $participantes_stmt=reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID  WHERE Participantes.EventoID = ".$row['EventoID'].";");
                $species_stmt=reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = ".$row['EventoID'].";");
                while($par_row=$participantes_stmt->fetch()){
                    array_push($par,$par_row['Nickname']);
                }
                while($spe_row=$species_stmt->fetch()){
                    array_push($spe,$spe_row['NombreCientifico']);
                };
                array_push($events,new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$row['Estado'],$row['FechaAprobacion'],$par,$spe,$row['ImagenURL']));

            }
            reforestaDB->disconnect();
            return $events;
        }
        /**
         * Añade un evento
         */
        function addEvent(){
            reforestaDB->connect();
            reforestaDB->beginTransaction();  
            try{
                reforestaDB->executeInsert("INSERT INTO Eventos (Nombre, Descripcion, Provincia, Localidad, TipoTerreno, TipoEvento, Fecha, 
                AnfitrionID, Estado, FechaAprobacion, ImagenURL) 
                VALUES ('$this->Nombre','$this->Descripcion','$this->Provincia','$this->Localidad','$this->TipoTerreno','$this->TipoEvento','$this->Fecha','$this->AnfitrionID','$this->Estado','$this->FechaAprobacion','$this->imagen');");
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }
            reforestaDB->disconnect();

        }
        /**
         * Devuelve el id del evento
         * @return int
         */
        function getID(){
            
            reforestaDB->connect();
            $row=reforestaDB->ExecuteSQLQuery("select max(EventoID) from Eventos;")->fetch();
            reforestaDB->disconnect();
            return $row["max(EventoID)"];

        }
        /**
         * Añade una especie a un evento
         * @param int $cantidad
         */
        function addEventoSpecie($cantidad){
            reforestaDB->connect();
            reforestaDB->beginTransaction();
            try{
                reforestaDB->executeInsert("INSERT INTO EventosEspecies (EventoID, EspecieID, Cantidad) 
                VALUES ('$this->EventoID','$this->especies','$cantidad');");
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }

        }
        /**
         * Participa en un evento
         * @param string $nickname
         * @param int $EventoID
         */
        public static function participarEvento($nickname,$EventoID){
            reforestaDB->connect();
            reforestaDB->beginTransaction();
            try{
                $stmt =  reforestaDB->GetPDO()->prepare("INSERT INTO Participantes (EventoID, UserID) VALUES (:EventoID, :UserID);");
                $stmt->bindParam(":EventoID", $EventoID);
                $stmt->bindParam(":UserID", $nickname);
                $stmt->execute();
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }
        }
        /**
         * Comprueba si un usuario ya esta participando en un evento
         * @param string $nickname
         * @param int $EventoID
         */
        public static function checkParticipacion($nickname,$EventoID){
            reforestaDB->connect();
            $stmt =  reforestaDB->GetPDO()->prepare("SELECT * FROM Participantes WHERE EventoID = :EventoID AND UserID = :UserID;" );
            $stmt->bindParam(":EventoID",$EventoID);
            $stmt->bindParam(":UserID",$nickname);
            $stmt->execute();
            $row = $stmt->fetch();
            if($row){
                return true;
            }else{
                return false;
            }
        }
        /**
         * Devuelve el evento con mas participacion
         * @return array
         */
        public static function getEventoMasParticipacion(){
            reforestaDB->connect();
            $stmt = reforestaDB->executeQuery("SELECT EventoID, COUNT(UserID) FROM Participantes GROUP BY EventoID ORDER BY COUNT(UserID) DESC LIMIT 1;");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            return $row;
        }
        /**
         * Devuelve el  id del evento
         * @return Evento
         */
        public static function getEventoById($eventID){
            reforestaDB->connect();
            $stmt = reforestaDB->executeQuery("SELECT * FROM Eventos WHERE EventoID = ".$eventID.";");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $par=[];
            $spe=[];
            $participantes_stmt=reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID  WHERE Participantes.EventoID = ".$row['EventoID'].";");
            $species_stmt=reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = ".$row['EventoID'].";");
            while($par_row=$participantes_stmt->fetch()){
                array_push($par,$par_row['Nickname']);
            }
            while($spe_row=$species_stmt->fetch()){
                array_push($spe,$spe_row['NombreCientifico']);
            };
            $event = new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$row['Estado'],$row['FechaAprobacion'],$par,$spe,$row['ImagenURL']);
            reforestaDB->disconnect();
            return $event;
        }
        /**
         * Devuelve los eventos por nombre y tipo
         * @param string $nombre
         * @param string $TipoTerreno
         * @param string $TipoEvento
         * @return array
         */
        public static function getEventByNombreAndTipo($nombre,$TipoTerreno,$TipoEvento){
           $eventos = [];
            reforestaDB->connect();
            reforestaDB->beginTransaction();

            try{
                $stmt = reforestaDB->prepare("SELECT * FROM Eventos WHERE Nombre = :Nombre AND TipoTerreno = :TipoTerreno AND TipoEvento = :TipoEvento;");
                $stmt->bindParam(":Nombre",$nombre);
                $stmt->bindParam(":TipoTerreno",$TipoTerreno);
                $stmt->bindParam(":TipoEvento",$TipoEvento);
                $stmt->execute();
                while($row=$stmt->fetch()){
                    $par=[];
                    $spe=[];
                    $participantes_stmt=reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID  WHERE Participantes.EventoID = ".$row['EventoID'].";");
                    $species_stmt=reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = ".$row['EventoID'].";");
                    while($par_row=$participantes_stmt->fetch()){
                        array_push($par,$par_row['Nickname']);
                    }
                    while($spe_row=$species_stmt->fetch()){
                        array_push($spe,$spe_row['NombreCientifico']);
                    };
                    array_push($eventos,new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$row['Estado'],$row['FechaAprobacion'],$par,$spe,$row['ImagenURL']));
                }
                reforestaDB->commit();
                reofrestaDB->disconnect();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }        
            
        }

        /**
         * Devuelve los eventos por nombre
         * @param string $nombre
         * @return array
         */
        public static function getByName($nombre){
            $eventos = [];
            reforestaDB->connect();
            reforestaDB->beginTransaction();

            try{
                $stmt = reforestaDB->prepare("SELECT * FROM Eventos WHERE Nombre = :Nombre;");
                $stmt->bindParam(":Nombre",$nombre);
                $stmt->execute();
                while($row=$stmt->fetch()){
                    $par=[];
                    $spe=[];
                    $participantes_stmt=reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID  WHERE Participantes.EventoID = ".$row['EventoID'].";");
                    $species_stmt=reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = ".$row['EventoID'].";");
                    while($par_row=$participantes_stmt->fetch()){
                        array_push($par,$par_row['Nickname']);
                    }
                    while($spe_row=$species_stmt->fetch()){
                        array_push($spe,$spe_row['NombreCientifico']);
                    };
                    array_push($eventos,new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$row['Estado'],$row['FechaAprobacion'],$par,$spe,$row['ImagenURL']));
                }
                reforestaDB->commit();
                reforestaDB->disconnect();
                return $eventos;
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }
        }

        /**
         * Devuelve los eventos por tipo de evento
         * @param string $nombre
         * @param string $TipoEvento
         * @return array
         */
        public static function getEventByTipoEvento($nombre,$TipoEvento){
            $eventos = [];
            reforestaDB->connect();
            reforestaDB->beginTransaction();

            try{
                $stmt = reforestaDB->prepare("SELECT * FROM Eventos WHERE Nombre = :Nombre AND TipoEvento = :TipoEvento;");
                $stmt->bindParam(":Nombre",$nombre);
                $stmt->bindParam(":TipoEvento",$TipoEvento);
                $stmt->execute();
                while($row=$stmt->fetch()){
                    $par=[];
                    $spe=[];
                    $participantes_stmt=reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID  WHERE Participantes.EventoID = ".$row['EventoID'].";");
                    $species_stmt=reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = ".$row['EventoID'].";");
                    while($par_row=$participantes_stmt->fetch()){
                        array_push($par,$par_row['Nickname']);
                    }
                    while($spe_row=$species_stmt->fetch()){
                        array_push($spe,$spe_row['NombreCientifico']);
                    };
                    array_push($eventos,new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$row['Estado'],$row['FechaAprobacion'],$par,$spe,$row['ImagenURL']));
                }
                reforestaDB->commit();
                reforestaDB->disconnect();
                return $eventos;

            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }        
        }
        /**
         * Devuelve los eventos por tipo de terreno
         * @param string $nombre
         * @param string $TipoTerreno
         * @return array
         */
        public static function getEventByTipoTerreno($nombre,$TipoTerreno){
            $eventos = [];
            reforestaDB->connect();
            reforestaDB->beginTransaction();
            try{
                $stmt = reforestaDB->prepare("SELECT * FROM Eventos WHERE Nombre = :Nombre AND TipoTerreno = :TipoTerreno;");
                $stmt->bindParam(":Nombre",$nombre);
                $stmt->bindParam(":TipoTerreno",$TipoTerreno);
                $stmt->execute();
                while($row=$stmt->fetch()){
                    $par=[];
                    $spe=[];
                    $participantes_stmt=reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID  WHERE Participantes.EventoID = ".$row['EventoID'].";");
                    $species_stmt=reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = ".$row['EventoID'].";");
                    while($par_row=$participantes_stmt->fetch()){
                        array_push($par,$par_row['Nickname']);
                    }
                    while($spe_row=$species_stmt->fetch()){
                        array_push($spe,$spe_row['NombreCientifico']);
                    };
                    array_push($eventos,new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$row['Estado'],$row['FechaAprobacion'],$par,$spe,$row['ImagenURL']));
                }
                reforestaDB->commit();
                reofrestaDB->disconnect();
                return $eventos;
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }
        }
        /**
         * Elimina un evento
         * @param int $eventID
         */
        public static function deleteEvent($eventID){
            reforestaDB->connect();
            reforestaDB->beginTransaction();
            try{
                reforestaDB->executeInsert("DELETE FROM Eventos WHERE EventoID = ".$eventID.";");
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }
            reforestaDB->disconnect();

        }
    }

    
?>