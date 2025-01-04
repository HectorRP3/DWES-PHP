<?php
    require_once "../db/dataBase.php";

    class Especie {
        public $NombreCientifico;
        public $Beneficios;
        public $NombreComun;
        public $Descripcion;
        public $Clima;
        public $RegionOrigen;
        public $TiempoMaduracion;
        public $ImagenURL;

        public function __construct($NombreCientifico, $Beneficios, $NombreComun, $Descripcion, $Clima, $RegionOrigen, $TiempoMaduracion, $ImagenURL) {
            $this->NombreCientifico = $NombreCientifico;
            $this->Beneficios = $Beneficios;
            $this->NombreComun = $NombreComun;
            $this->Descripcion = $Descripcion;
            $this->Clima = $Clima;
            $this->RegionOrigen = $RegionOrigen;
            $this->TiempoMaduracion = $TiempoMaduracion;
            $this->ImagenURL = $ImagenURL;
        }

        public function __get($name) {
            if (property_exists($this, $name)) {
                return $this->$name;
            }
            return null;
        }

        public function __set($name, $value) {
            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
        /**
         * Devuelve todas las especies
         * @return array specie
         * @author Hector Rodriguez
         */
        public static function getAllSpecie(): array {
            $species = [];
            reforestaDB->connect();
            $stmt = reforestaDB->executeQuery("SELECT * FROM Especies");
            while ($row = $stmt->fetch()) {
                array_push($species, new Especie($row['NombreCientifico'], $row['Beneficios'], $row['NombreComun'], $row['Descripcion'], $row['Clima'], $row['RegionOrigen'], $row['TiempoMaduracion'], $row['ImagenURL']));
            }
            reforestaDB->disconnect();
            return $species;
        }
       
        /**
         * Añade una especie a la base de datos
         */
        function addSpecie(){
            reforestaDB->connect();
            reforestaDB->beginTransaction();  
            try{
                reforestaDB->executeInsert("INSERT INTO Especies (NombreCientifico, Beneficios, NombreComun, Descripcion, Clima, RegionOrigen, TiempoMaduracion, ImagenURL) VALUES 
                ('$this->NombreCientifico','$this->Beneficios','$this->NombreComun','$this->Descripcion','$this->Clima','$this->RegionOrigen','$this->TiempoMaduracion','$this->ImagenURL');");
                reforestaDB->commit();
            }catch(PDOException $e){
                reforestaDB->rollBack();
                echo "Error: ".$e->getMessage();
            }
            reforestaDB->disconnect();

        }
        /**
         * Devuelve la especie con mas participacion en eventos
         */
        public static function getEspecieMasParticipacion(){
            // la especi con mas cantidad  en eventos specie
            reforestaDB->connect();
            try{
                $stmt = reforestaDB->prepare("SELECT NombreCientifico,Beneficios,NombreComun,Descripcion,Clima,RegionOrigen,TiempoMaduracion,ImagenURL FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID GROUP BY EventosEspecies.EspecieID ORDER BY COUNT(EventosEspecies.EspecieID) DESC LIMIT 1;");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
                $row = $stmt->fetch();
                $specie = new Especie($row['NombreCientifico'], $row['Beneficios'], $row['NombreComun'], $row['Descripcion'], $row['Clima'], $row['RegionOrigen'], $row['TiempoMaduracion'], $row['ImagenURL']);
                reforestaDB->disconnect();
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }
            return $specie;
            
        }
        /**
         * Devuelve todas las especies
         */
        public static function getSpecie(){
            
            reforestaDB->connect();
            try{
                $stmt = reforestaDB->prepare("SELECT NombreCientifico,Beneficios,NombreComun,Descripcion,Clima,RegionOrigen,TiempoMaduracion,ImagenURL FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID GROUP BY EventosEspecies.EspecieID;");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
                $species = [];
                while ($row = $stmt->fetch()) {
                    array_push($species, new Especie($row['NombreCientifico'], $row['Beneficios'], $row['NombreComun'], $row['Descripcion'], $row['Clima'], $row['RegionOrigen'], $row['TiempoMaduracion'], $row['ImagenURL']));
                }
                reforestaDB->disconnect();
            }catch(PDOException $e){
             //   echo "Error: ".$e->getMessage();
            }
            return $species;
        }

        public static function getAllByEvent(){
            reforestaDB->connect();
            try{
                $stmt = reforestaDB->prepare("SELECT NombreCientifico,Beneficios,NombreComun,Descripcion,Clima,RegionOrigen,TiempoMaduracion,ImagenURL FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID GROUP BY EventosEspecies.EspecieID;");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
                $species = [];
                while ($row = $stmt->fetch()) {
                    array_push($species, new Especie($row['NombreCientifico'], $row['Beneficios'], $row['NombreComun'], $row['Descripcion'], $row['Clima'], $row['RegionOrigen'], $row['TiempoMaduracion'], $row['ImagenURL']));
                }
                reforestaDB->disconnect();
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }
            return $species;
        }

        public static function getSpecieByID($NombreCientifico){
            reforestaDB->connect();
            try{
                $stmt = reforestaDB->prepare("SELECT * FROM Especies WHERE NombreCientifico = :NombreCientifico;");
                $stmt->bindParam(":NombreCientifico",$NombreCientifico);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
                $row = $stmt->fetch();
                $specie = new Especie($row['NombreCientifico'], $row['Beneficios'], $row['NombreComun'], $row['Descripcion'], $row['Clima'], $row['RegionOrigen'], $row['TiempoMaduracion'], $row['ImagenURL']);
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }finally{
                reforestaDB->disconnect();
            }
            return $specie;
        }
    }
?>