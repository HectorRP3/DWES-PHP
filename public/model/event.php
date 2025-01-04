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
        private $participantes;
        private $especies;
        private $imagen;
        private $cantidad;

        public function __construct($EventoID,$Nombre, $Descripcion, $Provincia, $Localidad, $TipoTerreno, $TipoEvento, $Fecha, $AnfitrionID,$participantes,$especies,$imagen){
            $this->EventoID = $EventoID;
            $this->Nombre = $Nombre;
            $this->Descripcion = $Descripcion;
            $this->Provincia = $Provincia;
            $this->Localidad = $Localidad;
            $this->TipoTerreno = $TipoTerreno;
            $this->TipoEvento = $TipoEvento;
            $this->Fecha = $Fecha;
            $this->AnfitrionID = $AnfitrionID;
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
         * Funcion para coger todos los eventos 
         * @return array events
         * @author Hector Rodriguez
         */
        public static function getAllEvent():array{
            $events = [];
            reforestaDB->connect();
            try{
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
                    array_push($events,new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$par,$spe,$row['ImagenURL']));

                }
                return $events;
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
           }
        }
        /**
         * Funcion para coger todos los eventos por fecha
         * @return array events
         */
        public static function getAllEventByFecha():array{
            $fechaActual = date('Y-m-d');
            $fecha = date('Y-m-d', strtotime('+3 months'));
            $events = [];
            reforestaDB->connect();
            try{
                $stmt=reforestaDB->GetPdo()->prepare("SELECT * FROM Eventos WHERE Fecha BETWEEN ? and ?;");
                $stmt->bindParam(1,$fechaActual);
                $stmt->bindParam(2,$fecha);
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
                    array_push($events,new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$par,$spe,$row['ImagenURL']));

                }
                return $events;
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
           }
        }
        /**
         * Devuelve la imagen de un evento
         * @param int $EventoID
         * @return string
         */
        public static function getImagen($EventoID): string {
            reforestaDB->connect();
            try {
                $stmt = reforestaDB->GetPDO()->prepare("SELECT ImagenURL FROM Eventos WHERE EventoID = :EventoID;");
                $stmt->bindParam(":EventoID", $EventoID);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                reforestaDB->disconnect();
            }
            return $row['ImagenURL'] ?? '';
        }

        /**
         * Añade un evento
         */
        function addEvent(){
            reforestaDB->connect();
            reforestaDB->beginTransaction();  
            try{
                reforestaDB->executeInsert("INSERT INTO Eventos (Nombre, Descripcion, Provincia, Localidad, TipoTerreno, TipoEvento, Fecha, 
                AnfitrionID, ImagenURL) 
                VALUES ('$this->Nombre','$this->Descripcion','$this->Provincia','$this->Localidad','$this->TipoTerreno','$this->TipoEvento','$this->Fecha','$this->AnfitrionID','$this->imagen');");
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }

        }
        /**
         * Devuelve el id del evento
         * @return int
         */
        function getID(){
            
            reforestaDB->connect();
            try{
                $row=reforestaDB->ExecuteSQLQuery("select max(EventoID) from Eventos;")->fetch();
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }
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
            }finally{
                reforestaDB->disconnect();
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
            }finally{
                reforestaDB->disconnect();
            }
        }
        /**
         * Comprueba si un usuario ya esta participando en un evento
         * @param string $nickname
         * @param int $EventoID
         */
        public static function checkParticipacion($nickname,$EventoID){
            reforestaDB->connect();
            try{
                $stmt =  reforestaDB->GetPDO()->prepare("SELECT * FROM Participantes WHERE EventoID = :EventoID AND UserID = :UserID;" );
                $stmt->bindParam(":EventoID",$EventoID);
                $stmt->bindParam(":UserID",$nickname);
                $stmt->execute();
                $row = $stmt->fetch();
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }
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
            try{
                $stmt = reforestaDB->executeQuery("SELECT EventoID, COUNT(UserID) FROM Participantes GROUP BY EventoID ORDER BY COUNT(UserID) DESC LIMIT 1;");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $row = $stmt->fetch();
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }
            return $row;
        }
        /**
         * Devuelve el  id del evento
         * @return Evento
         */
        public static function getEventoById($eventID):Evento{
            reforestaDB->connect();
            try{
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
                $event = new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$par,$spe,$row['ImagenURL']);

            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }
            return $event;
        }
        /**
         * Devuelve los participantes de un evento
         * @param int $eventID
         * @return array participantes
         */
        public static function getParticipantes($eventID) : array{
            reforestaDB->connect();
            try{
                $stmt = reforestaDB->GetPdo()->prepare("SELECT * FROM Participantes WHERE EventoID = :evento;");
                $stmt->bindParam(":evento",$eventID);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $row = $stmt->fetch();
                $participantes = [];
                while($row){
                    array_push($participantes,$row['UserID']);
                }
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }
            return $participantes;
        }

        /**
         * Actualiza un evento
         */
        public function updateEvent(){
            reforestaDB->connect();
            reforestaDB->beginTransaction();
            try{
                $stmt= reforestaDB->GetPdo()->prepare("UPDATE Eventos SET Nombre = :Nombre, Descripcion = :Descripcion, Provincia = :Provincia, Localidad = :Localidad, TipoTerreno = :TipoTerreno, TipoEvento = :TipoEvento, Fecha = :Fecha, ImagenURL = :ImagenURL WHERE EventoID = :EventoID;");
                $stmt->bindParam(":Nombre",$this->Nombre);
                $stmt->bindParam(":Descripcion",$this->Descripcion);
                $stmt->bindParam(":Provincia",$this->Provincia);
                $stmt->bindParam(":Localidad",$this->Localidad);
                $stmt->bindParam(":TipoTerreno",$this->TipoTerreno);
                $stmt->bindParam(":TipoEvento",$this->TipoEvento);
                $stmt->bindParam(":Fecha",$this->Fecha);
                $stmt->bindParam(":ImagenURL",$this->imagen);
                $stmt->bindParam(":EventoID",$this->EventoID);
                $stmt->execute();
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
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
                    array_push($eventos,new Evento($row['EventoID'],$row['Nombre'],$row['Descripcion'],$row['Provincia'],$row['Localidad'],$row['TipoTerreno'],$row['TipoEvento'],$row['Fecha'],$row['AnfitrionID'],$par,$spe,$row['ImagenURL']));
                }
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }
            return $eventos;
        }

        /**
         * Devuelve los eventos por ubicación
         * @param string $ubicacion
         * @return array
         */
        public static function getByUbicacion($ubicacion): array {
            $eventos = [];
            reforestaDB->connect();
            try {
                $stmt = reforestaDB->GetPDO()->prepare("SELECT * FROM Eventos WHERE Provincia = :ubicacion OR Localidad = :ubicacion;");
                $stmt->bindParam(":ubicacion", $ubicacion);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $par = [];
                    $spe = [];
                    $participantes_stmt = reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID WHERE Participantes.EventoID = " . $row['EventoID'] . ";");
                    $species_stmt = reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = " . $row['EventoID'] . ";");
                    while ($par_row = $participantes_stmt->fetch()) {
                        array_push($par, $par_row['Nickname']);
                    }
                    while ($spe_row = $species_stmt->fetch()) {
                        array_push($spe, $spe_row['NombreCientifico']);
                    }
                    array_push($eventos, new Evento($row['EventoID'], $row['Nombre'], $row['Descripcion'], $row['Provincia'], $row['Localidad'], $row['TipoTerreno'], $row['TipoEvento'], $row['Fecha'], $row['AnfitrionID'], $par, $spe, $row['ImagenURL']));
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                reforestaDB->disconnect();
            }
            return $eventos;
        }
        /**
         * Devuelve los eventos por fecha
         * @param string $fecha
         * @return array
         */
        public static function getByFecha($fecha){
            //todas apartir de la fecha
            $eventos = [];
            reforestaDB->connect();
            try {
                $stmt = reforestaDB->GetPDO()->prepare("SELECT * FROM Eventos WHERE Fecha >= :fecha;");
                $stmt->bindParam(":fecha", $fecha);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $par = [];
                    $spe = [];
                    $participantes_stmt = reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID WHERE Participantes.EventoID = " . $row['EventoID'] . ";");
                    $species_stmt = reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = " . $row['EventoID'] . ";");
                    while ($par_row = $participantes_stmt->fetch()) {
                        array_push($par, $par_row['Nickname']);
                    }
                    while ($spe_row = $species_stmt->fetch()) {
                        array_push($spe, $spe_row['NombreCientifico']);
                    }
                    array_push($eventos, new Evento($row['EventoID'], $row['Nombre'], $row['Descripcion'], $row['Provincia'], $row['Localidad'], $row['TipoTerreno'], $row['TipoEvento'], $row['Fecha'], $row['AnfitrionID'], $par, $spe, $row['ImagenURL']));
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                reforestaDB->disconnect();
            }
        }

        /**
         * Devuelve los eventos propuestos por un usuario
         * @param string $userID
         * @return array
         */
        public static function getByUserPropuesto($userID): array {
            $eventos = [];
            reforestaDB->connect();
            try {
            $stmt = reforestaDB->GetPDO()->prepare("SELECT * FROM Eventos WHERE AnfitrionID = :userID;");
            $stmt->bindParam(":userID", $userID);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $par = [];
                $spe = [];
                $participantes_stmt = reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID WHERE Participantes.EventoID = " . $row['EventoID'] . ";");
                $species_stmt = reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = " . $row['EventoID'] . ";");
                while ($par_row = $participantes_stmt->fetch()) {
                array_push($par, $par_row['Nickname']);
                }
                while ($spe_row = $species_stmt->fetch()) {
                array_push($spe, $spe_row['NombreCientifico']);
                }
                array_push($eventos, new Evento($row['EventoID'], $row['Nombre'], $row['Descripcion'], $row['Provincia'], $row['Localidad'], $row['TipoTerreno'], $row['TipoEvento'], $row['Fecha'], $row['AnfitrionID'], $par, $spe, $row['ImagenURL']));
            }
            } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            } finally {
            reforestaDB->disconnect();
            }
            return $eventos;
        }

        /**
         * Devuelve los eventos por tipo de evento
         * @param string $tipoEvento
         * @return array
         */
        public static function getByTipoEvento($tipoEvento): array {
            $eventos = [];
            reforestaDB->connect();
            try {
                $stmt = reforestaDB->GetPDO()->prepare("SELECT * FROM Eventos WHERE TipoEvento = :tipoEvento;");
                $stmt->bindParam(":tipoEvento", $tipoEvento);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $par = [];
                    $spe = [];
                    $participantes_stmt = reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID WHERE Participantes.EventoID = " . $row['EventoID'] . ";");
                    $species_stmt = reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = " . $row['EventoID'] . ";");
                    while ($par_row = $participantes_stmt->fetch()) {
                        array_push($par, $par_row['Nickname']);
                    }
                    while ($spe_row = $species_stmt->fetch()) {
                        array_push($spe, $spe_row['NombreCientifico']);
                    }
                    array_push($eventos, new Evento($row['EventoID'], $row['Nombre'], $row['Descripcion'], $row['Provincia'], $row['Localidad'], $row['TipoTerreno'], $row['TipoEvento'], $row['Fecha'], $row['AnfitrionID'], $par, $spe, $row['ImagenURL']));
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                reforestaDB->disconnect();
            }
            return $eventos;
        }

        /**
         * Devuelve los eventos por tipo de terreno
         * @param string $tipoTerreno
         * @return array
         */
        public static function getByTipoTerreno($tipoTerreno): array {
            $eventos = [];
            reforestaDB->connect();
            try {
                $stmt = reforestaDB->GetPDO()->prepare("SELECT * FROM Eventos WHERE TipoTerreno = :tipoTerreno;");
                $stmt->bindParam(":tipoTerreno", $tipoTerreno);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $par = [];
                    $spe = [];
                    $participantes_stmt = reforestaDB->executeQuery("SELECT Usuarios.Nickname FROM Usuarios JOIN Participantes ON Usuarios.Nickname = Participantes.UserID WHERE Participantes.EventoID = " . $row['EventoID'] . ";");
                    $species_stmt = reforestaDB->executeQuery("SELECT Especies.NombreCientifico FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID WHERE EventosEspecies.EventoID = " . $row['EventoID'] . ";");
                    while ($par_row = $participantes_stmt->fetch()) {
                        array_push($par, $par_row['Nickname']);
                    }
                    while ($spe_row = $species_stmt->fetch()) {
                        array_push($spe, $spe_row['NombreCientifico']);
                    }
                    array_push($eventos, new Evento($row['EventoID'], $row['Nombre'], $row['Descripcion'], $row['Provincia'], $row['Localidad'], $row['TipoTerreno'], $row['TipoEvento'], $row['Fecha'], $row['AnfitrionID'], $par, $spe, $row['ImagenURL']));
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                reforestaDB->disconnect();
            }
            return $eventos;
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
            }finally{
                reforestaDB->disconnect();
            }
        }
        /**
         * Devuelve el evento con mas beneficios
         * @return array
         */
        public static function getEventoConMasBeneficios(){
            reforestaDB->connect();
            reforestaDB->beginTransaction();
            try{
                $stmt = reforestaDB->GetPdo()->prepare("SELECT EventoID, COUNT(UserID) FROM Participantes GROUP BY EventoID ORDER BY COUNT(UserID) DESC LIMIT 1;");
                $stmt->execute();
                $row = $stmt->fetch();
                $stmt = reforestaDB->GetPdo()->prepare("SELECT * FROM Eventos WHERE EventoID = :EventoID;");
                $stmt->bindParam(":EventoID",$row['EventoID']);
                $stmt->execute();
                $row = $stmt->fetch();
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }
            return $row;
        }
        /**
         * Devuelve la localidad con mas eventos
         */
        public static function getEventoConMasLocalidad(){
            reforestaDB->connect();
            reforestaDB->beginTransaction();
            try{
                $stmt = reforestaDB->GetPdo()->prepare("SELECT Localidad, COUNT(Localidad) FROM Eventos GROUP BY Localidad ORDER BY COUNT(Localidad) DESC LIMIT 1;");
                $stmt->execute();
                $row = $stmt->fetch();
                $stmt = reforestaDB->GetPdo()->prepare("SELECT * FROM Eventos WHERE Localidad = :Localidad;");
                $stmt->bindParam(":Localidad",$row['Localidad']);
                $stmt->execute();
                $row = $stmt->fetch();
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }
            return $row;
        }
    }
    
?>