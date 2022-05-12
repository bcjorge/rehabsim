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
    <link rel="stylesheet" href="assets/css/pag.css">
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
              <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
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

  <div class="containerInfo">
    <div class="text">
      <h4>Administrador</h4>
      <h1>Eugénio Andrade</h1>
    </div>
    <div class="containerBlocks">
      <div class="profile">
        <h4>Informação do Utilizador</h4>
          <div class="row">
            <div class="column c1">
              <input type="text" placeholder="Username">
              <input type="text" placeholder="Nome">
              <input type="password" placeholder="Password">
            </div>
            <div class="column c2">
              <input type="text" placeholder="Morada">
              <input type="email" placeholder="Email">
              <input type="number" placeholder="Telemovel">
            </div>
            <div class="column c3">
              <label for="img">Imagem de Perfil</label>
              <input type="file" id="img" name="img" accept="image/*">
              <div class="gradient-button savButton"><a href="login.php">Salvar Alterações</a></div>
            </div>
          </div>
      </div>
      <div class="pac">
        <h4>Registo Novo Utilizador</h4>
        <div class="formPaciente">
            <div class="column c1">
                <input type="text" placeholder="Nome"></p>
                <input type="text" placeholder="Morada"></p>
                <input type="text" placeholder="Telemovel"></p>
                <input type="number" placeholder="Email">
            </div>
            <div class="column c2">
                <p><label>Tipo de Utilizador:</label></p>
                <select class="funcaoInput" name="funcao" id="funcao">
                    <option hidden disabled selected value> -- selecione uma opção -- </option>
                    <option value="Admin">Administrador</option>
                    <option value="Te">Terapeuta</option>
                    <option value="Cg">Cuidador</option>
                </select>
                <input type="text" placeholder="Username">
                <input type="text" placeholder="Password">
            </div>
            <div class="column c3">
                <label for="img">Imagem de Perfil</label>
                <input type="file" id="img" name="img" accept="image/*">
                <div class="gradient-button savButton"><a href="login.html">Registar Paciente</a></div>
            </div>
      </div>
      </div>
      <div class="pl">
          <h4> Procurar Utilizador existente</h4>
          <div class="formPaciente">
              <input type="text" placeholder="ID utilizador">
              <h5  class="gradient-button savButton"  > <a href="login.php">Procurar</a></h5>

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
