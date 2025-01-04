<?php
    require_once "../views/component/carta-Species.php";
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
<div style="background-color:#000; display:flex;justify-content:center;align-items:center;" class="fondoFormulario">
    <h2 style="color:white">Species que han participado o que van a participar en los siguiente eventos</h2>
</div>
<!-- Principal Content Start -->
   <div style="background-color:#000; display:flex;justify-content:center;align-items:center;"id="index" class="fondoFormulario">
    
        <section class="sectionFormulario">
        <div id="category2" class="tab-pane">
              <div class="row popup-gallery">
                <?php
                  foreach ($species as $specie) {
                    getSpecie($specie); 
                  }
                ?>
              </div>
        </div>

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
