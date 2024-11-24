<?php
class ReforestaDB{
    private PDO|null $pdo;
    private  $server;
    private  $db;
    private  $user;
    private  $pass;

    public function __construct($server, $db, $user, $pass){
        $this->server = $server;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->pdo = null;
    }

    public function connect(){
        if($this->pdo==null){
            $this->pdo = new PDO("mysql:host=".$this->server.";dbname=".$this->db, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
    public function disconnect(){
        if($this->pdo != null){
            $this->pdo = null;
        }
    }
    public function GetPdo(){
        return $this->pdo;
    }
    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }
    public function exectute(){
        return $this->pdo->execute();
    }
    public function executeQuery($sql, $array=[]) : PDOStatement{
        $stmt = $this->pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($array as $key=>$value){
            $stmt->bindParam($key,$value);
        }
        try{
            $stmt->execute();
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
        return $stmt;
    }
    // public function executeInsert($sql,$array=[]){
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     foreach($array as $key=>$value){
    //         $stmt->bindParam($key,$value);
    //     }
    //     $stmt->execute();
    // }
    function executeInsert($query){
        $this->GetPDO()->query($query);
    }
    function ExecuteSQLQuery($query,$bind=[]):PDOStatement{
        $statement=$this->GetPDO()->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        foreach($bind as $element){
            $statement->bindParam(":".$element,$element);
        }
        try{
            $statement->execute();
        }catch(PDOException $e){
            echo "PDOException: ".$e->getMessage();
        }
        return $statement;
    }
    public function beginTransaction(){
       $this->GetPdo()->beginTransaction();
    }
    public function commit(){
        $this->GetPdo()->commit();
    }
    public function rollBack(){
        $this->GetPdo()->rollBack();
    }

}
const reforestaDB = new ReforestaDB("database", "reforesta", "dwes","dwes");
?>