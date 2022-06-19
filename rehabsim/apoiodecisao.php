<?php
session_start();
echo "<script>console.log('bem vindo' );</script>";
$id_user = $_SESSION['id_utilizador'];
$consulta=$_SESSION['id_consulta'];
$afasia = $_SESSION['afasia'];
$dificuldade = $_SESSION['dificuldade'];
echo "<script>console.log('iduser:" . $id_user . "' );</script>";
echo "<script>console.log('consulta:" . $consulta . "' );</script>";
echo "<script>console.log('afasia:" . $afasia. "' );</script>";
echo "<script>console.log('dificuldade:" . $dificuldade . "' );</script>";

//$afasia = $_SESSION['afasia'];
//$dificuldade = $_SESSION['dificuldade'];
//$avaliacao_total=$_SESSION['avaliacao'];
//$avaliacao_utente=$_SESSION['avaliacao'];

    $connect = mysqli_connect('localhost', 'root', '', 'database2')
    or die('Error connecting to the server: ' . mysqli_error($connect));
    $dados_apoio='SELECT * FROM registo_consulta WHERE registo_consulta.id_consulta="'.$consulta.'"';
    $res_dados_apoio= mysqli_query($connect, $dados_apoio) or die('The query failed: '. mysqli_error($connect));
    $rows_res_apoio=mysqli_fetch_array($res_dados_apoio);

    //$query_exercises = 'SELECT * FROM exercises WHERE afasia = "'.$afasia.'" AND difficulty = "'.$dificuldade.'" ORDER BY RAND() LIMIT 1';
    //$exercises_result = mysqli_query($connect, $query_exercises) or die('The query failed:'. mysqli_error($connect));
    //variaveis
    $avaliacao_total=$rows_res_apoio['paciente_pontuacao'];
    $avaliacao_utente=$rows_res_apoio['autoavaliacao'];

    //tipo utilizador para voltar para tras
    $tipo_utilizador='SELECT tipo_utilizador_id FROM utilizador WHERE utilizador.id_utilizador="'.$id_user.'"';
    $result_tipo_user= mysqli_query($connect, $tipo_utilizador) or die('The query failed: '. mysqli_error($connect));
    $rows_tipo_user=mysqli_fetch_array($result_tipo_user);


