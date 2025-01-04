<?php
    require_once("conexion.php");
    require_once("comprobar.php");


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre=comprobarCampos($_POST['name']);
        $correo=comprobarCampos($_POST['email']);
        $telefono=comprobarCampos($_POST['phone']);
        if($nombre=="" || $correo==""  || $telefono=="" ){
            header("location: form_new_contact.php");
            exit();
        }else{
        
            $insert = $pdo->prepare("INSERT INTO contactos(name,email,phone)VALUES(:name,:email,:phone)"); 
            $insert->bindParam(":name",$nombre);
            $insert->bindParam(":email",$correo);
            $insert->bindParam(":phone",$telefono);   
            $insert->execute();
            $pdo = null;
        }
        
    }

    header("location: form_new_contact.php")

?>