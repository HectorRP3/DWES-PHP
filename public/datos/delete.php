<?php
    require_once("conexion.php");
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id=$_POST['id'];
    if($id=="" ){
        header("location: form_delete_contact.php");
        exit();
    }else{
            $id=$_POST["id"];
            $delete = $pdo->prepare("DELETE FROM contactos WHERE id=:id");
            $delete->bindParam(":id",$id);
            $delete->execute();
            $pdo = null;
        header("location: form_delete_contact.php");
    }
    }
?>