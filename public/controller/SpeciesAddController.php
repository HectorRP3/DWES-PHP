<?php
    require_once "../controller/ValidatorController.php";
    require_once "../model/specie.php";
    require_once "../model/user.php";   

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nombreCientifico=$_POST['NombreCientifico'];
        $beneficios=$_POST['Beneficios'];
        $nombreComun=$_POST['NombreComun'];
        $descripcion=$_POST['Descripcion'];
        $clima=$_POST['Clima'];
        $regionOrigen=$_POST['RegionOrigen'];
        $tiempoMaduracion=$_POST['TiempoMaduracion'];
    

        $validate = [
            validateCampo($nombreCientifico),
            validateCampo($beneficios),
            validateCampo($nombreComun),
            validateCampo($descripcion),
            validateCampo($clima),
            validateCampo($regionOrigen),
            validateCampo($tiempoMaduracion), 
            validateInt($beneficios),
            validateInt($tiempoMaduracion),     
        ];


        if(is_uploaded_file($_FILES['imagenUrl']['tmp_name']) && $_FILES['imagenUrl']['type']== 'image/png'){
            $nombreDirectorio = "../images/species/";
        
            $nombreFichero = $_FILES['imagenUrl']['name'];
            move_uploaded_file($_FILES['imagenUrl']['tmp_name'],$nombreDirectorio.$nombreFichero);
            $imagen = $nombreDirectorio.$nombreFichero;
        }else{
            $error = "Error en la subida de la imagen";
            array_push($validate, false);
        }
         
        if(in_array(false, $validate)){
            Header("Location: ../views/speciesAdd.php?error=error");
        }


        $nombreCientifico = cleanCampo($nombreCientifico);
        $beneficios = cleanCampo($beneficios);
        $nombreComun = cleanCampo($nombreComun);
        $descripcion = cleanCampo($descripcion);
        $clima = cleanCampo($clima);
        $regionOrigen = cleanCampo($regionOrigen);
        $tiempoMaduracion = cleanCampo($tiempoMaduracion);

        $specie = new Especie($nombreCientifico,$beneficios,$nombreComun,$descripcion,$clima,$regionOrigen,$tiempoMaduracion,$imagen);
        $specie->addSpecie();
        $karma = User::getKarma($_SESSION['Nickname']);
        $karma = $karma + 3;
        User::updateKarma($_SESSION['Nickname'], $karma);
       
        Header("Location: ./HomeController.php");

    }