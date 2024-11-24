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
        <section style="color:white; padding:10px" class="sectionFormulario">
           <h1>Logros</h1>
            <p>En esta sección se mostrarán los logros que se han conseguido en reforesta</p>
            <h1>Evento con mas participantes</h1>
            <p>El evento con mas participantes fue el evento <?=$eventoCompleto->Nombre?> con <?=$evento['COUNT(UserID)']?></p>
            <h1>Usuario con mas Karma</h1>
            <p>El usuario con mas karma es <?=$usuario['Nickname']?> con <?=$usuario['Karma']?></p>
            <h1>Specie con mas cantidad de plantados</h1>
            <p>La especie con mas cantidad de plantados es <?=$especie->NombreCientifico?></p>
            <img style="height:200px" src="<?=$especie->ImagenURL?>" alt="Foto de especie">
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
