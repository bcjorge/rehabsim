<?php
session_start();
if (isset($_SESSION["authuser"])&&$_SESSION["authuser"]==1) {
    $id_user = $_SESSION['id_utilizador'];
    // $pageNumber = $_GET['pageNumber'];
    // $pageSize = $_GET['pageSize'];
    //$nome =$_GET['nome'];
    //$morada = $_GET['morada'];
    //$tel = $_GET['telemovel'];
    //$email = $_GET['email'];

    $connect = mysqli_connect('localhost', 'root', '', 'database2')
    or die('Error connecting to the server: ' . mysqli_error($connect));
    $sql = 'SELECT * FROM utilizador WHERE utilizador.id_utilizador="' . $id_user . '"';
    $result = mysqli_query($connect, $sql) or die('The query failed: ' . mysqli_error($connect));
    echo "<script>console.log('ola');</script>";
    echo "<script>console.log('debug:" . $id_user . "' );</script>";
    echo "<script>console.log('debug:" . $_SESSION["authuser"] . "' );</script>";
    //echo "<script>console.log('debug:".$result."' );</script>";
    //echo "<script>console.log('debug:".$id_user."' );</script>";
}
if (isset($_SESSION["authuser"])&&$_SESSION["authuser"]==1){
    //$pesquisa = $_POST['pesquisa'];
            //$connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
            $sql_ut = 'SELECT * FROM utilizador ORDER BY tipo_utilizador_id';
            $result_ut = mysqli_query($connect, $sql_ut) or die('The query failed: ' . mysqli_error($connect));
            echo "<script>console.log('ola');</script>";
            //echo "<script>console.log('debug:".$result_ut['nome']."' );</script>";
            $num_results = mysqli_num_rows($result_ut);
            //$rows = mysqli_fetch_array($result_ut);

            if ($num_results == 0) {
                echo "Não Existem Utilizadores para Listar.";
            } /*else if ($num_results == 1) {
                echo "<script>console.log('adeus' );</script>";
                echo "<script>console.log('debug:". $_SESSION['num_saude']."' );</script>";
                header("Location: perfil_paciente.php");*/

}
/*if (isset($_SESSION["authuser"])&&$_SESSION["authuser"]==1) {
    if (isset($_POST["registar_utilizador"])) {
        if (isset($_POST["Admin"])) {
            $acao = "admin.php?action=pag_admin";
        } else if (isset($_POST["Te"])) {
            $acao = "admin.php?action=pag_terapeuta";
        } else if (isset($_POST["Cg"])) {
            $acao = "admin.php?action=pag_cuidador";
        }
        $nome_utilizador=$_POST['nome'];
        $morada_utilizador=$_POST['morada'];
        $telemovel_utilizador=$_POST['telemovel'];
        $email_utilizador=$_POST['email'];
        $tipo_utilizador=$_POST['funcao'];
        $username_utilizador=$_POST['username'];
        $pass_utilizador=hash("sha256", $_POST['password']);
        $imagem=$_FILES['img']["name"];
        $tempname = $_FILES["img"]["tmp_name"];
        $folder = "C:\wamp64\www\projecto\rehabsim\rehabsim\image/".$imagem;

        $connect = mysqli_connect('localhost', 'root', '', 'database2')
        or die('Error connecting to the server: ' . mysqli_error($connect));
        $insert_user = 'INSERT INTO  utilizador (nome, morada,telemovel, email, username,password, tipo_utilizador_id) VALUES ("'.$nome_utilizador.'","'.$morada_utilizador.'","'.$telemovel_utilizador.'","'.$email_utilizador.'","'.$tipo_utilizador.'","'.$username_utilizador.'","'.$pass_utilizador.'","'.$imagem.'",)';
        $result_user = mysqli_query($connect, $insert_user) or die('The query failed: ' . mysqli_error($connect));
        if (move_uploaded_file($tempname))  {
            echo "Upload bem sucedido!";
        }else{
            echo "<script>alert('O upload da imagem falhou ');</script>";
        }
    }
}*/
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
              <li class="scroll-to-section"><a href="index.php" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#services">Services</a></li>
              <li class="scroll-to-section"><a href="#about">About</a></li>
              <li class="scroll-to-section"><a href="#pricing">Pricing</a></li>
              <li class="scroll-to-section"><a href="#newsletter">Newsletter</a></li>
                <li><div class="gradient-button"><a href="login.php?action=logout"><i class="fa fa-sign-in-alt"></i> Logout</a></div></li>
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
          <?php while ($data=mysqli_fetch_array($result)){ ?>
          <div class="text">
              <h4>Administrador</h4>
              <h1><?php echo $data['nome']?></h1>
          </div>
          <div class="containerBlocks">
              <div class="profile">
                  <h4>Informação do Utilizador</h4>
                  <div class="row">
                      <div class="column c1">
                          <input type="text" value="<?php echo $data['username']?>">
                          <input type="text" value="<?php echo $data['nome']?>">
                          <input type="password" value="<?php echo $data['password']?>">
                      </div>
                      <div class="column c2">
                          <input type="text" value="<?php echo $data['morada']?>">
                          <input type="email" value="<?php echo $data['email']?>">
                          <input type="number" value="<?php echo $data['telemovel']?>">
                      </div>
                      <div class="column c3">
                          <label for="img">Imagem de Perfil</label>
                          <input type="file" id="img" name="img" accept="image/*">
                          <div class="gradient-button savButton"><a href="login.php">Salvar Alterações</a></div>
                      </div>
                      <?php } ?>
                  </div>
      </div>
      <div class="pac">
        <h4>Registo Novo Utilizador</h4>
        <div class="formPaciente" method="POST" action="admin.php?action=pag_admin" enctype="multipart/form-data">
            <div class="column c1">
                <input type="text" name= "nome" placeholder="Nome"></p>
                <input type="text" name= "morada" placeholder="Morada"></p>
                <input type="text"  name= "telemovel" placeholder="Telemovel"></p>
                <input type="email" name= "email" placeholder="Email">
            </div>
            <div class="column c2">
                <p><label>Tipo de Utilizador:</label></p>
                <select class="funcaoInput" name="funcao" id="funcao">
                    <option hidden disabled selected value> -- selecione uma opção -- </option>
                    <option name= "Admin" value="Admin">Administrador</option>
                    <option name= "Te" value="Te">Terapeuta</option>
                    <option name= "Cg" value="Cg">Cuidador</option>
                </select>
                <input type="text" name= "username" placeholder="Username">
                <input type="text" name= "password" placeholder="Password">
            </div>
            <div class="column c3">
                <label for="img">Imagem de Perfil</label>
                <input type="file" id="img" name="img" accept="image/*">
                <input class="gradient-button savButton" type="submit"  name="registar_utilizador" value="Registar Utilizador">
            </div>
      </div>
      </div>
      <div class="pl">
          <h4> Lista de Utilizadores</h4> <br>
              <?php while ($rows=mysqli_fetch_array($result_ut)){ ?>
                  <ul>
                      <li><?php echo $rows['nome'] ."  - Utilizador do tipo: ". $rows['tipo_utilizador_id']?></li>
                  </ul>
                  <br>
          <?php } ?>
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