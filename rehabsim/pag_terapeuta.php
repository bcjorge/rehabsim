<?php
session_start();
if((isset($_SESSION['authuser'])) AND ($_SESSION['authuser'] == 1)){
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
if(isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "perfil_paciente":
            $pesquisa = $_POST['pesquisa'];
            $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
            $sql_pac = 'SELECT * FROM paciente WHERE num_saude="' . $pesquisa . '" ';
            $result_pac = mysqli_query($connect, $sql_pac) or die('The query failed: ' . mysqli_error($connect));
            $num_results = mysqli_num_rows($result_pac);
            $row = mysqli_fetch_array($result_pac);

            if ($num_results == 0) {
                echo "<br>O paciente que procura não existe. Adicione o novo paciente.";
            } else if ($num_results == 1) {
                $_SESSION['num_saude'] = $row['num_saude'];
                echo "<script>console.log('adeus' );</script>";
                echo "<script>console.log('debug:". $_SESSION['num_saude']."' );</script>";
               header("Location: perfil_paciente.php");
            }
    }
}
    /*if(isset($_POST["perfil_paciente"])) {
        $nome = $_POST['nome'];
        $data = $_POST['data_nascimento'];
        $nutente = $_POST['n_utente'];
        $nif = $_POST['NIF'];
        $sexo = $_POST['sexo'];
        $morada = $_POST['morada'];
        $distrito = $_POST['distrito'];
        $email = $_POST['email'];
        $telemovel = $_POST['telemovel'];
        $alergias = $_POST['alergias'];
        $tipo_afasia=$_POST['tipo_afasia'];
    //$imagem=$_POST['img'];
        $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
        $insert_query = 'INSERT INTO paciente (data_nascimento, nome, morada, distrito, sexo, nif, num_saude, telemovel, email, alergias,afasia_tipo) VALUES ("'.$data.'","'.$nome.'","'.$morada.'","'.$distrito.'","'.$sexo.'","'.$nif.'","'.$nutente.'","'.$telemovel.'","'.$email.'",
        "'.$alergias.'","'.$tipo_afasia.'")';
        $result_IQ = mysqli_query($connect, $insert_query) or die('The query failed: ' . mysqli_error($connect));
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
              <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
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
      <h4>Terapeuta</h4>
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
          </div>
          <?php } ?>
      </div>
      <div class="pac">
        <h4>Registo de Paciente</h4>
        <div class="formPaciente">
          <form class="login" method="POST" action="pag_terapeuta.php?action=perfil_paciente">
            <div class="column c1">
                <input type="text" name= "nome" placeholder="Nome"></p>
                <input type="text" name= "data_nascimento"placeholder="Data de Nacimento"></p>
                <input type="text" name= "n_saude" placeholder="Nº de Saude"></p>
                <input type="number" name= "NIF" placeholder="NIF">
                <p><label>Género:</label></p>
                <select class="sexoInput" name="sexo" id="sexo">
                    <option hidden disabled selected value> -- selecione uma opção -- </option>
                    <option value="m">M</option>
                    <option value="f">F</option>
                    <option value="o">Outro</option>
                </select>
            </div>
            <div class="column c2">
                <input type="text" name= "morada" placeholder="Morada">
                <input type="text" name="distrito" placeholder="Distrito">
                <input type="email" name= "email" placeholder="Email">
                <input type="number" name= "telemovel" placeholder="Telemovel">
                <input type="text" name= "tipo_afasia" placeholder="tipo_de_afasia">
            </div>
            <div class="column c3">
                <label for="alergias">Lista de Alergias (separadas por vírgula):</label>
                <textarea id="alergias" name="alergias" rows="3" cols="40"></textarea><br>
                <label for="img">Imagem de Perfil</label>
                <input type="file" id="img" name="img" accept="image/*">
                <div class="gradient-button savButton"><a href="perfil_paciente.php">Registar Paciente</a></div>
            </div>
            </form>
      </div>
      </div>
      <div class="pl">
          <h4> Procurar Paciente existente</h4>
          <div class="formPaciente">
              <form class="pag" method="POST" action="pag_terapeuta.php?action=perfil_paciente"">
              <input type="text" name= "pesquisa" placeholder="Número de utente">
              <input class="gradient-button savButton" type="submit" value="Submit" name="submit">
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