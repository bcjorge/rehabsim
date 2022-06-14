<?php?>
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
    <div class="text">
        <h4>Dados de Consulta</h4>
        <h1> Nome paciente <?php //echo $data['nome']?> </h1>
        <br>
    </div>
    <div class="profile">
        <h5>Informações Gerais</h5>
        <div class="row">
            <div class="column c1">
                <label for="terapeuta">Terapeuta</label><br>
                <input type="text" name="terapeuta" value="Nome Terapeuta<?php //echo $data['morada']?>"><br>
            </div>
            <div class="column c2">
                <label for="cuidador">Cuidador</label><br>
                <input type="text" name="cuidador" value="Nome Cuidador<?php //echo $data['morada']?>"><br>
            </div>
            <div class="column c3">
                <label for="data">Data da Consulta</label><br>
                <input type="date" name="data" value="Data<?php //echo $data['morada']?>"><br>
            </div>
        </div>
    </div>
    <br>
    <div class="pac">
        <div class="row">
            <div class="column c1">
                <h5> Exercicios Receitados  </h5>
                <br>
                <h5> Dificuldade Total <?php //echo $rows['ex_type']?> </h5> <p>Valor:<?php //echo $rows['n_dif']?></p><br>
                <h5> N <?php //echo $rows['ex_type']?> </h5> <p>Nível:<?php //echo $rows['n_dif']?></p>
                <h5> C <?php //echo $rows['ex_type']?></h5> <p> Nível:</p>
                <h5> F </h5> <?php //echo $rows['ex_type']?><p> Nível:</p>
                <h5> R </h5> <p> Nível:</p>
            </div>
            <div class="column c2">
                <h5> Preenchimento pelo cuidador </h5>
                <br>
                <label for="avaliacao">Avaliação do Cuidador</label><br>
                <input class="inputresult" type="number" placeholder="Avaliação total">
                <br>
                <br>
                <label for="auto-avaliacao">Auto-Avaliação do Paciente</label><br>
                <input class="inputresult" type="number" placeholder="Dificuldade 1-5">
                <br>
            </div>
            <div class="column c3">
                <h5> Comentarios</h5>
                <label for="comentarios">Possiveis esclarecimentos:</label>
                <textarea id="comentarios" name="comentarios" rows="3" cols="40" > <?php //echo $data['alergias']?></textarea><br>
                <br>
                <div class="gradient-button sessionButton"><a href="login.php">Salvar Resultados</a></div>
            </div>