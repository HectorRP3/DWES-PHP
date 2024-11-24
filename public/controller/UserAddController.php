<?php
    require_once "../controller/ValidatorController.php";
    require_once "../model/user.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nickName=$_POST['nickname'];
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        $password = hash('sha256',$password);

        $validate = [
            validateCampo($nombre),
            validateCampo($nickName),
            validateCampo($apellidos),      
        ];

        if(!validateEmail($email)){
            $error="Error de email";
            array_push($validate,false);
        }

        
        $nombre = cleanCampo($nombre);
        $nickName = cleanCampo($nickName);
        $apellidos = cleanCampo($apellidos);
        // fecha de creacion
        // ultima conexion
        $fechaCreacion = strval(date("Y-m-d"));
        
        $user = new User($nickName,$nombre,$apellidos,$email,0,0,$fechaCreacion,$password);

        $user->addUser();
        // ver incorporar en la especies
        header("Location: ./HomeController.php");

    }


?>