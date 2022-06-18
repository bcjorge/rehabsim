<?php
session_start();
$id_user = $_SESSION['id_utilizador'];
$consulta=$_SESSION['id_consulta'];
$username_terapeuta=$_SESSION['id_terapeuta'];
$username_cuidador=$_SESSION['id_cuidador'];

$connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
//Insercao dos dados do paciente
$selecao_infopac='SELECT paciente.nome,paciente.id_paciente,paciente.afasia_tipo,paciente.num_saude FROM paciente INNER JOIN registo_consulta ON paciente.id_paciente=registo_consulta.paciente_id WHERE registo_consulta.id_consulta="'.$consulta.'"';
$resultado_infopac= mysqli_query($connect, $selecao_infopac) or die('The query failed: ' . mysqli_error($connect));
$rows_info_pac=mysqli_fetch_array($resultado_infopac);
$_SESSION['afasia']=$rows_info_pac['afasia_tipo'];

//Insercao de nome cuidador
$selecao_infocui='SELECT utilizador.nome FROM utilizador WHERE utilizador.username="'.$username_cuidador.'"';
$resultado_infocui= mysqli_query($connect, $selecao_infocui) or die('The query failed: ' . mysqli_error($connect));
$rows_info_cui=mysqli_fetch_array($resultado_infocui);
//Insercao de nome terapeuta
$selecao_infoter='SELECT utilizador.nome FROM utilizador WHERE utilizador.username="'.$username_terapeuta.'"';
$resultado_infoter= mysqli_query($connect, $selecao_infoter) or die('The query failed: ' . mysqli_error($connect));
$rows_info_ter=mysqli_fetch_array($resultado_infoter);

//exercicios
$sql_exercises='SELECT exercises.difficulty, exercises.n_dif, exercises.c_dif, exercises.f_dif, exercises.r_dif FROM exercises INNER JOIN registo_consulta ON exercises.id_exercises = registo_consulta.exercises_id_exercises WHERE registo_consulta.id_consulta = "'.$consulta.'"';
$resultado_sql_exercises= mysqli_query($connect, $sql_exercises) or die('The query failed: ' . mysqli_error($connect));
//$rows_sql_exercises= mysqli_fetch_array($resultado_sql_exercises);
echo "<script>console.log('boooraaaa' );</script>";
//echo "<script>console.log('" . $rows_sql_exercises['difficulty'] . "' );</script>";

//avaliação da parte do cuidador
$buscar_aval= 'SELECT paciente_pontuacao, autoavaliacao, data, comentarios FROM registo_consulta WHERE registo_consulta.id_consulta = "'.$consulta.'"';
$resultado_buscar_aval= mysqli_query($connect, $buscar_aval) or die('The query failed: ' . mysqli_error($connect));

