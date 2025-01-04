
<?php
    function getEvent($event){

?>
<head>
    <link rel="stylesheet" href="css/card.css">
</head>
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="sol">
        <img style="height:200px" class="img-responsive" src="<?php echo $event->imagen?>" alt="First category picture">
        <div class="behind">
          <div class="head text-center">
                <ul class="list-inline">
                <li>
                    <a class="gallery" href="<?php echo "$event->imagen"?>" data-toggle="tooltip" data-original-title="Quick View">
                    <i class="fa fa-eye"></i>
                    </a>
                </li>
                <?php if(isset($_SESSION['nickname'])){ ?>
                <li>
                    <a href="../controller/UserController.php?action=6&event=<?=$event->EventoID?>" data-toggle="tooltip" data-original-title="Unirte al evento">
                        <i class="fa fa-heart"></i>
                    </a>
                    </li>';
                <li>
                <?php } ?>	
                    <a href="#" data-toggle="tooltip" data-original-title="<?=$event->Nombre?>">
                    <i class="fa fa-info"></i>
                    </a>
                </li>
                <li>
                    <a href="../controller/EventController.php?action=3&event=<?=$event->EventoID?>" data-toggle="tooltip" data-original-title="Ver detalle">
                    <i class="fa fa-eye"></i>
                    </a>
                </li>
                <?php
                    if(isset($_SESSION['Nickname'])){
                        if($_SESSION['Nickname'] == $event->AnfitrionID){
                            echo "<li>";
                            echo  "<a href='../controller/DeleteEventoController.php?event=$event->EventoID' data-toggle='tooltip' data-original-title='Eliminar evento'>";
                            echo "<i class='fa fa-trash'></i>";
                            echo "</a>";
                            echo "</li>";
                        }
                    }
                ?>
                </ul>
            </div>
            <div class="row box-content">
                <!-- <ul class="list-inline text-center">
                <li><i class="fa fa-eye"></i> 1000</li>
                <li><i class="fa fa-heart"></i> 500</li>
                <li><i class="fa fa-download"></i> 100</li>
                </ul> -->
                <h4  style="color: white" class="text-center"><?php echo $event->Nombre?></h4>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>