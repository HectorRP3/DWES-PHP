<?php
    require_once "../model/user.php";
    require_once "../controller/ValidatorController.php";
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $validate = [validateCampo($password), validateCampo($password2)];
        $password = hash('sha256', $password);
        if($password == $password2){
            array_push($validate, true);
        }else{
            array_push($validate, false);
        }
        if(array_search(false, $validate)){
            header("Location:../views/userEdit.php?error");
        }
        $email = cleanCampo($email);
        $password = cleanCampo($password);
        User::updateUser($_SESSION['Nickname'],$email, $password);
        header("Location:./HomeController.php");
    }

?>