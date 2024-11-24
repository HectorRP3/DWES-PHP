<?php
    include_once "../model/specie.php";

    $species = Especie::GetAll();

    require_once "../views/eventAdd.php";
?>