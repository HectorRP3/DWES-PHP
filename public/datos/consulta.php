<?php
    require_once("conexion.php");

    $consulta = $pdo->prepare("SELECT * FROM contactos;");
    $consulta->execute();  
?>