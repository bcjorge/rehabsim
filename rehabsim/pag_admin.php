<?php
session_start();
if (isset($_SESSION["authuser"])&&$_SESSION["authuser"]==1) {
    $id_user = $_SESSION['id_utilizador'];

        $connect = mysqli_connect('localhost', 'root', '', 'database2')
        or die('Error connecting to the server: ' . mysqli_error($connect));

        $sql = 'SELECT * FROM utilizador WHERE utilizador.id_utilizador="' . $id_user . '"';
        $result = mysqli_query($connect, $sql) or die('The query failed: ' . mysqli_error($connect));
        echo "<script>console.log('ola');</script>";
        echo "<script>console.log('debug:" . $id_user . "' );</script>";
        echo "<script>console.log('debug:" . $_SESSION["authuser"] . "' );</script>";

//query para a listagem de utilizadores
        $sql_ut = 'SELECT * FROM utilizador ORDER BY tipo_utilizador_id ';
        $result_ut = mysqli_query($connect, $sql_ut) or die('The query failed: ' . mysqli_error($connect));
        echo "<script>console.log('ola');</script>";
        $num_results = mysqli_num_rows($result_ut);

        if ($num_results == 0) {
            echo "Não Existem Utilizadores para Listar.";
        }
        if ($num_results == 1) {
            echo "<script>console.log('adeus' );</script>";
            echo "<script>console.log('debug:" . $_SESSION['num_saude'] . "' );</script>";
            header("Location: perfil_paciente.php");
        }
//query utilizadores ativados
        $ut_desativados='SELECT * FROM utilizador WHERE utilizador.estado="desativado" ORDER BY tipo_utilizador_id';
        $result_des = mysqli_query($connect, $ut_desativados) or die('The query failed: ' . mysqli_error($connect));
        $num_desativados=mysqli_num_rows($result_des);

 //query utilizadores desativados
        $ut_ativados='SELECT * FROM utilizador WHERE utilizador.estado="ativado" ORDER BY tipo_utilizador_id';
        $result_ativ = mysqli_query($connect, $ut_ativados) or die('The query failed: ' . mysqli_error($connect));
        $num_ativados=mysqli_num_rows($result_ativ);

        if (isset($_GET["action"])) {
            switch ($_GET["action"]) {
                case "regist_user":
                    if (isset($_POST["registar_utilizador"])) {
                        $nome_utilizador = $_POST['nome'];
                        $morada_utilizador = $_POST['morada'];
                        $telemovel_utilizador = $_POST['telemovel'];
                        $email_utilizador = $_POST['email'];
                        $tipo_utilizador = $_POST['funcao'];
                        $username_utilizador = $_POST['username'];
                        $pass_utilizador = hash("sha256", $_POST['password']);
                        $estado=$_POST['estado'];
                        $imagem = $_FILES['img']["name"];
                        $tempname = $_FILES["img"]["tmp_name"];
                        $folder = "C:\wamp64\www\projecto\rehabsim\rehabsim\image/'.$imagem.'";
                        echo "<script>console.log('estou');</script>";
                        echo "<script>console.log('porque');</script>";
                        $connect = mysqli_connect('localhost', 'root', '', 'database2')
                        or die('Error connecting to the server: ' . mysqli_error($connect));
                        $insert_user = 'INSERT INTO  utilizador (nome, morada,telemovel, email, username,password, tipo_utilizador_id,imagem,estado) VALUES ("' . $nome_utilizador . '","' . $morada_utilizador . '","' . $telemovel_utilizador . '","' . $email_utilizador . '","' . $username_utilizador . '","' . $pass_utilizador . '","' . $tipo_utilizador . '","' . $imagem . '","' . $estado . '")';
                        $result_user = mysqli_query($connect, $insert_user) or die('The query failed: ' . mysqli_error($connect));
                        //$pesquisa = $_POST['pesquisa'];
                    }
                    break;
                case "editar_admin":
                    if (isset($_POST["update"])) {
                        echo "<script>console.log('lá' );</script>";
                        $nome_admin = $_POST['nome'];
                        $username_admin = $_POST['username'];
                        $password_admin = $_POST['password'];
                        $morada_admin = $_POST['morada'];
                        $email_admin = $_POST['email'];
                        $telemovel_admin = $_POST['telemovel'];
                        $imagem_admin = $_FILES['img']["name"];
                        if(!empty($imagem_admin)) {
                            $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
                            $update_query = 'UPDATE utilizador SET nome="' . $nome_admin . '", morada="' . $morada_admin . '" , telemovel="' . $telemovel_admin . '" , email="' . $email_admin . '" , username= "' . $username_admin . '", password="' . $password_admin . '", imagem="' . $imagem_admin . '" WHERE utilizador.id_utilizador="' . $id_user . '"';
                            echo "<script>console.log('aqui' );</script>";
                            $result_update = mysqli_query($connect, $update_query) or die('The query failed: ' . mysqli_error($connect));
                            echo "<script>console.log('adeus' );</script>";
                            //$data_update=mysqli_fetch_array($result_update);
                        }
                        else{
                            $update_query1 = 'UPDATE utilizador SET nome="' . $nome_admin . '", morada="' . $morada_admin . '" , telemovel="' . $telemovel_admin . '" , email="' . $email_admin . '" , username= "' . $username_admin . '", password="' . $password_admin . '" WHERE utilizador.id_utilizador="' . $id_user . '"';
                            echo "<script>console.log('aqui' );</script>";
                            $result_update1 = mysqli_query($connect, $update_query1) or die('The query failed: ' . mysqli_error($connect));
                        }
                        echo "<script>alert('Edicao de dados bem sucedida. Por favor faça refresh no site');</script>";
                    } else {
                        echo "<script>alert('O update da informação falhou');</script>";
                    }
                    break;
                case "ativar":
                    $user_ativo=$_POST['id_ativ'];
                    $ativar = 'UPDATE utilizador SET estado="Ativado" WHERE id_utilizador ="' .$user_ativo. '"';
                    $result_ativar = mysqli_query($connect, $ativar) or die('The query failed: ' . mysqli_error($connect));
                    break;
                case "desativar":
                    $user_desativo=$_POST['id_desat'];
                    $desativar = 'UPDATE utilizador SET estado="Desativado" WHERE id_utilizador ="' .$user_desativo. '"';
                    $result_desativar = mysqli_query($connect, $desativar) or die('The query failed: ' . mysqli_error($connect));
                    break;
                case "clicar":
                    echo "<script>console.log('chega aquiiii' );</script>";
                    $id_utilizador3=$_POST['id_utl'];
                    $_SESSION['ola']=$id_utilizador3;
                    //$_SESSION['blabla']=2;
                    echo "<script>console.log('debug: session " . $_SESSION['clickon'] . "' );</script>";
                    header("Location: perfil_utilizadores.php");
                    break;
                }
            }
    }

    /*
    if (isset($_SESSION["authuser"])&&$_SESSION["authuser"]==1) {
        //$connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
        $sql_ut = 'SELECT * FROM utilizador ORDER BY tipo_utilizador_id';
        $result_ut = mysqli_query($connect, $sql_ut) or die('The query failed: ' . mysqli_error($connect));
        echo "<script>console.log('ola');</script>";
        //echo "<script>console.log('debug:".$result_ut['nome']."' );</script>";
        $num_results = mysqli_num_rows($result_ut);

        if ($num_results == 0) {
            echo "Não Existem Utilizadores para Listar.";
        } /*else if ($num_results == 1) {
                    echo "<script>console.log('adeus' );</script>";
                    echo "<script>console.log('debug:". $_SESSION['num_saude']."' );</script>";
                    header("Location: perfil_paciente.php");*/
