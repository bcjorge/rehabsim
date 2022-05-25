<?php
session_start();
if(isset($_GET["action"])) {
    /*$action=$_GET["action"];*/
    switch ($_GET["action"]) {
        case "verifylogin":
            $pass = $_POST['password'];
            $user = $_POST['username'];
            $connect = mysqli_connect('localhost', 'root', '', 'database2')
            or die('Error connecting to the server: ' . mysqli_error($connect));
            $sql = 'SELECT * FROM utilizador WHERE username = "' .$user. '" AND password =  "' .hash("sha256", $pass). '"';
            $result = mysqli_query($connect, $sql) or die('The query failed: ' . mysqli_error($connect));
            $row = mysqli_fetch_array($result);
            $number = mysqli_num_rows($result);

            if ($number == 1) {
                $_SESSION['id_utilizador'] = $row['id_utilizador'];
                $_SESSION['authuser'] = 1;
                $_SESSION['username'] = $user;
                $_SESSION['tipo_utilizador']=$row['tipo_utilizador_id'];
                if(isset($_SESSION['tipo_utilizador'])&& $_SESSION['tipo_utilizador']==1){
                    header("Location: pag_admin.php");
                }
                else if (isset($_SESSION['tipo_utilizador'])&& $_SESSION['tipo_utilizador']==2){
                    header("Location: pag_terapeuta.php");
                }
                else if (isset($_SESSION['tipo_utilizador'])&& $_SESSION['tipo_utilizador']==3){

                    header("Location: pag_cuidador.php");
                }
                echo "<script>console.log('debug:".$number."' );</script>";
                echo "<script>console.log('debug:".$_SESSION['tipo_utilizador']."' );</script>";
                echo "<script>console.log('debug:".$_SESSION['id_utilizador']."' );</script>";
                break;
            } else {
                $_SESSION['authuser'] = 0;
                echo "<script>alert('Password ou Utilizador Incorretos');</script>";
                //echo'login incorreto. Password ou Utilizador Incorretos';
                break;
            }
                //echo 'Welcome'.$_SESSION['username']
        case "logout":
            session_unset();
            $_SESSION['authuser'] = 0;
            break;

    }
}
?>

<!DOCTYPE html>
<html lang=”en”>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/images/RehabSIM_logo_colr.png">

    <title>RehabSIM</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!--

TemplateMo 570 Chain App Dev

https://templatemo.com/tm-570-chain-app-dev

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/templatemo-chain-app-dev.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>
<body>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.php" class="logo">
              <img src="assets/images/logo_name_small.png" alt="RehabSIM logo">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="index.php" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#services">Services</a></li>
              <li class="scroll-to-section"><a href="#about">About</a></li>
              <li class="scroll-to-section"><a href="#pricing">Pricing</a></li>
              <li class="scroll-to-section"><a href="#newsletter">Newsletter</a></li>
              <li><div class="gradient-button"><a href="login.php"><i class="fa fa-sign-in-alt"></i> Sign In Now</a></div></li>
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="loginC">
      <div class="service-item">
          <h4>Login de Utilizador</h4>
          <form class="login" method="POST" action="login.php?action=verifylogin">
              <input type="text" name="username" placeholder="Username">
              <input type="password" name="password" placeholder="Password">
              <input class="gradient-button LogButton" type="submit" value="Submit" name="submit">
          </form>
      </div>
  </div>
  </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>