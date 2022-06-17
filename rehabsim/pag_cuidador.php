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
             echo "<script>alert('O Paciente que procurou não existe na base de dados. Registe o novo paciente.');</script>";
             } else if ($num_results == 1) {
              $_SESSION['num_saude'] = $row['num_saude'];
                 echo "<script>console.log('adeus' );</script>";
                echo "<script>console.log('debug:" . $_SESSION['num_saude'] . "' );</script>";
                 header("Location: perfil_paciente.php");
             }
            }
              break;
             case "pag_cuidador":
                 if (isset($_POST["update"])) {
                     echo "<script>console.log('lá' );</script>";
                     $nome_ter = $_POST['nome'];
                     $username_ter = $_POST['username'];
                     $password_ter = $_POST['password'];
                     $morada_ter = $_POST['morada'];
                     $email_ter = $_POST['email'];
                     $telemovel_ter = $_POST['telemovel'];
                     $imagem_ter = $_FILES['img']["name"];
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
                     echo "<script>alert('Edicao de dados bem sucedida. Por favor faça refresh no site');</script>";
                 } else {
                     echo "<script>alert('O update da informação falhou');</script>";
                 }
                 break;
         }
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
                        <li class="scroll-to-section"><a href="index.php" >Home</a></li>
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
        <h4>Cuidador</h4>
        <h1><?php echo $data['nome']?></h1>
    </div>
    <div class="containerBlocks">
        <div class="profile">
            <form class="login" method="POST" action="pag_cuidador.php?action=pag_cuidador" enctype="multipart/form-data">
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
                    <input type="email"name="email" value="<?php echo $data['email']?>"><br>
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
                    <input class="savButton" type="submit"  name="update" value="Salvar Alterações">
                </div>
              <?php } ?>
            </div>
            </form>
        </div>
        <div class="pac">
            <h4>Lista de Pacientes</h4>
        </div>
        <div class="pl">
            <h4> Procurar Paciente</h4>
            <div class="formPaciente">
                <form class="pag" method="POST" action="pag_cuidador.php?action=perfil_paciente">
                <input type="text" name= "pesquisa" placeholder="Número de utente"></p>
                <input class="sessionButton1" type="submit" value="Procurar" name="submit">
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