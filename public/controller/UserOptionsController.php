<?php
   session_start();
    unset($_SESSION['Nickname']);
    $_SESSION = array();
    session_destroy();
    header("location:./HomeController.php");
?>