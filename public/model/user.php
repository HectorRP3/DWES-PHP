<?php
require_once "../db/dataBase.php";
class User{
    private $nickname;
    private $nombre;
    private $apellidos;
    private $email;
    private $karma;
    private $suscrito;
    private $fechaCreacion;
    //hacer futura implementacion contraseña
    private $password;

    
    public function __construct($nickname, $nombre, $apellidos, $email, $karma, $suscrito, $fechaCreacion,$password){
        $this->nickname = $nickname;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->karma = 0;
        $this->suscrito = $suscrito;
        $this->fechaCreacion = $fechaCreacion;
        $this->password = $password;
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


    public function getUser($nickname){
        reforestaDB->connect();
        $stmt = $pdo->executeQuery("SELECT * FROM Usuarios WHERE Nickname = :nickname AND Contrasea = :password;");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $user = new User($row['Nickname'], $row['Nombre'], $row['Apellidos'], $row['Email'], $row['Karma'], $row['Suscrito'], $row['FechaCreacion'], $row['Contraseña']);
        return $user;
    }

    function addUser(){
        reforestaDB->connect();
        reforestaDB->beginTransaction();
        try{
            reforestaDB->executeInsert("INSERT INTO Usuarios (Nickname, Nombre, Apellidos, Email, Karma, Suscrito, FechaCreacion,Contrasea) VALUES 
            ('$this->nickname','$this->nombre','$this->apellidos','$this->email','$this->karma','$this->suscrito','$this->fechaCreacion','$this->password');");
            reforestaDB->commit();
        }catch(PDOException $e){
            reforestaDB->rollBack();
            echo "Error: ".$e->getMessage();
        }
    }

    // public function getUser($nickname, $password){
    //     reforestaDB->connect();
    //     $stmt = $pdo->executeQuery("SELECT * FROM Usuarios WHERE Nickname = :nickname AND Contrasea = :password;" , [":nickname"=>$nickname,":password"=>$password]);
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     $row = $stmt->fetch();
    //     $user = new User($row['Nickname'], $row['Nombre'], $row['Apellidos'], $row['Email'], $row['Karma'], $row['Suscrito'], $row['FechaCreacion'], $row['Contraseña']);
    //     return $user;
    // }
    public function checkUserPassword($nickname, $password){
        reforestaDB->connect();
        $stmt =  reforestaDB->GetPDO()->prepare("SELECT * FROM Usuarios WHERE Nickname = :nickname AND Contrasea = :password;" );
        $stmt->bindParam(":nickname",$nickname);
        $stmt->bindParam(":password",$password);
        $stmt->execute();
        $row = $stmt->fetchAll();
        if($row){
            return true;
        }else{
            return false;
        }
    }
    public static function getKarma($nickname){
        reforestaDB->connect();
        $stmt =  reforestaDB->GetPDO()->prepare("SELECT Karma FROM Usuarios WHERE Nickname = :nickname;" );
        $stmt->bindParam(":nickname",$nickname);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['Karma'];
    }

    public static function updateSuscripcion($nickname){
        reforestaDB->connect();
        $stmt =  reforestaDB->GetPDO()->prepare("UPDATE Usuarios SET Suscrito = 1 WHERE Nickname = :nickname;" );
        $stmt->bindParam(":nickname",$nickname);
        $stmt->execute();
    }

    public static function checkSuscription($nickname){
        reforestaDB->connect();
        $stmt =  reforestaDB->GetPDO()->prepare("SELECT Suscrito FROM Usuarios WHERE Nickname = :nickname;" );
        $stmt->bindParam(":nickname",$nickname);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row['Suscrito'] == 1){
            return true;
        }else{
            return false;
        }
    }
    public static function updateKarma($nickname, $karma){
        reforestaDB->connect();
        $stmt =  reforestaDB->GetPDO()->prepare("UPDATE Usuarios SET Karma = :karma WHERE Nickname = :nickname;");
        $stmt->bindParam(":nickname",$nickname);
        $stmt->bindParam(":karma",$karma);
        $stmt->execute();
    }

    public static function getUsuarioMasKarma(){
        reforestaDB->connect();
        $stmt =  reforestaDB->GetPDO()->prepare("SELECT Nickname, Karma FROM Usuarios WHERE Karma = (SELECT MAX(Karma) FROM Usuarios);");
        $stmt->execute();
        $row = $stmt->fetch();
        return $row;
    }

}
?>