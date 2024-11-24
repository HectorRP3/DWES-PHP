<?php
    require_once "../model/user.php";
    //$_SESSION['userNick']="pepe"
    // enviar por post el karma del usuario
        // $karma = $_POST['karma'];
    if(isset($_SESSION['Nickname'])){
        $karma = User::getKarma($_SESSION['Nickname']);
    }
?>