<?php
  require_once "../views/component/carta.php"; 
  require_once "../views/component/carta-Species.php";
?>
<!DOCTYPE html>  

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>ReforestaDB</title>
    <link rel="icon" type="image/png" href="../images/logo/reforesta.png">

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
<body id="page-top">

<!-- Navigation Bar -->
 <?php include 'nav-bar.php'; 
 ?>
<!-- End of Navigation Bar -->

<!-- Principal Content Start -->
   <div id="index">

    <!-- Header -->
      <div class="row">
         <div class="col-xs-12 intro">
            <div class="carousel-inner">
               <div class="item active">
                <img class="imgHeader img-responsive" src="../images/imagenHeader.webp" alt="header picture">
               </div>
               <div class="carousel-caption">
                  <h1>REFORESTA</h1>
                  <hr>
               </div>
            </div>
         </div>
      </div>

      <div id="index-body">
      <!-- Pictures Navigation table -->
        <div class="table-responsive">
          <table class="table text-center">
            <thead>
              <tr>
                <td><a class="link active" href="#category1" data-toggle="tab">Eventos</a></td>
                <td><a class="link" href="#category2" data-toggle="tab">Species</a></td>
              </tr>
            </thead>
          </table>
          <hr>
        </div>
      
      <!-- Navigation Table Content -->
    <div class="tab-content">

        <!-- First Category pictures -->
        <div id="category1" class="tab-pane active" >
              <div class="row popup-gallery">

                        <!-- aqui van las cartas -->
                        <!-- bucle con la cartas -->
                <?php
                  foreach ($events as $event) {
                    getEvent($event); 
                  }
                ?>
              </div>
        </div>
        <div id="category2" class="tab-pane">
              <div class="row popup-gallery">
                <?php
                  foreach ($species as $specie) {
                    getSpecie($specie); 
                  }
                ?>
              </div>
        </div>
                  <!-- esto para poner mas paginas ya veremos -->
                        <!-- <nav class="text-center">
                          <ul class="pagination">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#" aria-label="suivant">
                              <span aria-hidden="true">&raquo;</span>
                            </a></li>
                          </ul>
                        </nav> -->
        <!-- End of First category pictures -->
      </div>
      <!-- End of Navigation Table Content -->
    </div><!-- End of Index-body box -->
    <!-- Newsletter form -->
      <div class="index-form text-center">
        <h3>SUSCRIBE TO OUR NEWSLETTER </h3>
        <h5>Suscribe to receive our News and Gifts</h5>
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-4 col-md-push-4">
         

            <?php
                if($suscripcion){
                    echo '<p style="font-size:2rem; color: red" class="text-center">Ya estas suscrito</p>';
                  
                }else if(isset($_SESSION['nickname'])){
                    echo '<a href="../controller/UserController.php?action=7" class="btn btn-lg sr-button">SUBSCRIBE</a>';
                }else{

                  echo '<a href="../controller/UserController.php?action=3" class="btn btn-lg sr-button2">Inicia Sesión</a>';
                }
            ?>
            </div>
          </div>
        </form>
      </div>

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
