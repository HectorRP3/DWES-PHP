<?php
    session_start();
    require_once '../model/user.php';
    require_once "../model/event.php";
    require_once 'validate.php';
    if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])){
        $karma = User::getKarma($_SESSION['nickname']);
    }
   /**
    * Funcion que se encarga de añadir un usuario a la base de datos
    * Si algun campo no es correcto se le redirige a userAdd.php
    */
    function addUser(){
        $name = $_POST['nombre'];
        $nickname = $_POST['nickname'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $variables = [
            validateCampo($name),
            validateCampo($nickname),
            validateCampo($apellidos),
            validateEmail($email),
            validateCampo($password),
        ];

        $password = hash('sha256',$password);

        if(in_array(false,$variables)){
            require_once "../views/userAdd.php?error=2";
        }
        $fechaCreacion = date("Y-m-d");

        $user = new User($nickname,$name,$apellidos,$email,0,0,$fechaCreacion,$password);


        $user->addUser();
        
        header("Location: ./HomeController.php");
    }
    /**
     * Funcion que se encarga de loguear al usuario
     * Si el usuario y la contraseña son correctos se le redirige a home.php
     */
    function enterUser(){
        $nickname = $_POST['nickname'];
        $password  = $_POST['password'];


        $nickname = cleanCampo($nickname);

        $password = hash('sha256',$password);


        //select hacia usuario para ver si cuadran devolver true o false para comprobar si es el mismo y llevar hacia home.php si devuleve true hacer uan session
        $user = new User($nickname, null, null, null, null, null, null,$password);
        if($user->checkUserPassword($nickname,$password)){
            $_SESSION['nickname'] = $nickname;
            header("location:./HomeController.php");
        }else{
            require_once "../views/login.php";
        }
    }
    function modificacionUser(){
       
        if(isset($_GET['user'])&&$_GET['user']==1){
            $password = $_POST['password'];
            $password = hash('sha256',$password);
            $nickname = $_SESSION['nickname'];
           
            User::updatePassword($nickname,$password);
            session_write_close();
            header("location:./HomeController.php");
        }else{
            $name = $_POST['name'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $nickname = $_POST['nickname'];
            $nick= $_SESSION['nickname'];
            $variables = [
                validateCampo($name),
                validateCampo($apellidos),
                validateEmail($email),
            ];
            if(in_array(false,$variables)){
                require_once "../views/userOptions.php";
            }
            User::updateUser($nick,$nickname,$name,$apellidos,$email);
            $_SESSION['nickname'] = $nickname;
            session_write_close();
            header("location:./HomeController.php");
        }

    }
    /**
     * Funcion que se encarga de unir a un usuario a un evento
     * Si el usuario ya esta unido al evento se le redirige a home.php
     */
    function followEvent(){
        $nickname = $_SESSION['nickname'];
        $evento = $_GET['event'];
        $karma = User::getKarma($nickname);
        $karma = $karma + 2;
        if(Evento::checkParticipacion($nickname,$evento)){
            session_write_close();
            header("location:./HomeController.php");
        }else{
           
            Evento::participarEvento($nickname,$evento);
            User::updateKarma($nickname,$karma);
            session_write_close();
            header("location:./HomeController.php");
        }
       
    }

     if(isset($_GET['action']) && !empty($_GET['action'])){
        $action=$_GET['action'];
    }else{ 
        $action=1;
    }
    switch($action){
        case "2":
            //Alta de usuario
            if($_SERVER['REQUEST_METHOD']=="POST"){
                addUser();
            }else{
                require_once "../views/userAdd.php";
            }
            session_write_close();
            break;
        case "3":
            //Login usuario
            if($_SERVER['REQUEST_METHOD']=="POST"){
                enterUser();
            }else{
                require_once "../views/login.php";
            }
            break;
        case "4":
            //Consulta de datos
            $user = User::getUser($_SESSION['nickname']);
            require_once "../views/userOptions.php";
            session_write_close();
            break;
        case "5":
            //Modificacion de datos
            modificacionUser();
            break;
        case "6":
            //Unirse a un evento
            followEvent();
            break;
        case "7":
            //Suscripcion al newsletter    
            if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])){
                $karma = User::getKarma($_SESSION['nickname']);
                $karma = $karma + 1;
                User::updateSuscripcion($_SESSION['nickname']);
                User::updateKarma($_SESSION['nickname'],$karma);
            }
            session_write_close();
            header("location:./HomeController.php");
            break;
        case "8":
           //Logout
            $_SESSION = array();
            session_destroy();
            header("location:./HomeController.php");
            break;
    }
?>