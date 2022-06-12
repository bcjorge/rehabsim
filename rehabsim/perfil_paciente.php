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

<div class="containerInfo">
    <?php while ($data=mysqli_fetch_array($result)){ ?>
    <div class="text">
        <h4>Perfil de Paciente</h4>
        <h1><?php echo $data['nome']?></h1>
    </div>
    <div class="containerBlocks">
        <div class="profile">
            <h4>Informação do Paciente</h4>
            <div class="row">
                <div class="column c1">
                    <label for="nome">Nome</label><br>
                    <input type="text" value="<?php echo $data['nome']?>"><br>
                    <label for="data">Data de Nascimento</label><br>
                    <input type="date" value="<?php echo $data['data_nascimento']?>"><br>
                    <label for="numb">Numero de Saude</label><br>
                    <input type="number" value="<?php echo $data['num_saude']?>"><br>
                    <label for="nif">NIF</label><br>
                    <input type="number" value="<?php echo $data['nif']?>"><br>
                    <label for="genero">Genero</label><br>
                    <input type="text" value="<?php echo $data['sexo']?>"><br>
                </div>
                <div class="column c2">
                    <label for="morada">Morada</label><br>
                    <input type="text" value="<?php echo $data['morada']?>"><br>
                    <label for="distrito">Distrito</label><br>
                    <input type="text" value="<?php echo $data['distrito']?>"><br>
                    <label for="email">Email</label><br>
                    <input type="email" value="<?php echo $data['email']?>"><br>
                    <label for="tel">Telemovel</label><br>
                    <input type="number" value="<?php echo $data['telemovel']?>"><br>
                    <label for="afasia">Tipo de Afasia</label><br>
                    <input type="number" value="<?php echo $data['afasia_tipo']?>">
                </div>
                <div class="column c3">
                    <label for="alergias">Lista de Alergias (separadas por vírgula):</label>
                    <textarea id="alergias" name="alergias" rows="3" cols="40" > <?php echo $data['alergias']?></textarea><br>
                    <label for="img">Imagem de Perfil</label>
                    <?php $imagem = $data['imagem'];
                    echo '<img src="image/'.$imagem.'" />';
                    echo "<br>";?>
                    <input type="file" id="img" name="img" value="<?php echo $data['imagem']?>" accept="image/*">
                    <div class="gradient-button savButton"><a href="perfil_paciente.php">Salvar Alterações</a></div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="pac">
            <h4>Resultados da Sessão</h4>
                <div class="row">
                    <div class="column c1">
                       <h5> Exercícios Receitados </h5>
                        <br>
                        <h5> N </h5> <p> Nível:</p>
                        <h5> C </h5> <p> Nível:</p>
                        <h5> F </h5> <p> Nível:</p>
                        <h5> R </h5> <p> Nível:</p>
                        <br>
                        <h5> Dificuldade Sentida </h5>
                    </div>
                    <div class="column c2">
                        <br> <br>
                        <input class="inputresult" type="number" placeholder="Resultado N">
                        <br>
                        <input class="inputresult" type="number" placeholder="Resultado C">
                        <br>
                        <input class="inputresult" type="number" placeholder="Resultado F">
                        <br>
                        <input class="inputresult" type="number" placeholder="Resultado R">
                        <br> <br>
                        <input class="inputresult" type="number" placeholder="Dificuldade 1-5">
                        <br>
                        <div class="gradient-button sessionButton"><a href="login.php">Salvar Resultados</a></div>
                    </div>
                    <div class="column c3">
                        <h4> Informação Patológica</h4>
                        <br>
                        <h5>Tipo de Afasia: </h5>
                        <br>
                        <h5>Nível Atual:</h5>
                        <br>
                        <div class="gradient-button sessionButton"><a href="historico.php">Histórico de sessões</a></div>
                    </div>
                </div>
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