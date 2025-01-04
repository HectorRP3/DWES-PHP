<?php
    require_once("conexion.php");
    require_once("comprobar.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre=comprobarCampos($_POST['name']);
        $correo=comprobarCampos($_POST['email']);
        $telefono=comprobarCampos($_POST['phone']);
        if($nombre=="" || $correo==""  || $telefono=="" ){
            header("location: form_update_contact.php");
            exit();
        }else{
            $id=$_POST['id'];
            $insert = $pdo->prepare("UPDATE contactos SET name=:name, phone=:phone, email=:email WHERE id=:id");
            $insert->bindParam(":id",$id);
            $insert->bindParam(":name",$nombre);
            $insert->bindParam(":email",$correo);
            $insert->bindParam(":phone",$telefono);   
            $insert->execute();
            $pdo = null;
        }
        
    }

    header("location: ./index.php")

?>