echo "<script>console.log('id do exerc:" . $avaliacao_total . "' );</script>";
echo "<script>console.log('n de linhas:" . $avaliacao_utente . "' );</script>";

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "back":
            if (isset($_POST["nova_consulta"])) {
                if ($rows_tipo_user['tipo_utilizador_id'] == 2) {
                    header("Location: pag_terapeuta.php");
                }
                if ($rows_tipo_user['tipo_utilizador_id']== 3) {
                    echo "<script>alert('Não tem autorização para aceder a esta página.');</script>";
                }
            }
            break;
    }
}
    /*Terminal Node 1*/
    if
    ((
        $dificuldade == 12
        ) &&
        $avaliacao_total <= 5.865
    ) {
        ////terminalnode = -1;
        $dif_proxima_sessao = 11;
    }

    /*Terminal Node 2*/
    if
    (
        (
            $dificuldade == 12
        ) &&
        $avaliacao_total > 5.865 &&
        $avaliacao_total <= 8.715
    ) {
        ////terminalnode = -2;
        $dif_proxima_sessao = 12;
    }

    /*Terminal Node 3*/
    if
    (
        (
            $dificuldade == 12
        ) &&
        $avaliacao_total > 8.715
    ) {
        ////terminalnode = -3;
        $dif_proxima_sessao = 0;
    }

    /*Terminal Node 4*/
    if
    (
        (
            $dificuldade == 11
        ) &&
        $avaliacao_total <= 4.615
    ) {
        ////terminalnode = -4;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 5*/
    if
    (
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total <= 4.535
    ) {
        ////terminalnode = -5;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 6*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total > 4.535 &&
        $avaliacao_total <= 4.615
    ) {
        ////terminalnode = -6;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 7*/
    if
    (
        (
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 4
        ) &&
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total > 4.535 &&
        $avaliacao_total <= 4.615
    ) {
        ////terminalnode = -7;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 8*/
    if
    (
        (
            $dificuldade == 11
        ) &&
        (
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        $avaliacao_total > 4.615 &&
        $avaliacao_total <= 4.735
    ) {
        ////terminalnode = -8;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 9*/
    if
    (
        (
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total > 4.615 &&
        $avaliacao_total <= 4.735
    ) {
        ////terminalnode = -9;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 10*/
    if
    (
        (
            $avaliacao_utente == 4
        ) &&
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total > 4.615 &&
        $avaliacao_total <= 4.735
    ) {
        ////terminalnode = -10;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 11*/
    if
    (
        (
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 10 ||
            $dificuldade == 11
        ) &&
        $avaliacao_total > 4.615 &&
        $avaliacao_total <= 4.735
    ) {
        ////terminalnode = -11;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 12*/
    if
    (
        (
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 10 ||
            $dificuldade == 11
        ) &&
        $avaliacao_total > 4.735 &&
        $avaliacao_total <= 5.495
    ) {
        ////terminalnode = -12;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 13*/
    if
    (
        (
            $dificuldade == 11
        ) &&
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        $avaliacao_total > 4.615 &&
        $avaliacao_total <= 5.495
    ) {
        ////terminalnode = -13;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 14*/
    if
    (
        (
            $dificuldade == 10
        ) &&
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        $avaliacao_total > 4.615 &&
        $avaliacao_total <= 5.23
    ) {
        ////terminalnode = -14;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 15*/
    if
    (
        (
            $dificuldade == 10
        ) &&
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        $avaliacao_total > 5.23 &&
        $avaliacao_total <= 5.495
    ) {
        ////terminalnode = -15;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 16*/
    if
    (
        (
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total > 5.495 &&
        $avaliacao_total <= 7.005
    ) {
        ////terminalnode = -16;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 17*/
    if
    (
        (
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total > 7.005 &&
        $avaliacao_total <= 7.68
    ) {
        ////terminalnode = -17;
        $dif_proxima_sessao = 11;
    }

    /*Terminal Node 18*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4
        ) &&
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total > 5.495 &&
        $avaliacao_total <= 7.68
    ) {
        ////terminalnode = -18;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 19*/
    if
    (
        (
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total > 7.68
    ) {
        ////terminalnode = -19;
        $dif_proxima_sessao = 11;
    }

    /*Terminal Node 20*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $dificuldade == 10
        ) &&
        $avaliacao_total > 7.68
    ) {

        ////terminalnode = -20;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 21*/
    if
    (
        (
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 11
        ) &&
        $avaliacao_total > 5.495 &&
        $avaliacao_total <= 5.705
    ) {
        ////terminalnode = -21;
        $dif_proxima_sessao = 11;
    }

    /*Terminal Node 22*/
    if
    (
        (
            $avaliacao_utente == 1
        ) &&
        (
            $dificuldade == 11
        ) &&
        $avaliacao_total > 5.495 &&
        $avaliacao_total <= 5.705
    ) {
        ////terminalnode = -22;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 23*/
    if
    (
        (
            $dificuldade == 11
        ) &&
        $avaliacao_total > 5.705
    ) {
        ////terminalnode = -23;
        $dif_proxima_sessao = 11;
    }

    /*Terminal Node 24*/
    if
    (
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total <= 4.195
    ) {
        ////terminalnode = -24;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 25*/
    if
    (
        (
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 4.195 &&
        $avaliacao_total <= 4.61
    ) {
        ////terminalnode = -25;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 26*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 4.195 &&
        $avaliacao_total <= 4.61
    ) {
        //terminalnode = -26;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 27*/
    if
    (
        (
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 4.61 &&
        $avaliacao_total <= 4.795
    ) {
        //terminalnode = -27;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 28*/
    if
    (
        (
            $avaliacao_utente == 1
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 4.61 &&
        $avaliacao_total <= 4.795
    ) {
        //terminalnode = -28;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 29*/
    if
    (
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 4.795 &&
        $avaliacao_total <= 6.69
    ) {
        //terminalnode = -29;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 30*/
    if
    (
        (
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 6.69 &&
        $avaliacao_total <= 6.95
    ) {
        //terminalnode = -30;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 31*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 6.69 &&
        $avaliacao_total <= 6.95
    ) {
        //terminalnode = -31;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 32*/
    if
    (
        (
            $afasia == 1 ||
            $afasia == 2 ||
            $afasia == 3 ||
            $afasia == 4 ||
            $afasia == 7 ||
            $afasia == 8
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 6.95
    ) {
        //terminalnode = -32;
        $dif_proxima_sessao = 0;
    }

    /*Terminal Node 33*/
    if
    (
        (
            $afasia == 6
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 6.95 &&
        $avaliacao_total <= 7.2
    ) {
        //terminalnode = -33;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 34*/
    if
    (
        (
            $afasia == 6
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 7.2
    ) {
        //terminalnode = -34;
        $dif_proxima_sessao = 0;
    }

    /*Terminal Node 35*/
    if
    (
        (
            $afasia == 5
        ) &&
        (
            $dificuldade == 9
        ) &&
        $avaliacao_total > 6.95
    ) {
        //terminalnode = -35;
        $dif_proxima_sessao = 10;
    }

    /*Terminal Node 36*/
    if
    (
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total <= 3.565
    ) {
        //terminalnode = -36;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 37*/
    if
    (
        (
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 3.565 &&
        $avaliacao_total <= 3.855
    ) {
        //terminalnode = -37;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 38*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4
        ) &&
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 3.565 &&
        $avaliacao_total <= 3.855
    ) {
        //terminalnode = -38;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 39*/
    if
    (
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total <= 3.14
    ) {
        //terminalnode = -39;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 40*/
    if
    (
        (
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 3.14 &&
        $avaliacao_total <= 3.305
    ) {
        //terminalnode = -40;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 41*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4
        ) &&
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 3.14 &&
        $avaliacao_total <= 3.305
    ) {
        //terminalnode = -41;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 42*/
    if
    (
        (
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 3.305 &&
        $avaliacao_total <= 3.415
    ) {
        //terminalnode = -42;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 43*/
    if
    (
        (
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 3.305 &&
        $avaliacao_total <= 3.415
    ) {
        //terminalnode = -43;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 44*/
    if
    (
        (
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 3.415 &&
        $avaliacao_total <= 3.855
    ) {
        //terminalnode = -44;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 45*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 3.305 &&
        $avaliacao_total <= 3.745
    ) {
        //terminalnode = -45;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 46*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 3.745 &&
        $avaliacao_total <= 3.855
    ) {
        //terminalnode = -46;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 47*/
    if
    (
        (
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 3.855 &&
        $avaliacao_total <= 4.065
    ) {
        //terminalnode = -47;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 48*/
    if
    (
        (
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 3.855 &&
        $avaliacao_total <= 3.92
    ) {
        //terminalnode = -48;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 49*/
    if
    (
        (
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 3.92 &&
        $avaliacao_total <= 4.065
    ) {
        //terminalnode = -49;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 50*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 3.855 &&
        $avaliacao_total <= 4.065
    ) {
        //terminalnode = -50;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 51*/
    if
    (
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 4.065 &&
        $avaliacao_total <= 6.085
    ) {
        //terminalnode = -51;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 52*/
    if
    (
        (
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 6.085 &&
        $avaliacao_total <= 6.19
    ) {
        //terminalnode = -52;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 53*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 6.085 &&
        $avaliacao_total <= 6.19
    ) {
        //terminalnode = -53;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 54*/
    if
    (
        (
            $dificuldade == 8
        ) &&
        $avaliacao_total > 6.19
    ) {
        //terminalnode = -54;
        $dif_proxima_sessao = 9;
    }

    /*Terminal Node 55*/
    if
    (
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 3.855 &&
        $avaliacao_total <= 5.085
    ) {
        //terminalnode = -55;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 56*/
    if
    (
        (
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 5.085 &&
        $avaliacao_total <= 5.4
    ) {
        //terminalnode = -56;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 57*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 5.085 &&
        $avaliacao_total <= 5.4
    ) {
        //terminalnode = -57;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 58*/
    if
    (
        (
            $dificuldade == 7
        ) &&
        $avaliacao_total > 5.4
    ) {
        //terminalnode = -58;
        $dif_proxima_sessao = 8;
    }

    /*Terminal Node 59*/
    if
    (
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total <= 2.71
    ) {
        //terminalnode = -59;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 60*/
    if
    (
        (
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 2.71 &&
        $avaliacao_total <= 2.815
    ) {
        //terminalnode = -60;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 61*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 2.71 &&
        $avaliacao_total <= 2.815
    ) {
        //terminalnode = -61;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 62*/
    if
    (
        (
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 2.815 &&
        $avaliacao_total <= 2.955
    ) {
        //terminalnode = -62;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 63*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 2.815 &&
        $avaliacao_total <= 2.955
    ) {
        //terminalnode = -63;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 64*/
    if
    (
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total <= 2.265
    ) {
        //terminalnode = -64;
        $dif_proxima_sessao = 4;
    }

    /*Terminal Node 65*/
    if
    (
        (
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 2.265 &&
        $avaliacao_total <= 2.365
    ) {
        //terminalnode = -65;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 66*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 4
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 2.265 &&
        $avaliacao_total <= 2.365
    ) {
        //terminalnode = -66;
        $dif_proxima_sessao = 4;
    }

    /*Terminal Node 67*/
    if
    (
        (
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 2.365 &&
        $avaliacao_total <= 2.955
    ) {
        //terminalnode = -67;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 68*/
    if
    (
        (
            $avaliacao_utente == 1
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 2.365 &&
        $avaliacao_total <= 2.68
    ) {
        //terminalnode = -68;
        $dif_proxima_sessao = 4;
    }

    /*Terminal Node 69*/
    if
    (
        (
            $avaliacao_utente == 1
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 2.68 &&
        $avaliacao_total <= 2.955
    ) {
        //terminalnode = -69;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 70*/
    if
    (
        (
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 2.955 &&
        $avaliacao_total <= 3.065
    ) {
        //terminalnode = -70;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 71*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 2.955 &&
        $avaliacao_total <= 3.065
    ) {
        //terminalnode = -71;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 72*/
    if
    (
        (
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 3.065 &&
        $avaliacao_total <= 3.195
    ) {
        //terminalnode = -72;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 73*/
    if
    (
        (
            $avaliacao_utente == 1
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 3.065 &&
        $avaliacao_total <= 3.195
    ) {
        ////terminalnode = -73;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 74*/
    if
    (
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 3.195 &&
        $avaliacao_total <= 4.355
    ) {
        ////terminalnode = -74;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 75*/
    if
    (
        (
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 4.355 &&
        $avaliacao_total <= 4.495
    ) {
        ////terminalnode = -75;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 76*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 4
        ) &&
        (
            $dificuldade == 6
        ) &&
        $avaliacao_total > 4.355 &&
        $avaliacao_total <= 4.495
    ) {
        ////terminalnode = -76;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 77*/
    if
    (
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 2.955 &&
        $avaliacao_total <= 3.695
    ) {
        ////terminalnode = -77;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 78*/
    if
    (
        (
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 3.695 &&
        $avaliacao_total <= 4.495
    ) {
        ////terminalnode = -78;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 79*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 3.695 &&
        $avaliacao_total <= 3.92
    ) {
        ////terminalnode = -79;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 80*/
    if
    (
        (
            $avaliacao_utente == 2 ||
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 3.92 &&
        $avaliacao_total <= 4.495
    ) {
        ////terminalnode = -80;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 81*/
    if
    (
        (
            $avaliacao_utente == 1
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 3.92 &&
        $avaliacao_total <= 4.07
    ) {
        ////terminalnode = -81;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 82*/
    if
    (
        (
            $avaliacao_utente == 1
        ) &&
        (
            $dificuldade == 5
        ) &&
        $avaliacao_total > 4.07 &&
        $avaliacao_total <= 4.495
    ) {
        ////terminalnode = -82;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 83*/
    if
    (
        (
            $dificuldade == 6
        ) &&
        (
            $afasia == 2 ||
            $afasia == 3 ||
            $afasia == 4 ||
            $afasia == 8
        ) &&
        $avaliacao_total > 4.495
    ) {
        ////terminalnode = -83;
        $dif_proxima_sessao = 0;
    }

    /*Terminal Node 84*/
    if
    (
        (
            $dificuldade == 5
        ) &&
        (
            $afasia == 2 ||
            $afasia == 3 ||
            $afasia == 4 ||
            $afasia == 8
        ) &&
        $avaliacao_total > 4.495
    ) {
        ////terminalnode = -84;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 85*/
    if
    (
        (
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 6
        ) &&
        (
            $afasia == 1 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7
        ) &&
        $avaliacao_total > 4.495
    ) {
        ////terminalnode = -85;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 86*/
    if
    (
        (
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 6
        ) &&
        (
            $afasia == 1 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7
        ) &&
        $avaliacao_total > 4.495 &&
        $avaliacao_total <= 4.63
    ) {
        ////terminalnode = -86;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 87*/
    if
    (
        (
            $avaliacao_utente == 3
        ) &&
        (
            $dificuldade == 6
        ) &&
        (
            $afasia == 1 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7
        ) &&
        $avaliacao_total > 4.63
    ) {
        ////terminalnode = -87;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 88*/
    if
    (
        (
            $dificuldade == 5
        ) &&
        (
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $afasia == 1 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7
        ) &&
        $avaliacao_total > 4.495
    ) {
        ////terminalnode = -88;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 89*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $afasia == 1 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7
        ) &&
        (
            $dificuldade == 5 ||
            $dificuldade == 6
        ) &&
        $avaliacao_total > 4.495 &&
        $avaliacao_total <= 4.91
    ) {
        ////terminalnode = -89;
        $dif_proxima_sessao = 6;
    }

    /*Terminal Node 90*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $afasia == 1 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7
        ) &&
        (
            $dificuldade == 5 ||
            $dificuldade == 6
        ) &&
        $avaliacao_total > 4.91
    ) {
        ////terminalnode = -90;
        $dif_proxima_sessao = 7;
    }

    /*Terminal Node 91*/
    if
    (
        (
            $afasia == 2 ||
            $afasia == 3 ||
            $afasia == 5 ||
            $afasia == 8
        ) &&
        (
            $dificuldade == 1 ||
            $dificuldade == 2 ||
            $dificuldade == 3
        ) &&
        $avaliacao_total <= 1.525
    ) {
        ////terminalnode = -91;
        $dif_proxima_sessao = 2;
    }

    /*Terminal Node 92*/
    if
    (
        (
            $afasia == 1 ||
            $afasia == 6 ||
            $afasia == 7
        ) &&
        (
            $dificuldade == 1 ||
            $dificuldade == 2 ||
            $dificuldade == 3
        ) &&
        $avaliacao_total <= 1.525
    ) {
        ////terminalnode = -92;
        $dif_proxima_sessao = 3;
    }

    /*Terminal Node 93*/
    if
    (
        (
            $dificuldade == 1 ||
            $dificuldade == 2 ||
            $dificuldade == 3
        ) &&
        (
            $afasia == 1 ||
            $afasia == 2 ||
            $afasia == 3 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7 ||
            $afasia == 8
        ) &&
        $avaliacao_total > 1.525 &&
        $avaliacao_total <= 2.215
    ) {
        ////terminalnode = -93;
        $dif_proxima_sessao = 3;
    }

    /*Terminal Node 94*/
    if
    (
        (
            $avaliacao_utente == 3 ||
            $avaliacao_utente == 4 ||
            $avaliacao_utente == 5
        ) &&
        (
            $dificuldade == 1 ||
            $dificuldade == 2 ||
            $dificuldade == 3
        ) &&
        (
            $afasia == 1 ||
            $afasia == 2 ||
            $afasia == 3 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7 ||
            $afasia == 8
        ) &&
        $avaliacao_total > 2.215 &&
        $avaliacao_total <= 2.365
    ) {
        ////terminalnode = -94;
        $dif_proxima_sessao = 4;
    }

    /*Terminal Node 95*/
    if
    (
        (
            $avaliacao_utente == 1 ||
            $avaliacao_utente == 2
        ) &&
        (
            $dificuldade == 1 ||
            $dificuldade == 2 ||
            $dificuldade == 3
        ) &&
        (
            $afasia == 1 ||
            $afasia == 2 ||
            $afasia == 3 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7 ||
            $afasia == 8
        ) &&
        $avaliacao_total > 2.215 &&
        $avaliacao_total <= 2.365
    ) {
        ////terminalnode = -95;
        $dif_proxima_sessao = 3;
    }

    /*Terminal Node 96*/
    if
    (
        (
            $dificuldade == 1 ||
            $dificuldade == 2 ||
            $dificuldade == 3
        ) &&
        (
            $afasia == 1 ||
            $afasia == 2 ||
            $afasia == 3 ||
            $afasia == 5 ||
            $afasia == 6 ||
            $afasia == 7 ||
            $afasia == 8
        ) &&
        $avaliacao_total > 2.365
    ) {
        ////terminalnode = -96;
        $dif_proxima_sessao = 4;
    }

    /*Terminal Node 97*/
    if
    (
        (
            $afasia == 1 ||
            $afasia == 2 ||
            $afasia == 3 ||
            $afasia == 6 ||
            $afasia == 7 ||
            $afasia == 8
        ) &&
        (
            $dificuldade == 4
        ) &&
        $avaliacao_total <= 1.815
    ) {
        ////terminalnode = -97;
        $dif_proxima_sessao = 3;
    }

    /*Terminal Node 98*/
    if
    (
        (
            $afasia == 1 ||
            $afasia == 3 ||
            $afasia == 6 ||
            $afasia == 8
        ) &&
        (
            $dificuldade == 4
        ) &&
        $avaliacao_total > 1.815 &&
        $avaliacao_total <= 1.88
    ) {
        ////terminalnode = -98;
        $dif_proxima_sessao = 3;
    }

    /*Terminal Node 99*/
    if
    (
        (
            $afasia == 2 ||
            $afasia == 7
        ) &&
        (
            $dificuldade == 4
        ) &&
        $avaliacao_total > 1.815 &&
        $avaliacao_total <= 1.88
    ) {
        ////terminalnode = -99;
        $dif_proxima_sessao = 4;
    }

    /*Terminal Node 100*/
    if
    (($afasia == 5) && ($dificuldade == 4) && $avaliacao_total <= 1.88) {////terminalnode = -100;
        $dif_proxima_sessao = 4;
    }
    /*Terminal Node 101*/
    if (($avaliacao_utente == 3 || $avaliacao_utente == 4 || $avaliacao_utente == 5) && ($dificuldade == 4) && ($afasia == 1 || $afasia == 2 || $afasia == 3 || $afasia == 5 || $afasia == 6 || $afasia == 7 || $afasia == 8) && $avaliacao_total > 1.88 && $avaliacao_total <= 2.12) {////terminalnode = -101;
        $dif_proxima_sessao = 4;
    }

    /*Terminal Node 102*/
    if (($avaliacao_utente == 1 || $avaliacao_utente == 2) && ($dificuldade == 4) && ($afasia == 1 || $afasia == 2 || $afasia == 3 || $afasia == 5 || $afasia == 6 || $afasia == 7 || $afasia == 8) && $avaliacao_total > 1.88 && $avaliacao_total <= 2.12) {////terminalnode = -102;
        $dif_proxima_sessao = 3;
    }

    /*Terminal Node 103*/
    if (($dificuldade == 4) && ($afasia == 1 || $afasia == 2 || $afasia == 3 || $afasia == 5 || $afasia == 6 || $afasia == 7 || $afasia == 8) && $avaliacao_total > 2.12 && $avaliacao_total <= 2.975) {////terminalnode = -103;
        $dif_proxima_sessao = 4;
    }

    /*Terminal Node 104*/
    if (($avaliacao_utente == 3 || $avaliacao_utente == 4 || $avaliacao_utente == 5) && ($dificuldade == 4) && ($afasia == 1 || $afasia == 2 || $afasia == 3 || $afasia == 5 || $afasia == 6 || $afasia == 7 || $afasia == 8) && $avaliacao_total > 2.975 && $avaliacao_total <= 3.095) {////terminalnode = -104;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 105*/
    if (($avaliacao_utente == 1 || $avaliacao_utente == 2) && ($dificuldade == 4) && ($afasia == 1 || $afasia == 2 || $afasia == 3 || $afasia == 5 || $afasia == 6 || $afasia == 7 || $afasia == 8) && $avaliacao_total > 2.975 && $avaliacao_total <= 3.095) {////terminalnode = -105;
        $dif_proxima_sessao = 4;
    }

    /*Terminal Node 106*/
    if (($dificuldade == 4) && ($afasia == 1 || $afasia == 2 || $afasia == 3 || $afasia == 5 || $afasia == 6 || $afasia == 7 || $afasia == 8) && $avaliacao_total > 3.095) {
        ////terminalnode = -106;
        $dif_proxima_sessao = 5;
    }

    /*Terminal Node 107*/
    if
    (($dificuldade == 3 || $dificuldade == 4) && ($afasia == 4) && $avaliacao_total <= 0.99) {////terminalnode = -107;
        $dif_proxima_sessao = 2;
    }

    /*Terminal Node 108*/
    if
    (($dificuldade == 1 || $dificuldade == 2) && ($afasia == 4) && $avaliacao_total <= 0.78) {
        ////terminalnode = -108;
        $dif_proxima_sessao = 1;
    }

    /*Terminal Node 109*/
    if
    (($dificuldade == 2) && ($afasia == 4) && $avaliacao_total > 0.78 && $avaliacao_total <= 0.99) {
        ////terminalnode = -109;
        $dif_proxima_sessao = 1;
    }

    /*Terminal Node 110*/
    if
    (($dificuldade == 1) && ($afasia == 4) && $avaliacao_total > 0.78 && $avaliacao_total <= 0.99) {
        ////terminalnode = -110;
        $dif_proxima_sessao = 2;
    }

    /*Terminal Node 111*/
    if
    (($afasia == 4) && ($dificuldade == 1 || $dificuldade == 2 || $dificuldade == 3 || $dificuldade == 4) && $avaliacao_total > 0.99 && $avaliacao_total <= 1.47) {
        ////terminalnode = -111;
        $dif_proxima_sessao = 2;
    }

    /*Terminal Node 112*/
    if
    (($dificuldade == 1 || $dificuldade == 3 || $dificuldade == 4) && ($afasia == 4) && $avaliacao_total > 1.47 && $avaliacao_total <= 1.56) {
        ////terminalnode = -112;
        $dif_proxima_sessao = 3;
    }

    /*Terminal Node 113*/
    if
    (($dificuldade == 2) && ($afasia == 4) && $avaliacao_total > 1.47 && $avaliacao_total <= 1.56) {////terminalnode = -113;
        $dif_proxima_sessao = 2;
    }

    /*Terminal Node 114*/
    if
    (($afasia == 4) && ($dificuldade == 1 || $dificuldade == 2 || $dificuldade == 3 || $dificuldade == 4) && $avaliacao_total > 1.56 && $avaliacao_total <= 2.325) {// //terminalnode = -114;
        $dif_proxima_sessao = 3;
    }

    /*Terminal Node 115*/
    if
    (($afasia == 4) && ($dificuldade == 1 || $dificuldade == 2 || $dificuldade == 3 || $dificuldade == 4) && $avaliacao_total > 2.325) {////terminalnode = -115;
        $dif_proxima_sessao = 0;
    }

    //ir buscar exercícios dependendo do resultado
    $buscar_exercicios='SELECT * FROM exercises WHERE exercises.afasia="'.$afasia.'" AND exercises.difficulty="'.$dif_proxima_sessao.'"';
    $result_buscar_ex=mysqli_query($connect, $buscar_exercicios) or die('The query failed: '. mysqli_error($connect));

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
    <div class="text">
        <h4>Sistema de apoio à decisão</h4>
        <h1>Consulta ID <?php echo $consulta?></h1>
    </div>
    <div class="containerBlocks">
        <div class="profile">
                <div class="row">
                    <div class="column c1">
                        <?php echo "<h5 class='text_center'>Dificuldade Próxima Sessão: </h5> <br> <h1 class='text_center'>".$dif_proxima_sessao."</h1>"?>
                    </div>
                    <div class="column c2">
                        <h5 class='text_center'> Possiveis Conjuntos de exercícios</h5>
                        <br>
                    <?php while ($rows_buscar=mysqli_fetch_array($result_buscar_ex)){ ?>
                        <ul>
                            <li><?php echo "<h6 class='text_center'> N:".$rows_buscar['n_dif']." - C:".$rows_buscar['c_dif']." - F:".$rows_buscar['f_dif']." - R: ".$rows_buscar['r_dif']."</h6>"?></li>
                        </ul>
                        <?php } ?>
                    </div>
                    <div class="column c3">
                        <br><br><br><br>
                        <form class="login" method="POST" action="apoiodecisao.php?action=back" enctype="multipart/form-data">
                        <input class="savButton text_center" type="submit"  name="nova_consulta" value="Marcar Nova Consulta">
                        </form>
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