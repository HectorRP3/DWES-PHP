<!-- Navigation Bar -->
 <?php
    //require_once "../controller/UserController.php";
 ?>
   <nav class="navbar navbar-fixed-top navbar-default">
     <div class="container">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a  class="navbar-brand page-scroll" href="#page-top">
              <img style="width:40px" src="../images/logo/reforesta.png" alt="Reforesta" class="img-responsive">
            </a>
         </div>
         <div class="collapse navbar-collapse navbar-right" id="menu">
            <ul class="nav navbar-nav">
              <li class=" lien"><a href="../controller/HomeController.php"><i class="fa fa-home sr-icons"></i> Home</a></li>
              <li class=" lien"><a href="../controller/EventController.php?action=6"><i class="fa fa-cogs sr-icons"></i> Events</a></li>
              <li class=" lien"><a href="../controller/UserController.php?action=2"><i class="fa fa-user sr-icons"></i> User</a></li>
              <li class=" lien"><a href="../controller/SpecieController.php?action=1"><i class="fa fa-leaf">Species</a></i>
              <li class=" lien"><a href="../controller/SpecieController.php?action=3"><i class="fa fa-trophy sr-icons"></i> Logros</a></li>
              <li class=" lien"><a href="../controller/EventController.php?action=5"><i class="fa fa-calendar sr-icons"></i> Calendar</a></li>
              <li class=" lien"><a href="../views/about.php"><i class="fa fa-bookmark sr-icons"></i> About</a></li>
              <li class=" lien"><a href="blog.html"><i class="fa fa-file-text sr-icons"></i> Blog</a></li>
              <li class=" lien"><a href="../views/contact.php"><i class="fa fa-phone-square sr-icons"></i> Contact</a></li>
              <!-- este siguiente punto que salga la foto y el nombre del usuairo si se ha loguueado -->
               <?php
                if(isset($_SESSION['nickname'])){
                  
                  echo '<li><a href="../controller/UserController.php?action=4">'.$_SESSION['nickname'].'</a></li>';
                }else{
                  echo '<li><a href="../controller/UserController.php?action=3"><i class="fa fa-sign-in sr-icons"></i>Login</a></li>';
                }                
                ?>
            </ul>
         </div>
     </div>
   </nav>
<!-- End of Navigation Bar -->