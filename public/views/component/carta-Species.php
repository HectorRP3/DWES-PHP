
<?php
    function getSpecie($specie){

?>
<head>
    <link rel="stylesheet" href="css/card.css">
</head>
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="sol">
        <img style="height:200px" class="img-responsive" src="<?php echo $specie->ImagenURL?>" alt="First category picture">
        <div class="behind">
          <div class="head text-center">
                <ul class="list-inline">
                <li>
                    <a class="gallery" href="<?php echo "$specie->ImagenURL"?>" data-toggle="tooltip" data-original-title="Quick View">
                    <i class="fa fa-eye"></i>
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="tooltip" data-original-title="<?=$specie->NombreCientifico?>">
                    <i class="fa fa-info"></i>
                    </a>
                </li>
                <li class="lien">
                    <a href="../controller/SpecieController.php?action=2&specie=<?=$specie->NombreCientifico?>" data-toggle="tooltip" data-original-title="Ver detalle">
                    <i class="fa fa-eye"></i>
                    </a>
                </ul>
            </div>
            <div class="row box-content">
                <!-- <ul class="list-inline text-center">
                <li><i class="fa fa-eye"></i> 1000</li>
                <li><i class="fa fa-heart"></i> 500</li>
                <li><i class="fa fa-download"></i> 100</li>
                </ul> -->
                <h4  style="color: white" class="text-center"><?php echo $specie->NombreCientifico?></h4>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>