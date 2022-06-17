<?php
session_start();
if (isset($_SESSION["authuser"])&&$_SESSION["authuser"]==1) {
    $id_user = $_SESSION['id_utilizador'];
    $connect = mysqli_connect('localhost', 'root', '', 'database2')
    or die('Error connecting to the server: ' . mysqli_error($connect));
    $dados_paciente='SELECT * ,COUNT(*) AS distrito_count FROM paciente GROUP BY distrito';
    $result_dados = mysqli_query($connect, $dados_paciente) or die('The query failed: ' . mysqli_error($connect));
    $dados_paciente1='SELECT * ,COUNT(*) AS afasia_count FROM paciente GROUP BY afasia_tipo';
    $result_dados1 = mysqli_query($connect, $dados_paciente1) or die('The query failed: ' . mysqli_error($connect));
    $dados_consulta='SELECT * ,COUNT(*) AS consulta_count FROM registo_consulta GROUP BY paciente_id';
    $result_consulta=mysqli_query($connect, $dados_consulta) or die('The query failed: ' . mysqli_error($connect));
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

          <div class="text">
              <h4>Administrador</h4>
              <h1>Dados Estatisticos</h1>
          </div>
          <div class="containerBlocks">
              <div class="profile">
                  <h4>Dados estatisticos do Paciente</h4>
                  <div class="row">
                      <div class="column c1">
                          <?php
                          while ($data=mysqli_fetch_array($result_dados)) {
                              $distrito []=$data['distrito'];
                              $quantidade []=$data['distrito_count'];
                          }
                          ?>
                          <div>
                              <canvas id="myChart"></canvas>
                          </div>
                          <script>
                              const labels = <?php echo json_encode($distrito);?>;
                              const data = {
                                  labels: labels,
                                  datasets: [{
                                      label: 'Distribuição de pacientes por distrito',
                                      data:<?php echo json_encode($quantidade);?>,
                                      backgroundColor: [
                                          'rgba(255, 99, 132, 0.2)',
                                          'rgba(255, 159, 64, 0.2)',
                                          'rgba(255, 205, 86, 0.2)',
                                          'rgba(75, 192, 192, 0.2)',
                                          'rgba(54, 162, 235, 0.2)',
                                          'rgba(153, 102, 255, 0.2)',
                                          'rgba(201, 203, 207, 0.2)'
                                      ],
                                      borderColor: [
                                          'rgb(255, 99, 132)',
                                          'rgb(255, 159, 64)',
                                          'rgb(255, 205, 86)',
                                          'rgb(75, 192, 192)',
                                          'rgb(54, 162, 235)',
                                          'rgb(153, 102, 255)',
                                          'rgb(201, 203, 207)'
                                      ],
                                      borderWidth: 1
                                  }]
                              };
                              const config = {
                                  type: 'bar',
                                  data: data,
                                  options: {
                                      scales: {
                                          y: {
                                              beginAtZero: true
                                          }
                                      }
                                  },
                              };

                              const myChart = new Chart(
                                  document.getElementById('myChart'),
                                  config
                              );
                          </script>

                      </div>
                      <div class="column c2">
                          <?php
                          while ($data1=mysqli_fetch_array($result_dados1)) {
                              $afasia []=$data1['afasia_tipo'];
                              $quantidade_afasia []=$data1['afasia_count'];
                          }
                          ?>
                          <div>
                              <canvas id="myChart1"></canvas>
                          </div>

                          <script>
                            const labels1 = <?php echo json_encode($afasia);?>;
                            const data1 = {
                                labels: labels1,
                                datasets: [{
                                    label: 'Distribuição de tipos de afasia',
                                    data: <?php echo json_encode($quantidade_afasia);?>,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 130, 86, 0.2)',
                                        'rgba(201, 203, 207, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        'rgb(153, 102, 255)',
                                        'rgb(255, 130, 86)',
                                        'rgb(201, 203, 207)'
                                    ],
                                    borderWidth: 1
                                }]
                            };
                            const config1 = {
                                type: 'bar',
                                data: data1,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                },
                            };

                            const myChart1 = new Chart(
                                document.getElementById('myChart1'),
                                config1
                            );
                        </script>
                      </div>
                      <div class="column c3">
                          <?php
                          while ($data_consulta=mysqli_fetch_array($result_consulta)) {
                              $registo_consulta []=$data_consulta['paciente_id'];
                              $quantidade_consulta []=$data_consulta['consulta_count'];
                          }
                          ?>
                          <div>
                              <canvas id="myChart2"></canvas>
                          </div>
                          <script>
                              const labels2 = <?php echo json_encode($registo_consulta);?>;
                              const data2 = {
                                  labels: labels2,
                                  datasets: [{
                                      label: 'Distribuição de consultas',
                                      data: <?php echo json_encode($quantidade_consulta);?>,
                                      backgroundColor: [
                                          'rgba(255, 99, 132, 0.2)',
                                          'rgba(255, 159, 64, 0.2)',
                                          'rgba(255, 205, 86, 0.2)',
                                          'rgba(75, 192, 192, 0.2)',
                                          'rgba(54, 162, 235, 0.2)',
                                          'rgba(153, 102, 255, 0.2)',
                                          'rgba(250, 130, 74, 0.2)',
                                          'rgba(201, 203, 207, 0.2)'
                                      ],
                                      borderColor: [
                                          'rgb(255, 99, 132)',
                                          'rgb(255, 159, 64)',
                                          'rgb(255, 205, 86)',
                                          'rgb(75, 192, 192)',
                                          'rgb(54, 162, 235)',
                                          'rgb(153, 102, 255)',
                                          'rgb(250, 130, 74)',
                                          'rgb(201, 203, 207)'
                                      ],
                                      borderWidth: 1
                                  }]
                              };
                              const config2 = {
                                  type: 'bar',
                                  data: data2,
                                  options: {
                                      scales: {
                                          y: {
                                              beginAtZero: true
                                          }
                                      }
                                  },
                              };

                              const myChart2 = new Chart(
                                  document.getElementById('myChart2'),
                                  config2
                              );
                      </div>
                              </div>
      </div>
          </div>
      <div class="pac">
        <h4>Dados Estatisticos Consulta</h4>
        <div class="formPaciente" >
            <div class="column c1">


            </div>
            <div class="column c2">

            </div>
            <div class="column c3">

      </div>
      </div>
  </div>
      <div class="pl">
          <h4> Lista de Utilizadores</h4> <br>

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