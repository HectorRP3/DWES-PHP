

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
<!-- private $nickname;
    private $nombre;
    private $apellidos;
    private $email;
    private $karma;
    private $suscrito;
    private $fechaCreacion;
    private $ultimaConexion; -->
<!-- Principal Content Start -->
   <div style="background-color:#000; display:flex;justify-content:center;align-items:center;"id="index" class="fondoFormulario">
        <section class="sectionFormulario">
            <div>
                <?php
                    if(isset($_GET['error'])){
                        echo "<p>".$_GET['error']."</p>";
                    }
                ?>
            </div>
            <form action="../controller/UserController.php?action=2" method="POST">
            <div class="form-group">
                <label for="nickname">Nickname</label>
                <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Nickname">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default">Enviar</button>
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
