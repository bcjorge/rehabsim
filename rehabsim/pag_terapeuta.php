<?php
session_start();
if((isset($_SESSION['authuser'])) AND ($_SESSION['authuser'] == 1)) {
    $id_user = $_SESSION['id_utilizador'];

    $connect = mysqli_connect('localhost', 'root', '', 'database2')
    or die('Error connecting to the server: ' . mysqli_error($connect));
    $sql = 'SELECT * FROM utilizador WHERE utilizador.id_utilizador="' . $id_user . '"';
    $result = mysqli_query($connect, $sql) or die('The query failed: ' . mysqli_error($connect));
    echo "<script>console.log('ola');</script>";
    echo "<script>console.log('debug:" . $id_user . "' );</script>";
    echo "<script>console.log('debug:" . $_SESSION["authuser"] . "' );</script>";
    //echo "<script>console.log('debug:".$result."' );</script>";
    //echo "<script>console.log('debug:".$id_user."' );</script>";

    //queries para listagem de consultas relativas aos pacientes deste terapeuta
    $consultas_terapeuta='SELECT registo_consulta.id_consulta, paciente.nome, paciente.id_paciente FROM paciente INNER JOIN registo_consulta ON paciente.id_paciente = registo_consulta.paciente_id INNER JOIN utilizador_consulta ON registo_consulta.id_consulta = utilizador_consulta.registo_consulta_id_consulta WHERE utilizador_consulta.utilizadores_id_utilizador= "'.$id_user.'"';
    $result_consultas_terapeuta = mysqli_query($connect, $consultas_terapeuta) or die('The query failed: ' . mysqli_error($connect));


    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "perfil_paciente":
                if (isset($_POST["submit"])) {
                    $pesquisa = $_POST['pesquisa'];
                    $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
                    $sql_pac = 'SELECT * FROM paciente WHERE num_saude="' . $pesquisa . '" ';
                    $result_pac = mysqli_query($connect, $sql_pac) or die('The query failed: ' . mysqli_error($connect));
                    $num_results = mysqli_num_rows($result_pac);
                    $row = mysqli_fetch_array($result_pac);

                    if ($num_results == 0) {
                        echo "<script>alert('O Paciente que procurou n??o existe na base de dados. Registe o novo paciente.');</script>";
                    } else if ($num_results == 1) {
                        $_SESSION['num_saude'] = $row['num_saude'];
                        echo "<script>console.log('adeus' );</script>";
                        echo "<script>console.log('debug:" . $_SESSION['num_saude'] . "' );</script>";
                        header("Location: perfil_paciente.php");
                    }
                }
                if (isset($_POST["registar_p"])) {
                    $nome = $_POST['nome'];
                    $data = $_POST['data_nascimento'];
                    $nsaude = $_POST['n_saude'];
                    $nif = $_POST['NIF'];
                    $sexo = $_POST['sexo'];
                    $morada = $_POST['morada'];
                    $distrito = $_POST['distrito'];
                    $email = $_POST['email'];
                    $telemovel = $_POST['telemovel'];
                    $alergias = $_POST['alergias'];
                    $tipo_afasia = $_POST['tipo_afasia'];
                    $imagem = $_FILES['img']["name"];
                    $tempname = $_FILES["img"]["tmp_name"];
                    $folder = "C:\wamp64\www\projecto\rehabsim\rehabsim\image/" . $imagem;
                    $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
                    $insert_query = 'INSERT INTO paciente (data_nascimento, nome, morada, distrito, sexo, nif, num_saude, telemovel, email, alergias,afasia_tipo,imagem) VALUES ("' . $data . '","' . $nome . '","' . $morada . '","' . $distrito . '","' . $sexo . '","' . $nif . '","' . $nsaude . '","' . $telemovel . '","' . $email . '",
        "' . $alergias . '","' . $tipo_afasia . '","' . $imagem . '")';
                    $result_IQ = mysqli_query($connect, $insert_query) or die('The query failed: ' . mysqli_error($connect));
                    if (move_uploaded_file($tempname, $folder)) {
                        echo "Upload bem sucedido!";
                    } else {
                        echo "<script>alert('O upload da imagem falhou ');</script>";
                    }
                }
                break;
            case "pag_terapeuta":
                if (isset($_POST["update"])) {
                    echo "<script>console.log('l??' );</script>";
                    $nome_ter = $_POST['nome'];
                    $username_ter = $_POST['username'];
                    $password_ter = $_POST['password'];
                    $morada_ter = $_POST['morada'];
                    $email_ter = $_POST['email'];
                    $telemovel_ter = $_POST['telemovel'];
                    $imagem_ter = $_FILES['img']["name"];
                    $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
                    if(!empty($imagem_ter)) {
                        $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
                        $update_query = 'UPDATE utilizador SET nome="' . $nome_ter . '", morada="' . $morada_ter . '" , telemovel="' . $telemovel_ter . '" , email="' . $email_ter . '" , username= "' . $username_ter . '", password="' . $password_ter . '", imagem="' . $imagem_ter . '" WHERE utilizador.id_utilizador="' . $id_user . '"';
                        echo "<script>console.log('aqui' );</script>";
                        $result_update = mysqli_query($connect, $update_query) or die('The query failed: ' . mysqli_error($connect));
                        echo "<script>console.log('adeus' );</script>";
                        //$data_update=mysqli_fetch_array($result_update);
                    }
                    else{
                        $update_query1 = 'UPDATE utilizador SET nome="' . $nome_ter . '", morada="' . $morada_ter . '" , telemovel="' . $telemovel_ter . '" , email="' . $email_ter . '" , username= "' . $username_ter . '", password="' . $password_ter . '" WHERE utilizador.id_utilizador="' . $id_user . '"';
                        echo "<script>console.log('aqui' );</script>";
                        $result_update1 = mysqli_query($connect, $update_query1) or die('The query failed: ' . mysqli_error($connect));
                    }
                    echo "<script>alert('Edicao de dados bem sucedida. Por favor fa??a refresh no site');</script>";
                } else {
                    echo "<script>alert('O update da informa????o falhou');</script>";
                }
                break;
            case "dados_consulta":
                if (isset($_POST["gravar_dados"])) {
                    $paciente=$_POST['num_saude'];
                    $terapeuta=$_POST['terapeuta_username'];
                    $cuidador=$_POST['cuidador_username'];

                    $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));

                    $verify_utilizador= 'SELECT * FROM utilizador WHERE utilizador.username="'.$terapeuta.'" or utilizador.username="'.$cuidador.'"';
                    $result_very_utilizador=mysqli_query($connect, $verify_utilizador) or die('The query failed: ' . mysqli_error($connect));
                    $row_ut = mysqli_fetch_array($result_very_utilizador);
                    $number_ut = mysqli_num_rows($result_very_utilizador);
                    echo "<script>console.log('corretos:".$number_ut."' );</script>";

                    $verify_paciente= 'SELECT * FROM paciente WHERE paciente.num_saude="'.$paciente.'"';
                    $result_very_paciente=mysqli_query($connect, $verify_paciente) or die('The query failed: ' . mysqli_error($connect));
                    $row_pc = mysqli_fetch_array($result_very_paciente);
                    $number_pc = mysqli_num_rows($result_very_paciente);
                    echo "<script>console.log('corretos_pc:".$number_pc."' );</script>";

                    if ($number_ut==2 && $number_pc==1 ){
                        echo "<script>console.log('entrei no if de verificacao' );</script>";
                    //Inserir paciente id
                    $insert_utilizador_consulta_pac = 'INSERT INTO registo_consulta (paciente_id) SELECT id_paciente FROM paciente WHERE paciente.num_saude="'.$paciente.'"';
                    $result_IU1 = mysqli_query($connect, $insert_utilizador_consulta_pac) or die('The query failed: ' . mysqli_error($connect));
                    //selcionar consulta mais recente
                    $consulta_recente_sql='SELECT MAX(id_consulta) AS id_consulta FROM registo_consulta';
                    $consulta_recente = mysqli_query($connect, $consulta_recente_sql) or die('The query failed: ' . mysqli_error($connect));
                    $row_consulta = mysqli_fetch_array($consulta_recente);
                    echo "<script>console.log('consulta:".$row_consulta['id_consulta']."' );</script>";
                    //Inserir teraupeuta
                    $insert_utilizador_consulta_ter = 'INSERT INTO utilizador_consulta (utilizadores_id_utilizador,registo_consulta_id_consulta) SELECT id_utilizador,'.$row_consulta['id_consulta'].' FROM utilizador WHERE utilizador.username="'.$terapeuta.'"';
                    $result_IU2 = mysqli_query($connect, $insert_utilizador_consulta_ter) or die('The query failed: ' . mysqli_error($connect));
                    //Inserir cuidador
                    $insert_utilizador_consulta_cui = 'INSERT INTO utilizador_consulta (utilizadores_id_utilizador,registo_consulta_id_consulta) SELECT id_utilizador,'.$row_consulta['id_consulta'].' FROM utilizador WHERE utilizador.username="'.$cuidador.'"';
                    $result_IU3 = mysqli_query($connect, $insert_utilizador_consulta_cui) or die('The query failed: ' . mysqli_error($connect));

                    $_SESSION['id_consulta']=$row_consulta['id_consulta'];
                    $_SESSION['id_cuidador']=$cuidador;
                    $_SESSION['id_terapeuta']=$terapeuta;
                        echo "<script>console.log('sessao_conuslta:".$_SESSION['id_consulta']."' );</script>";
                        echo "<script>console.log('sessao_cuidador:".$_SESSION['id_cuidador']."' );</script>";
                        echo "<script>console.log('sessao_terapeuta:".$_SESSION['id_terapeuta']."' );</script>";
                    header("Location: consulta.php");

                    }
                    else{
                        echo "<script>alert('Utilizador ou Paciente n??o existe na base de dados.');</script>";
                    }

                }
                break;
            case "clicar_consulta":
                $id_ir_consulta2=$_POST['id_tc'];
                $_SESSION['id_consulta']=$id_ir_consulta2;
                echo "<script>console.log('cuidador:" . $_SESSION['id_consulta'] . "' );</script>";
                echo "<script>console.log('idconsulta:" . $_SESSION['id_consulta'] . "' );</script>";
                $username_terapeuta='SELECT utilizador.username FROM utilizador WHERE utilizador.id_utilizador="'.$id_user.'"';
                $res_user_terapeuta=mysqli_query($connect, $username_terapeuta) or die('The query failed: ' . mysqli_error($connect));
                $row_res_ter= mysqli_fetch_array($res_user_terapeuta);
                $_SESSION['id_terapeuta']=$row_res_ter['username'];
                echo "<script>console.log('terapeuta:" . $_SESSION['id_terapeuta '] . "' );</script>";

                $username_cuidador='SELECT utilizador.username FROM utilizador INNER JOIN utilizador_consulta ON utilizador.id_utilizador=utilizador_consulta.utilizadores_id_utilizador WHERE utilizador_consulta.registo_consulta_id_consulta="'.$id_ir_consulta2.'" AND utilizador.tipo_utilizador_id="3"';
                $res_user_cuidador=mysqli_query($connect, $username_cuidador) or die('The query failed: ' . mysqli_error($connect));
                $row_res_cui= mysqli_fetch_array($res_user_cuidador);
                $_SESSION['id_cuidador']=$row_res_cui['username'];
                echo "<script>console.log('cuidador:" . $_SESSION['id_cuidador'] . "' );</script>";
                //Abrir consulta
                header("Location: consulta.php");
                break;

        }
    }

}


