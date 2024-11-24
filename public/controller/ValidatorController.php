<?php

    function validateCampo($campo){
        if(isset($campo) && !empty($campo)){
            return true;
        }else{
            return false;
        }
    }
    function validateEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
    // public  function validateFecha($fecha){
    //     if(strtotime($fecha)){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
    function cleanCampo($campo){
        $campo = trim($campo);
        $campo = stripslashes($campo);
        $campo =htmlspecialchars($campo);
        return $campo;
    }
    function validateInt($campo){
        if(filter_var($campo, FILTER_VALIDATE_INT)){
            return true;
        }else{
            return false;
        }
    }



?>