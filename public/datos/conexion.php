<?php
    $host = 'database';
    $nombreBD = 'ejercicios_6_PDO';
    $user = 'dwes';
    $password = 'dwes';

    try{
        $pdo = new PDO("mysql:host=$host;dbname=$nombreBD;charset=utf8",$user,$password);
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>