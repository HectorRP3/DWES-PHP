<?php
    require_once "../model/user.php";
    $karma = User::getKarma($_SESSION['Nickname']);
    $karma = $karma + 1;
    User::updateSuscripcion($_SESSION['Nickname']);
    User::updateKarma($_SESSION['Nickname'],$karma);
    header("location:./HomeController.php");

?>