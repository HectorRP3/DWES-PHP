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
        padding:10%;

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
</style>
<body id="page-top">
<!-- Navigation Bar -->
 <?php include 'nav-bar.php'; ?>
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
            <form enctype="multipart/form-data" action="../controller/SpeciesAddController.php" method="POST">
            <div class="form-group">
                <label for="NombreCientifico">Nombre Cientifico</label>
                <input type="text" class="form-control" id="NombreCientifico" name="NombreCientifico" placeholder="Nombre Cientifico">
            </div>
            <div class="form-group">
                <label for="Beneficios">Beneficios</label>
                <input type="text" class="form-control" id="Beneficios" name="Beneficios" placeholder="Beneficios">
            </div>
            <div class="form-group">
                <label for="NombreComun">Nombre Comun</label>
                <input type="text" class="form-control" id="NombreComun" name="NombreComun" placeholder="Nombre Comun">
            </div>
            <div class="form-group">
                <label for="Descripcion">Descripcion</label>
                <input type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="Descripcion">
            </div>
            <div class="form-group">
                <label for="Clima">Clima</label>
                <input type="text" class="form-control" id="Clima" name="Clima" placeholder="Clima">
            </div>
            <div class="form-group">
                <label for="RegionOrigen">Region Origen</label>
                <input type="text" class="form-control" id="RegionOrigen" name="RegionOrigen" placeholder="Region Origen">
            </div>
            <div class="form-group">
                <label for="TiempoMaduracion">Tiempo Maduracion</label>
                <input type="text" class="form-control" id="TiempoMaduracion" name="TiempoMaduracion" placeholder="Tiempo Maduracion">
            </div>
            <div class="form-group">
                <label for="imagenUrl">Imagen URL</label>
                <input type="file" class="form-control" id="imagenUrl" name="imagenUrl" placeholder="Imagen URL">
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
