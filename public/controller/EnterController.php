<?php
    session_start();
    require_once "../model/user.php";
    require_once "./ValidatorController.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nickname = $_POST['nickname'];
        $password  = $_POST['password'];

        // if(validateCampo($nickname)){
        //     header("location: ../views/login.php?error");
        // }

        $nickname = cleanCampo($nickname);

        $password = hash('sha256',$password);


        //select hacia usuario para ver si cuadran devolver true o false para comprobar si es el mismo y llevar hacia home.php si devuleve true hacer uan session
        $user = new User($nickname, null, null, null, null, null, null,$password);
        if($user->checkUserPassword($nickname,$password)){
            
            $_SESSION['Nickname'] = $nickname;
            header("location:./HomeController.php");
        }else{
            header("location:./LoginController.php?error=error");
        }
    }
?>