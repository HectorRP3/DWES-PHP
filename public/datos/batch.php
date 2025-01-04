<?php
    require_once("conexion.php");

    
    try{
        $pdo->beginTransaction();
        $pdo->query("UPDATE contactos SET name='hol1a', phone='telefono2', email='hola@mail.com' WHERE id=31");
        $pdo->query("UPDATE contactos SET name='hola', phone='telefono2', email='hola@mail.com'  WHERE id=29");
        $pdo->query("UPDATE contactos SET name='hola', phone='telefono2', email='hola@mail.com'  WHERE id=28");
        $pdo->query("UPDATE contactos SET name='hol1a', phone='telefono2', email='hola@mail.com'  WHERE id=27");
        $pdo->query("UPDATE contactos SET name='hola', phone='telefono2', email='hola@mail.com'  WHERE id=26");
        $pdo->commit();
    }catch(Exception $e){
        $pdo->rollBack();
        echo "Error: ".$e->getMessage();
    }
    header("location: index.php");
   
?>