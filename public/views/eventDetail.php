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
    .fondoFormulario{
        background-color:#000;
        display:flex;
        justify-content:center;
        align-items:center;
    }
</style>
<body id="page-top">

<!-- Navigation Bar -->
 <?php include 'nav-bar.php'; ?>
<!-- End of Navigation Bar -->

<!-- Principal Content Start -->
<div style="background-color:#000; display:flex;justify-content:center;align-items:center;"id="index" class="fondoFormulario">
    <section style="padding:30px; color:white" class="sectionFormulario">
        <img style="height:200px" src="<?=$evento->imagen?>" alt="Foto de fondo">
        <h1><?=$evento->Nombre?></h1>
        <p>Descripcion: <?=$evento->Descripcion?></p>
        <p>Provincia:<?=$evento->Provincia?></p>
        <p>Localidad: <?=$evento->Localidad?></p>
        <p>Tipor de terreno: <?=$evento->TipoTerreno?></p>
        <p>Tipo de evento: <?=$evento->TipoEvento?></p>
        <p>Fecha: <?=$evento->Fecha?></p>
        <?php
            $especie = implode(", ", $evento->especies);
        ?>
        <p>Especies: <?=$especie?></p>
    </section> 
</div><!-- End of index box -->
<div style="background-color:#000; display:flex;justify-content:center;align-items:center;">
<section>
        <?php
            if(isset($_GET['error'])){
                echo "<h1 style='color:red'>Error al subir el evento</h1>";
            }
        ?>
        <form action="../controller/EventController.php?action=2&event=<?php echo $evento->EventoID ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$evento->id?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$evento->Nombre?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?=$evento->Descripcion?></textarea>
            </div>
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" class="form-control" id="provincia" name="provincia" value="<?=$evento->Provincia?>" required>
            </div>
            <div class="form-group">
                <label for="localidad">Localidad:</label>
                <input type="text" class="form-control" id="localidad" name="localidad" value="<?=$evento->Localidad?>" required>
            </div>
            <div class="form-group">
                <label for="TipoTerreno">TipoTerreno</label>
                <select name="TipoTerreno" id="TipoTerreno">
                    <option value="default" <?= $evento->TipoTerreno == 'default' ? 'selected' : '' ?>>No select</option>
                    <option value="Incendio" <?= $evento->TipoTerreno == 'Incendio' ? 'selected' : '' ?>>Incendio</option>
                    <option value="Colina" <?= $evento->TipoTerreno == 'Colina' ? 'selected' : '' ?>>Colina</option>
                    <option value="Ladera" <?= $evento->TipoTerreno == 'Ladera' ? 'selected' : '' ?>>Ladera</option>
                    <option value="Soto Deteriorado" <?= $evento->TipoTerreno == 'Soto Deteriorado' ? 'selected' : '' ?>>Soto Deteriorado</option>
                    <option value="Cultivo Abandonado" <?= $evento->TipoTerreno == 'Cultivo Abandonado' ? 'selected' : '' ?>>Cultivo Abandonado</option>
                    <option value="Talud" <?= $evento->TipoTerreno == 'Talud' ? 'selected' : '' ?>>Talud</option>
                    <option value="Terraplén" <?= $evento->TipoTerreno == 'Terraplén' ? 'selected' : '' ?>>Terraplén</option>
                    <option value="Finca Privada" <?= $evento->TipoTerreno == 'Finca Privada' ? 'selected' : '' ?>>Finca Privada</option>
                    <option value="Erosionado" <?= $evento->TipoTerreno == 'Erosionado' ? 'selected' : '' ?>>Erosionado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="TipoEvento">TipoEvento</label>
                <select name="TipoEvento" id="TipoEvento">
                    <option value="default" <?= $evento->TipoEvento == 'default' ? 'selected' : '' ?>>No select</option>
                    <option value="Recogida de Semillas" <?= $evento->TipoEvento == 'Recogida de Semillas' ? 'selected' : '' ?>>Recogida de Semillas</option>
                    <option value="Reforestación con Árboles Jóvenes" <?= $evento->TipoEvento == 'Reforestación con Árboles Jóvenes' ? 'selected' : '' ?>>Reforestación con Árboles Jóvenes</option>
                    <option value="Reforestación desde Semillas" <?= $evento->TipoEvento == 'Reforestación desde Semillas' ? 'selected' : '' ?>>Reforestación desde Semillas</option>
                    <option value="Seguimiento de Riego" <?= $evento->TipoEvento == 'Seguimiento de Riego' ? 'selected' : '' ?>>Seguimiento de Riego</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?=$evento->Fecha?>" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control" id="imagen" name="imagen" value="<?=$evento->ImagenURL?>">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Evento</button>
        </form>
    </section>
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
