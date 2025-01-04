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
    private $password;

    
    public function __construct($nickname, $nombre, $apellidos, $email, $karma, $suscrito, $fechaCreacion,$password){
        $this->nickname = $nickname;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->karma = $karma;
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

    /**
     * Devuelve el usuario entero con el nickname
     * @param string $nickname
     * @return User
     */
    public static function getUser($nickname){
        reforestaDB->connect();
        reforestaDB->beginTransaction();
        try{
            $stmt = reforestaDB->GetPdo()->prepare("SELECT * FROM Usuarios WHERE Nickname = :nickname");
            $stmt->bindParam(":nickname",$nickname);
            $stmt->execute();
            $row = $stmt->fetch();
            $user = new User($row['Nickname'], $row['Nombre'], $row['Apellidos'], $row['Email'], $row['Karma'], $row['Suscrito'], $row['FechaCreacion'], $row['Contrasenya']);
            reforestaDB->commit();
        }catch(PDOException $e){
            reforestaDB->rollBack();
        }finally{
            reforestaDB->disconnect();
        }
        return $user;
    }
    /**
     * Añade un usuario a la base de datos
     */
    function addUser(){
        reforestaDB->connect();
        reforestaDB->beginTransaction();
        try{
            $stmt = reforestaDB->GetPdo()->prepare("INSERT INTO Usuarios (Nickname, Nombre, Apellidos, Email, Karma, Suscrito, FechaCreacion,Contrasenya) VALUES (?,?,?,?,?,?,?,?);");
            $stmt->bindParam(1,$this->nickname);
            $stmt->bindParam(2,$this->nombre);
            $stmt->bindParam(3,$this->apellidos);
            $stmt->bindParam(4,$this->email);
            $stmt->bindParam(5,$this->karma);
            $stmt->bindParam(6,$this->suscrito);
            $stmt->bindParam(7,$this->fechaCreacion);
            $stmt->bindParam(8,$this->password);
            $stmt->execute();
            reforestaDB->commit();
        }catch(PDOException $e){
            reforestaDB->rollBack();
           // echo "Error: ".$e->getMessage();
        }finally{
            reforestaDB->disconnect();
        }
    }
    /**
     * Comprueba si el usuario y la contraseña coinciden
     * @param string $nickname
     * @param string $password
     * @return bool
     */
    public function checkUserPassword($nickname, $password){
        reforestaDB->connect();
        try{
            $stmt =  reforestaDB->GetPDO()->prepare("SELECT * FROM Usuarios WHERE Nickname = :nickname AND Contrasenya = :password;" );
            $stmt->bindParam(":nickname",$nickname);
            $stmt->bindParam(":password",$password);
            $stmt->execute();
            $row = $stmt->fetchAll();
            reforestaDB->disconnect();
            if($row){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
        
    }
    /**
     * Devuelve el karma de un usuario
     * @param string $nickname
     * @return int
     */
    public static function getKarma($nickname){
        reforestaDB->connect();
        $stmt =  reforestaDB->GetPDO()->prepare("SELECT Karma FROM Usuarios WHERE Nickname = :nickname;" );
        $stmt->bindParam(":nickname",$nickname);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['Karma'];
    }
    /**
     * Actualiza la suscripcion de un usuario
     * @param string $nickname
     */
    public static function updateSuscripcion($nickname){
        reforestaDB->connect();
        $stmt =  reforestaDB->GetPDO()->prepare("UPDATE Usuarios SET Suscrito = 1 WHERE Nickname = :nickname;" );
        $stmt->bindParam(":nickname",$nickname);
        $stmt->execute();
    }
    /**
     * Comprueba si un usuario esta suscrito
     * @param string $nickname
     * @return bool
     */
    public static function checkSuscription($nickname) : bool{
        reforestaDB->connect();
        try{
            $stmt =  reforestaDB->GetPDO()->prepare("SELECT Suscrito FROM Usuarios WHERE Nickname = :nickname;" );
            $stmt->bindParam(":nickname",$nickname);
            $stmt->execute();
            $row = $stmt->fetch();
            reforestaDB->disconnect();
            if($row['Suscrito'] == 1){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
        }
    }
    /**
     * Actualiza el karma de un usuario
     * @param string $nickname
     * @param int $karma
     */
    public static function updateKarma($nickname, $karma){
        reforestaDB->connect();
        try{
            $stmt =  reforestaDB->GetPDO()->prepare("UPDATE Usuarios SET Karma = :karma WHERE Nickname = :nickname;");
            $stmt->bindParam(":nickname",$nickname);
            $stmt->bindParam(":karma",$karma);
            $stmt->execute();
            reforestaDB->disconnect();
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }
    /**
     * Devuelve el usuario con mas karma
     * @return array
     */
    public static function getUsuarioMasKarma(){
        reforestaDB->connect();
        try{
            $stmt =  reforestaDB->GetPDO()->prepare("SELECT Nickname, Karma FROM Usuarios WHERE Karma = (SELECT MAX(Karma) FROM Usuarios);");
            $stmt->execute();
            $row = $stmt->fetch();
            reforestaDB->disconnect();
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
        return $row;
    }
    /**
     * Actualiza los datos de un usuario
     * @param string $nickname
     * @param string $email
     * @param string $password
     */
    public static function updateUser($nick,$nickname, $name,$apellidos,$email){
        reforestaDB->connect();
        reforestaDB->beginTransaction();
        try{
            $stmt =  reforestaDB->GetPDO()->prepare("UPDATE Usuarios SET Nombre = :nombre, Apellidos = :apellidos, Email = :email, Nickname = :nickname WHERE Nickname = :nick;");
            $stmt->bindParam(":nick",$nick);
            $stmt->bindParam(":nickname",$nickname);
            $stmt->bindParam(":nombre",$name);
            $stmt->bindParam(":apellidos",$apellidos);
            $stmt->bindParam(":email",$email);
            $stmt->execute();
            reforestaDB->commit();
        }catch(PDOException $e){
            reforestaDB->rollBack();
            echo "Error: ".$e->getMessage();
        }finally{
            reforestaDB->disconnect();
        }
        
    }
    public static function updatePassword($nickname, $password){
        reforestaDB->connect();
        reforestaDB->beginTransaction();
        try{
            $stmt =  reforestaDB->GetPDO()->prepare("UPDATE Usuarios SET Contrasenya = :password WHERE Nickname = :nickname;");
            $stmt->bindParam(":nickname",$nickname);
            $stmt->bindParam(":password",$password);
            $stmt->execute();
            reforestaDB->commit();
        }catch(PDOException $e){
            reforestaDB->rollBack();
            echo "Error: ".$e->getMessage();
        }finally{
            reforestaDB->disconnect();
        }
    }

}
?>