/*    echo "<script>console.log('hello');</script>";
//if (isset($_GET["regist_user"])) {
    echo "<script>console.log('funciona');</script>";
    if (isset($_POST["registar_utilizador"])) {
        $nome_utilizador = $_POST['nome'];
        $morada_utilizador = $_POST['morada'];
        $telemovel_utilizador = $_POST['telemovel'];
        $email_utilizador = $_POST['email'];
        $tipo_utilizador = $_POST['funcao'];
        $username_utilizador = $_POST['username'];
        $pass_utilizador = hash("sha256", $_POST['password']);
        $imagem = $_FILES['img']["name"];
        $tempname = $_FILES["img"]["tmp_name"];
        $folder = "C:\wamp64\www\projecto\rehabsim\rehabsim\image/'.$imagem.'";
        echo "<script>console.log('estou');</script>";
        echo "<script>console.log('porque');</script>";
        $connect = mysqli_connect('localhost', 'root', '', 'database2')
        or die('Error connecting to the server: ' . mysqli_error($connect));
        $insert_user = 'INSERT INTO  utilizador (nome, morada,telemovel, email, username,password, tipo_utilizador_id,imagem) VALUES ("' . $nome_utilizador . '","' . $morada_utilizador . '","' . $telemovel_utilizador . '","' . $email_utilizador . '","' . $username_utilizador . '","' . $pass_utilizador . '","'. $tipo_utilizador . '","'. $imagem . '")';
        $result_user = mysqli_query($connect, $insert_user) or die('The query failed: ' . mysqli_error($connect));
        //$pesquisa = $_POST['pesquisa'];
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
              <li class="scroll-to-section"><a href="index.php">Home</a></li>
              <li class="scroll-to-section"><a href="index.php">About</a></li>
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
                  <form class="login" method="POST" action="pag_admin.php?action=editar_admin" enctype="multipart/form-data">
                  <h4>Informação do Utilizador</h4>
                  <div class="row">
                      <div class="column c1">
                          <label for="username">Username</label><br>
                          <input type="text" name="username" value="<?php echo $data['username']?>"><br>
                          <label for="nome">Nome</label><br>
                          <input type="text" name="nome" value="<?php echo $data['nome']?>"><br>
                          <label for="pass">Password</label><br>
                          <input type="password" name="password" value="<?php echo $data['password']?>">
                      </div>
                      <div class="column c2">
                          <label for="morada">Morada</label><br>
                          <input type="text" name="morada" value="<?php echo $data['morada']?>"><br>
                          <label for="email">Email</label><br>
                          <input type="email" name="email" value="<?php echo $data['email']?>"><br>
                          <label for="tel">Telemovel</label><br>
                          <input type="number" name="telemovel" value="<?php echo $data['telemovel']?>"><br>
                      </div>
                      <div class="column c3">
                          <label for="img">Imagem de Perfil</label>
                          <?php $imagem = $data['imagem'];
                          if(!empty($imagem)){
                          echo '<img src="image/'.$imagem.'" />';
                          echo "<br>";}?>
                          <input type="file" id="img" name="img" accept="image/*">
                          <input class="gradient-button savButton" type="submit"  name="update" value="Salvar Alterações">
                      </div>
                      <?php } ?>
                  </div>
                  </form>
      </div>
      <div class="pac">
        <h4>Registo Novo Utilizador</h4>
        <div class="formPaciente" >
            <form class="login" method="POST" action="pag_admin.php?action=regist_user" enctype="multipart/form-data">
            <div class="column c1">
                <label for="nome">Nome</label><br>
                <input type="text" name= "nome" placeholder="Nome"></p>
                <label for="morada">Morada</label><br>
                <input type="text" name= "morada" placeholder="Morada"></p>
                <label for="telemovel">Telemóvel</label><br>
                <input type="text"  name= "telemovel" placeholder="Telemovel"></p>
                <label for="email">Email</label><br>
                <input type="email" name= "email" placeholder="Email">
            </div>
            <div class="column c2">
                <p><label>Tipo de Utilizador:</label></p>
                <select class="funcaoInput" name="funcao" id="funcao">
                    <option hidden disabled selected value> -- selecione uma opção -- </option>
                    <option name= "Admin" value="1">Administrador</option>
                    <option name= "Te" value="2">Terapeuta</option>
                    <option name= "Cg" value="3">Cuidador</option>
                </select><br>
                <label for="username">Username</label><br>
                <input type="text" name= "username" placeholder="Username"><br>
                <label for="password">Password</label><br>
                <input type="password" name= "password" placeholder="Password">
                <p><label>Estado do Utilizador:</label></p>
                <select class="funcaoInput" name="estado" id="funcao">
                    <option hidden disabled selected value> -- selecione uma opção -- </option>
                    <option name= "Ativado" value="Ativado">Ativado</option>
                    <option name= "Desativado" value="Desativado">Desativado</option>
                </select><br>
            </div>
            <div class="column c3">
                <label for="img">Imagem de Perfil</label>
                <input type="file" id="img" name="img" accept="image/*">
                <input class="gradient-button sessionButton" type="submit"  name="registar_utilizador" value="Registar Utilizador">
            </div>
            </form>
      </div>
      </div>
      <div class="pl">
          <h4> Lista de Utilizadores</h4> <br>
          <form method="POST" action="pag_admin.php?action=clicar">
          <select class="funcaoInput" id="utilizador" name="id_utl" >
              <?php
              echo("<option> -- Selecionar utilizador -- </option>");
              while ($rows=mysqli_fetch_array($result_ut)){
                  $id_utilizador=$rows['id_utilizador'];
                  $nome_utilizador=$rows['nome'];
                  $tipo_utilizador=$rows['tipo_utilizador_id'];
                  echo("<option value=$id_utilizador>$tipo_utilizador - $nome_utilizador</option>");
              }
              ?>
              <input class="button3" type="submit"  value="Procurar utilizador">
          </select>

          </form>

          <h4> Ativar/Desativar Utilizadores</h4> <br>
          <form method="POST" action="pag_admin.php?action=ativar">
              <select class="funcaoInput" id="utilizador" name="id_ativ" ><br>
                  <?php
                  echo("<option> -- Selecionar utilizador -- </option>");
                  while ($desativados=mysqli_fetch_array($result_des)){
                      $id_utilizadordesat=$desativados['id_utilizador'];
                      $nome_utilizadordesat=$desativados['nome'];
                      $tipo_utilizadordesat=$desativados['tipo_utilizador_id'];
                      echo("<option value=$id_utilizadordesat>$tipo_utilizadordesat - $nome_utilizadordesat</option>");
                  }
                  ?>
                  <input class="button3" type="submit"  value="Ativar Utilizador">
              </select>
              <br>
          </form>
          <form method="POST" action="pag_admin.php?action=desativar">
              <select class="funcaoInput" id="utilizador" name="id_desat" >
                  <?php
                  echo("<option> -- Selecionar utilizador -- </option>");
                  while ($ativados=mysqli_fetch_array($result_ativ)){
                      $id_utilizadorativ=$ativados['id_utilizador'];
                      $nome_utilizadorativ=$ativados['nome'];
                      $tipo_utilizadorativ=$ativados['tipo_utilizador_id'];
                      echo("<option value=$id_utilizadorativ>$tipo_utilizadorativ - $nome_utilizadorativ</option>");
                  }
                  ?><br>
                  <input class="button3" type="submit"  value="Desativar Utilizador">
              </select>
              <br>
              <div class="gradient-button sessionButton"><a href="graficos.php">Consultar dados</a></div>
          </form>
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