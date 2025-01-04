<?php
    function comprobarCampos($campo){
        if(!empty($campo) && isset($campo)){
            $campo = trim($campo);
            $campo = htmlspecialchars($campo);
            $campo = stripslashes($campo);
            return $campo;
        }
        return "";
    }
?>