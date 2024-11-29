<?php
session_start();
    require_once "../views/component/carta.php";
?>
<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>PhotographItem-Responsive Theme</title>

  	<!-- Bootstrap core css -->
  	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  	<!-- Bootstrap core css -->
  	<link rel="stylesheet" type="text/css" href="../css/style.css">
  	<!-- Magnific-popup css -->
  	<link rel="stylesheet" type="text/css" href="../css/magnific-popup.css">
  	<!-- Font Awesome icons -->
  	<link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    .sectionFormulario{
        width:80%; 
        padding:5%;

        & form > input{
            color:#000;
        }
        & form  label{
            color:#fff;
        }
    }
    .fondoFormulario{
        background-color:#000;
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .inicioSesion{
        color:red;
        font-size:2rem;
    }
</style>
<body id="page-top">

<!-- Navigation Bar -->
 <?php
     include 'nav-bar.php'; 
     $fecha = date("Y-m-d");?>
<!-- End of Navigation Bar -->

<!-- Principal Content Start -->
   <div style="background-color:#000; display:flex;justify-content:center;align-items:center;"id="index" class="fondoFormulario">
        <section class="sectionFormulario">
            <div>
                <?php
                    if(isset($_GET['error'])){
                        echo "<p style='color:red;'>".$_GET['error']."</p>";
                    }
                ?>
            </div>
            <form enctype="multipart/form-data" action="../controller/EventAddController.php" method="POST">
                <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="Descripcion">Descripcion</label>
                    <input type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="Descripcion">
                </div>
                <div class="form-group">
                    <label for="Provincia">Provincia</label>
                    <input type="text" class="form-control" id="Provincia" name="Provincia" placeholder="Provincia">
                </div>
                <div class="form-group">
                    <label for="Localidad">Localidad</label>
                    <input type="text" class="form-control" id="Localidad" name="Localidad" placeholder="Localidad">
                </div>
                <div class="form-group">
                    <label for="TipoTerreno">TipoTerreno</label>
                    <select name="TipoTerreno" >
                        <option value="default">No select</option>
                        <option value="Incendio">Incendio</option>
                        <option value="Colina">Colina</option>
                        <option value="Ladera">Ladera</option>
                        <option value="Soto Deteriorado">Soto Deteriorado</option>
                        <option value="Cultivo Abandonado">Cultivo Abandonado</option>
                        <option value="Talud">Talud</option>
                        <option value="Terraplén">Terraplén</option>
                        <option value="Finca Privada">Finca Privada</option>
                        <option value="Erosionado">Erosionado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="TipoEvento">TipoEvento</label>
                    <select name="TipoEvento">
                        <option value="default">No select</option>
                        <option value="Recogida de Semillas">Recogida de Semillas</option>
                        <option value="Reforestación con Árboles Jóvenes">Reforestación con Árboles Jóvenes</option>
                        <option value="Reforestación desde Semillas">Reforestación desde Semillas</option>
                        <option value="Seguimiento de Riego">Seguimiento de Riego</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Fecha">Fecha</label>
                    <input type="date" class="form-control" id="Fecha" name="Fecha" placeholder="Fecha" min="<?=$fecha?>">
                </div>
                <div class="form-group">
                    <label for="FechaAprobacion">FechaAprobacion</label>
                    <input type="date" class="form-control" id="FechaAprobacion" name="FechaAprobacion" placeholder="FechaAprobacion">
                </div>
                <!-- Los participantes se uniran despues de pponerlo pondre un boton para que directamente se una -->
                <!-- <div class="form-group">
                    <label for="participantes">participantes</label>
                    <input type="text" class="form-control" id="participantes" name="participantes" placeholder="participantes">
                </div> -->
                <div class="form-group">
                    <!-- HACER SUN SELECT CON SUS OPCIONES PARA QUE SALGAN LAS ESPECIES Y SI NO HAY ESPECIES BOTON PARA DARLE DE NUEVO 
                
                    <input type="text" class="form-control" id="especies" name="especies" placeholder="especies"> -->
                    <label for="especies">especies</label>
                    <select name="especie" >
                        <option value="default">No select</option>
                        <?php 
                            foreach($species as $specie){
                                echo "<option value='".$specie->NombreCientifico."'>".$specie->NombreCientifico."</option>";
                            }
                        ?>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad de especies</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="cantidad">
                </div>
                <div class="form-group">
                    <label for="imagen">imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" placeholder="imagen">
                </div>
                <?php
                    if(isset($_SESSION['Nickname'])){
                        echo  "<button type='submit' class='btn btn-default'>Enviar</button>";
                    }else{
                        echo "<p class='inicioSesion'>Debes iniciar sesion para poder añadir un evento</p>";
                    }

                ?>
               
            </form>

        </section>
   </div><!-- End of index box -->
   <div style="background-color:#fff; display:flex;justify-content:center;align-items:center;">
            <h1>Filtrado de eventos</h1>
            <!-- filtrar por nombre tipo de terreno tipo de evento -->
             <section class="form-group">
                <form action="../controller/EventFilterController.php" method="POST">
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="TipoTerreno">TipoTerreno</label>
                        <select name="TipoTerreno" >
                            <option value="default">No select</option>
                            <option value="Incendio">Incendio</option>
                            <option value="Colina">Colina</option>
                            <option value="Ladera">Ladera</option>
                            <option value="Soto Deteriorado">Soto Deteriorado</option>
                            <option value="Cultivo Abandonado">Cultivo Abandonado</option>
                            <option value="Talud">Talud</option>
                            <option value="Terraplén">Terraplén</option>
                            <option value="Finca Privada">Finca Privada</option>
                            <option value="Erosionado">Erosionado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="TipoEvento">TipoEvento</label>
                        <select name="TipoEvento">
                            <option value="default">No select</option>
                            <option value="Recogida de Semillas">Recogida de Semillas</option>
                            <option value="Reforestación con Árboles Jóvenes">Reforestación con Árboles Jóvenes</option>
                            <option value="Reforestación desde Semillas">Reforestación desde Semillas</option>
                            <option value="Seguimiento de Riego">Seguimiento de Riego</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Filtrar</button>
             </section>

        </div>
        <h1>Eventos</h1>
        <div style="display:flex;justify-content:center;align-items:center;">
            
            <div  class="tab-pane active" >
                <div class="row popup-gallery">
                    <?php
                    if(isset($eventos)){
                    
                        foreach($eventos as $event){
                            getEvent($event);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

  <!-- Footer -->
   <?php include 'footer.php'; ?>
  <!-- End of Footer -->

   <!-- Jquery -->
   <script type="text/javascript" src="../js/jquery.min.js"></script>
   <!-- Bootstrap core Javascript -->
   <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
   <!-- Plugins -->
   <script type="text/javascript" src="../js/jquery.easing.min.js"></script>
   <script type="text/javascript" src="../js/jquery.magnific-popup.min.js"></script>
   <script type="text/javascript" src="../js/scrollreveal.min.js"></script>
   <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>
