<?php
session_start();
if (isset($_SESSION["authuser"])&&$_SESSION["authuser"]==1) {
    $num_saude = $_SESSION['num_saude'];
    echo "<script>console.log('.$num_saude.');</script>";
    $connect = mysqli_connect('localhost', 'root', '', 'database2')
    or die('Error connecting to the server: ' . mysqli_error($connect));
    $sql = 'SELECT * FROM paciente WHERE paciente.num_saude="' . $num_saude . '"';
    $result = mysqli_query($connect, $sql) or die('The query failed: ' . mysqli_error($connect));

    //echo "<script>console.log(.data_stringify($result).);</script>";
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "editar_paciente":
            if (isset($_POST["update"])) {
                echo "<script>console.log('lá' );</script>";
                $nome_pac = $_POST['nome'];
                $data_nascimento_pac=$_POST['data_nascimento'];
                $n_saude_pac=$_POST['n_saude'];
                $NIF_pac=$_POST['NIF'];
                $genero_pac=$_POST['genero'];
                $morada_pac = $_POST['morada'];
                $distrito_pac=$_POST['distrito'];
                $email_pac = $_POST['email'];
                $telemovel_pac = $_POST['telemovel'];
                $afasia=$_POST['afasia'];
                $alergias_pac=$_POST['alergias'];
                $imagem_pac = $_FILES['img']["name"];
                if(!empty($imagem_pac)){
                $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
                $update_query = 'UPDATE paciente SET data_nascimento="'.$data_nascimento_pac.'", nome="'.$nome_pac.'", morada="'.$morada_pac.'" , distrito="'.$distrito_pac.'",  sexo="'.$genero_pac.'", nif="'.$NIF_pac.'", num_saude="'.$n_saude_pac.'",telemovel="'.$telemovel_pac.'" , email="'.$email_pac.'" , alergias= "'.$alergias_pac.'", afasia_tipo="'.$afasia.'", imagem="'.$imagem_pac.'" WHERE paciente.num_saude="' . $num_saude . '"';
                echo "<script>console.log('aqui' );</script>";
                $result_update = mysqli_query($connect, $update_query) or die('The query failed: ' . mysqli_error($connect));
                echo "<script>console.log('adeus' );</script>";
                //$data_update=mysqli_fetch_array($result_update);

            } else{
                    $update_query1 = 'UPDATE paciente SET data_nascimento="'.$data_nascimento_pac.'", nome="'.$nome_pac.'", morada="'.$morada_pac.'" , distrito="'.$distrito_pac.'",  sexo="'.$genero_pac.'", nif="'.$NIF_pac.'", num_saude="'.$n_saude_pac.'",telemovel="'.$telemovel_pac.'" , email="'.$email_pac.'" , alergias= "'.$alergias_pac.'", afasia_tipo="'.$afasia.'" WHERE paciente.num_saude="' . $num_saude . '"';
                    echo "<script>console.log('aqui' );</script>";
                    $result_update1 = mysqli_query($connect, $update_query1) or die('The query failed: ' . mysqli_error($connect));
                } echo "<script>alert('Edicao de dados bem sucedida. Por favor faça refresh no site');</script>";}
            else {
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
        <h4>Perfil de Paciente</h4>
        <h1><?php echo $data['nome']?></h1>
    </div>
    <div class="containerBlocks">
        <div class="profile">
            <form class="login" method="POST" action="perfil_paciente.php?action=editar_paciente" enctype="multipart/form-data">
            <h4>Informação do Paciente</h4>
            <div class="row">
                <div class="column c1">
                    <label for="nome">Nome</label><br>
                    <input type="text" name= "nome" value="<?php echo $data['nome']?>"><br>
                    <label for="data_nascimento">Data de Nascimento</label><br>
                    <input type="date" name= "data_nascimento" value="<?php echo $data['data_nascimento']?>"><br>
                    <label for="n_saude">Numero de Saude</label><br>
                    <input type="number" name= "n_saude" value="<?php echo $data['num_saude']?>"><br>
                    <label for="nif">NIF</label><br>
                    <input type="number" name= "NIF" value="<?php echo $data['nif']?>"><br>
                    <label for="genero">Genero</label><br>
                    <input type="text" name= "genero" value="<?php echo $data['sexo']?>"><br>
                </div>
                <div class="column c2">
                    <label for="morada">Morada</label><br>
                    <input type="text" name= "morada" value="<?php echo $data['morada']?>"><br>
                    <label for="distrito">Distrito</label><br>
                    <input type="text" name= "distrito" value="<?php echo $data['distrito']?>"><br>
                    <label for="email">Email</label><br>
                    <input type="email" name= "email" value="<?php echo $data['email']?>"><br>
                    <label for="telemovel">Telemovel</label><br>
                    <input type="number" name= "telemovel" value="<?php echo $data['telemovel']?>"><br>
                    <label for="afasia">Tipo de Afasia</label><br>
                    <input type="number" name= "afasia" value="<?php echo $data['afasia_tipo']?>">
                </div>
                <div class="column c3">
                    <label for="alergias">Lista de Alergias (separadas por vírgula):</label>
                    <textarea id="alergias" name="alergias" rows="3" cols="40" > <?php echo $data['alergias']?></textarea><br>
                    <label for="img">Imagem de Perfil</label><br>
                    <?php $imagem = $data['imagem'];
                    if(!empty($imagem)){
                    echo '<img src="image/'.$imagem.'" />';
                    echo "<br>";}?>
                    <input type="file" id="img" name="img" value="<?php echo $data['imagem']?>" accept="image/*">
                    <input class="gradient-button savButton" type="submit"  name="update" value="Salvar Alterações">
                </div>
                <?php } ?>
            </div>
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