//tipo utilizador para voltar para tras
$tipo_utilizador='SELECT tipo_utilizador_id FROM utilizador WHERE utilizador.id_utilizador="'.$id_user.'"';
$result_tipo_user= mysqli_query($connect, $tipo_utilizador) or die('The query failed: '. mysqli_error($connect));
$rows_tipo_user=mysqli_fetch_array($result_tipo_user);

    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "exercicios":
                if (isset($_POST["gravar_exercicios"])) {
                    $dif_total= $_POST['dif_total'];
                    $dif_n=$_POST['ex_n'];
                    $dif_c=$_POST['ex_c'];
                    $dif_f=$_POST['ex_f'];
                    $dif_r=$_POST['ex_r'];

                    // N
                    if(empty($dif_n)){
                        echo "<script>console.log('N is empty' );</script>";
                        $dif_n_null="IS NULL";
                    }else{
                        $dif_n_null="=$dif_n";
                        echo "<script>console.log('" . $dif_n_null . "' );</script>";
                    }

                    // C
                    if(empty($dif_c)){
                        echo "<script>console.log('C is empty' );</script>";
                        $dif_c_null="IS NULL";
                    }else{
                        $dif_c_null="=$dif_c";
                        echo "<script>console.log('" . $dif_c_null . "' );</script>";
                    }

                    // F
                    if(empty($dif_f)){
                        $dif_f_null="IS NULL";
                        echo "<script>console.log('" . $dif_f_null . "' );</script>";
                    }else{
                        $dif_f_null="=$dif_f";
                        echo "<script>console.log('" . $dif_f_null . "' );</script>";
                    }

                    // R
                    if(empty($dif_r)){
                        echo "<script>console.log('R is empty' );</script>";
                        $dif_r_null="IS NULL";
                    }else{
                        $dif_r_null="=$dif_r";
                        echo "<script>console.log('" . $dif_r_null . "' );</script>";
                    }
                     //console.log da query de procura do exercicio correto
                        echo "<script>console.log('SELECT id_exercises FROM exercises WHERE afasia=". $rows_info_pac['afasia_tipo'] ." AND exercises.n_dif=".$dif_n." AND exercises.c_dif=".$dif_c." AND exercises.f_dif ".$dif_f_null." AND exercises.r_dif=".$dif_r."');</script>";
                    $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
                    $ex_id= 'SELECT id_exercises FROM exercises WHERE afasia="'.$rows_info_pac['afasia_tipo'].'" AND exercises.n_dif '.$dif_n_null.' AND exercises.c_dif '.$dif_c_null.' AND exercises.f_dif '.$dif_f_null.' AND exercises.r_dif '.$dif_r_null.' AND exercises.difficulty= '.$dif_total.';';
                    $result_ex_id=mysqli_query($connect, $ex_id) or die('The query failed: ' . mysqli_error($connect));
                    $row_ex_id=mysqli_fetch_array($result_ex_id);
                    $number_row_ex = mysqli_num_rows($result_ex_id);
                    echo "<script>console.log('total:" . $dif_total . "' );</script>";
                    echo "<script>console.log('id do exerc:" . $row_ex_id['id_exercises'] . "' );</script>";
                    echo "<script>console.log('n de linhas:" . $number_row_ex . "' );</script>";
                    if($number_row_ex==1){
                        echo "<script>console.log('És o maior' );</script>";
                        $update_ex_id='UPDATE registo_consulta SET exercises_id_exercises="'.$row_ex_id['id_exercises'].'" WHERE id_consulta = "'.$consulta.'"';
                        $result_update_ex_id= mysqli_query($connect, $update_ex_id) or die('The query failed: ' . mysqli_error($connect));
                    }else{
                        echo "<script>alert('Exercícios não encontrados');</script>";
                    }

                }
            case "inserir":
                if (isset($_POST["resultados"])) {
                    $data=$_POST['data'];
                    $avaliacao=$_POST['avaliacao'];
                    $auto_avaliacao= $_POST['auto_avaliacao'];
                    $comentarios= $_POST['comentarios'];
                    $connect = mysqli_connect('localhost', 'root', '', 'database2') or die('Error connecting to the server: ' . mysqli_error($connect));
                    $insert_results='UPDATE registo_consulta SET paciente_pontuacao="'.$avaliacao.'", autoavaliacao="'.$auto_avaliacao.'",data="'.$data.'", comentarios="'.$comentarios.'" WHERE registo_consulta.id_consulta="'.$consulta.'"';
                    $result_IQ = mysqli_query($connect, $insert_results) or die('The query failed: ' . mysqli_error($connect));
                }
            case "voltar":
                    if ($rows_tipo_user['tipo_utilizador_id'] == 2) {
                        header("Location: pag_terapeuta.php");
                    }
                    if ($rows_tipo_user['tipo_utilizador_id']== 3) {
                        header("Location: pag_cuidador.php");
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
                        <li class="scroll-to-section"><a href="consulta.php?action=voltar">Voltar</a></li>
                        <li class="scroll-to-section"><a href="apoiodecisao.php">Apoio Decisão</a></li>
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
        <?php //while $rows_info_pac=mysqli_fetch_array($resultado_infopac);?>
        <h4>Dados de Consulta</h4>
        <h1> <?php echo $rows_info_pac['nome']?> </h1>
        <br>
    </div>
    <div class="profile">
        <h5>Informações Gerais</h5>
        <div class="row">
            <div class="column c1">
                <label for="num_saude">Numero de Saude do Paciente</label><br>
                <input type="text" name="num_saude" value=" <?php echo $rows_info_pac['num_saude']?>"><br>
                <label for="afasia">Tipo de Afasia</label><br>
                <input type="text" name="afasia" value=" <?php echo $rows_info_pac['afasia_tipo']?>"><br>
            </div>
            <div class="column c2">
                <label for="cuidador">Cuidador</label><br>
                <input type="text" name="cuidador" value="<?php echo $rows_info_cui['nome']?>"><br>
            </div>
            <div class="column c3">
                <label for="terapeuta">Terapeuta</label><br>
                <input type="text" name="terapeuta" value="<?php echo $rows_info_ter['nome']?>"><br>
            </div>
        </div>
    </div>
    <br>
    <div class="pac">
        <div class="row">
            <div class="column c1">
                <form class="login" method="POST" action="consulta.php?action=exercicios" enctype="multipart/form-data">
                <h5> Exercicios a receitar pelo Terapeuta </h5>
                <br>
                <label for="dif_total">Dificuldade Total</label><br>
                <input min="1" max="12" class="inputresult" name="dif_total" type="number" placeholder="Dificuldade total"><br>
                    <input class="gradient-button savButton" type="submit"  name="gravar_exercicios" value="Receitar Exercicios">
                </div>
            <div class="column c2">
                <br>
                <br>
                <label for="ex_n">Exercicio N</label><br>
                <input min="0" max="3" class="inputresult" name="ex_n" type="number" placeholder="Dificuldade 1-3"><br>
                <label for="ex_c">Exercicio C</label><br>
                <input min="0" max="3" class="inputresult" name="ex_c" type="number" placeholder="Dificuldade 1-3"><br>
            </div>
            <div class="column c3">
                <br>
                <br>
                <label for="ex_f">Exercicio F</label><br>
                <input min="0" max="3" class="inputresult" name="ex_f" type="number" placeholder="Dificuldade 1-3"><br>
                <label for="ex_r">Exercicio R</label><br>
                <input min="0" max="3" class="inputresult" name="ex_r" type="number" placeholder="Dificuldade 1-3"><br>
                    <br>
            </div>
                </form>
            </div>
        </div>
        <br>
            <div class="pl">
                <div class="row">
                    <div class="column c1">
                        <?php while ($rows_sql_exercises= mysqli_fetch_array($resultado_sql_exercises)){ ?>
                        <h5> Exercicios Receitados </h5><br>
                        <?php echo "<h6>Dificuldade total: ".$rows_sql_exercises['difficulty']."</h6>"?>
                        <?php echo "<h6>Exercício N: ".$rows_sql_exercises['n_dif']."</h6>"?>
                        <?php echo "<h6>Exercício C: ".$rows_sql_exercises['c_dif']."</h6>"?>
                        <?php echo "<h6>Exercício F: ".$rows_sql_exercises['f_dif']."</h6>"?>
                        <?php echo "<h6>Exercício R: ".$rows_sql_exercises['r_dif']."</h6>"?>

                        <?php $_SESSION['dificuldade']=$rows_sql_exercises['difficulty']; } ?>
                    <br>
                        <a href="<?php $_SERVER['PHP_SELF']; ?>">Atualizar</a>
                    </div>
                    <div class="column c2">
                        <form class="login" method="POST" action="consulta.php?action=inserir" enctype="multipart/form-data">
                            <h5> Preenchimento pelo cuidador </h5>
                            <?php while ($rows_aval= mysqli_fetch_array($resultado_buscar_aval)){ ?>
                            <br>
                            <label for="avaliacao">Avaliação do Cuidador</label><br>
                            <input class="inputresult" name="avaliacao" type="number" value="<?php echo $rows_aval['paciente_pontuacao']?>">
                            <br>
                            <label for="auto-avaliacao">Auto-Avaliação do Paciente</label><br>
                            <input class="inputresult" name="auto_avaliacao" type="number" value="<?php echo $rows_aval['autoavaliacao']?>">
                            <br>
                            <label for="data">Data da Consulta</label><br>
                            <input type="date" name="data" value="<?php echo $rows_aval['data']?>"><br>
                    </div>
                    <div class="column c3">
                        <h5> Comentarios</h5>
                        <label for="comentarios">Possiveis esclarecimentos:</label>
                        <textarea id="comentarios" name="comentarios" rows="3" cols="40" > <?php echo $rows_aval['comentarios']?></textarea><br>
                        <br>
                        <input class="gradient-button savButton" type="submit"  name="resultados" value="Salvar Resultados">
                        <?php }?>
                        </form>
                    </div>
                </div>
            </div>
