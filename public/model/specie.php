<?php
    require_once "../db/dataBase.php";

    class Especie {
        private $NombreCientifico;
        private $Beneficios;
        private $NombreComun;
        private $Descripcion;
        private $Clima;
        private $RegionOrigen;
        private $TiempoMaduracion;
        private $ImagenURL;

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

        public static function GetAll(): array {
            $species = [];
            reforestaDB->connect();
            $stmt = reforestaDB->executeQuery("SELECT * FROM Especies");
            while ($row = $stmt->fetch()) {
                array_push($species, new Especie($row['NombreCientifico'], $row['Beneficios'], $row['NombreComun'], $row['Descripcion'], $row['Clima'], $row['RegionOrigen'], $row['TiempoMaduracion'], $row['ImagenURL']));
            }
            reforestaDB->disconnect();
            return $species;
        }
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

        public static function getEspecieMasParticipacion(){
            // la especi con mas cantidad  en eventos specie
            reforestaDB->connect();
            $stmt = reforestaDB->prepare("SELECT NombreCientifico,Beneficios,NombreComun,Descripcion,Clima,RegionOrigen,TiempoMaduracion,ImagenURL FROM Especies JOIN EventosEspecies ON Especies.NombreCientifico = EventosEspecies.EspecieID GROUP BY EventosEspecies.EspecieID ORDER BY COUNT(EventosEspecies.EspecieID) DESC LIMIT 1;");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            $specie = new Especie($row['NombreCientifico'], $row['Beneficios'], $row['NombreComun'], $row['Descripcion'], $row['Clima'], $row['RegionOrigen'], $row['TiempoMaduracion'], $row['ImagenURL']);
            return $specie;
            
        }
    }
?>