?>
<!DOCTYPE html>
<html lang=???en???>
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
      <form class="login" method="POST" action="pag_terapeuta.php?action=pag_terapeuta" enctype="multipart/form-data">
        <h4>Informa????o do Utilizador</h4>
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
                  echo '<img class="imagem_perfil" src="image/'.$imagem.'" />';
                  echo "<br>";}?>
                  <input type="file" id="img" name="img" accept="image/*">
                  <input class="savButton" type="submit"  name="update" value="Salvar Altera????es">
              </div>
              <?php } ?>
          </div>
      </form>
      </div>
      <div class="pac">
        <h4>Registo de Paciente</h4>
        <div class="formPaciente">
          <form class="login" method="POST" action="pag_terapeuta.php?action=perfil_paciente" enctype="multipart/form-data">
            <div class="column c1">
                <label for="nome">Nome</label><br>
                <input type="text" name= "nome" placeholder="Nome"></p>
                <label for="data_nascimento">Data de Nacimento</label><br>
                <input type="text" name= "data_nascimento"placeholder="Data de Nacimento"></p>
                <label for="n_saude">N?? de Sa??de</label><br>
                <input type="text" name= "n_saude" placeholder="N?? de Saude"></p>
                <label for="NIF">NIF</label><br>
                <input type="number" name= "NIF" placeholder="NIF">
                <p><label>G??nero:</label></p>
                <select class="sexoInput" name="sexo" id="sexo">
                    <option hidden disabled selected value> -- selecione uma op????o -- </option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <div class="column c2">
                <label for="morada">Morada</label><br>
                <input type="text" name= "morada" placeholder="Morada"><br>
                <label for="distrita">Distrito</label><br>
                <input type="text" name="distrito" placeholder="Distrito"><br>
                <label for="email">Email</label><br>
                <input type="email" name= "email" placeholder="Email"><br>
                <label for="telemovel">Telem??vel</label><br>
                <input type="number" name= "telemovel" placeholder="Telemovel"><br>
                <label for="tipo_afasia">Tipo de Afasia</label><br>
                <input type="text" name= "tipo_afasia" placeholder="tipo_de_afasia"><br>
            </div>
            <div class="column c3">
                <label for="alergias">Lista de Alergias (separadas por v??rgula):</label>
                <textarea id="alergias" name="alergias" rows="3" cols="30"></textarea><br>
                <br>
                <label for="img">Imagem de Perfil</label>
                <input type="file" id="img" name="img" accept="image/*">
                <br>
                <br>
                <input class="gradient-button sessionButton2"type="submit"  name="registar_p" value="Registar Paciente"</input>
            </div>
            </form>
      </div>
      </div>
      <div class="pl">
          <div class="column c1">
              <h5> Procurar Paciente existente</h5>
          <div class="formPaciente">
              <form class="pag" method="POST" action="pag_terapeuta.php?action=perfil_paciente">
              <input type="text" name= "pesquisa" placeholder="N??mero de utente">
              <input class="gradient-button sessionButton1" type="submit" value="Procurar" name="submit">
              </form>
          </div>
              <br>
              <br>
              <br>
              <h5> Hist??rico de Consultas</h5>
              <form method="POST" action="pag_terapeuta.php?action=clicar_consulta">
                  <select class="funcaoInput" id="consulta" name="id_tc" >
                      <?php
                          echo("<option> -- Selecionar consulta -- </option>");
                          while($num_consultas=mysqli_fetch_array($result_consultas_terapeuta)){
                          $id_consulta = $num_consultas['id_consulta'];
                          $nome_paciente = $num_consultas['nome'];
                          $id_paciente = $num_consultas['id_paciente'];
                          echo("<option value=$id_consulta> $id_consulta - $nome_paciente - ID do Paciente: $id_paciente</option>");
                      }
                      ?>
                      <input class="button3" type="submit"  value="Ir para consulta">
                  </select>
              </form>
    </div>
          <form class="pag" method="POST" action="pag_terapeuta.php?action=dados_consulta">
          <div class="column c2">
              <h5> Inserir Nova Consulta </h5>
              <div class="formPaciente">
                  <input type="text" name= "cuidador_username" placeholder="Username do Cuidador">
                  <input type="text" name= "terapeuta_username" placeholder="Terapeuta Respons??vel">
              </div>
          </div>
          <div class="column c3">
              <div class="formPaciente">
                  <br>
                  <input type="text" name= "num_saude" placeholder="Numero de Saude do Paciente">
                  <input class="gradient-button sessionButton1" type="submit" value="Iniciar Consulta" name="gravar_dados">
                </div>
          </div>
      </form>
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