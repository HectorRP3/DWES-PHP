

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
                <form enctype="multipart/form-data" action="../controller/UserController.php?action=5" method="POST">
                   <div class="form-group">
                        <label for="nickname">Nickname</label>
                        <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Nickname" value="<?php echo $user->__get("nickname") ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $user->__get("nombre") ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php echo $user->__get("apellidos")?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user->__get("email") ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                   
                </form>
                <form action="../controller/UserController.php?action=5&user=1" method="POST">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Password</button>
                </form>
                    <h1 style="color:white">Tu KARMA</h1>
                    <p style="color:white"><?php echo $user->__get("karma") ?></p>
            </section>
                <a href="../controller/UserController.php?action=8" class="btn btn-danger">Log out</a>
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
