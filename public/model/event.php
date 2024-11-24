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

        // public function __construct($Nombre, $Descripcion, $Provincia, $Localidad, $TipoTerreno, $TipoEvento, $Fecha, $AnfitrionID,/* $Estado,*/ $FechaAprobacion,$participantes,$especies,$imagen){
        //     $this->Nombre = $Nombre;
        //     $this->Descripcion = $Descripcion;
        //     $this->Provincia = $Provincia;
        //     $this->Localidad = $Localidad;
        //     $this->TipoTerreno = $TipoTerreno;
        //     $this->TipoEvento = $TipoEvento;
        //     $this->Fecha = $Fecha;
        //     $this->AnfitrionID = $AnfitrionID;
        //     // $this->Estado = $Estado;
        //     $this->Estado = "Aprobado";
        //     // $this->FechaAprobacion = $FechaAprobacion;
        //     $this->FechaAprobacion = date("Y-m-d");
        //     $this->participantes = [];
        //     $this->especies = $especies;
        //     $this->imagen = $imagen;

        // }
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
            //$this->Estado = "Aprobado";
            //$this->FechaAprobacion = $FechaAprobacion;
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

        function getID(){
            
            reforestaDB->connect();
            $row=reforestaDB->ExecuteSQLQuery("select max(EventoID) from Eventos;")->fetch();
            reforestaDB->disconnect();
            return $row["max(EventoID)"];

        }
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
        
        public static function getEventoMasParticipacion(){
            reforestaDB->connect();
            $stmt = reforestaDB->executeQuery("SELECT EventoID, COUNT(UserID) FROM Participantes GROUP BY EventoID ORDER BY COUNT(UserID) DESC LIMIT 1;");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            return $row;
        }

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
            return $event;
        }
    }

    
?>