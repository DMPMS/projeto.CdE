<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "necessariologar.php";
        </script>';
} else {
    $idUsuario = $_SESSION['id'];
    $pdo = Database::connect();

    $sqlUV = "SELECT * FROM cde_venda_detalhe ORDER BY num_venda DESC LIMIT 4";
    $recordsUV = $pdo->prepare($sqlUV);
    $recordsUV->execute();
    $resultUV = $recordsUV->fetch(PDO::FETCH_ASSOC);
    ?>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
<link rel="icon" type="image/png" href="../../img/ico.png">
            <title>Vendas</title>
            <script>
                function Deslogar(){
                Swal.fire({
                title: 'Deseja realmente sair?',
                text: 'Selecione "Deslogar" abaixo se você estiver pronto para encerrar sua sessão atual.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonText: '<i class="fas fa-reply"></i> Cancelar',
                confirmButtonText: 'Deslogar <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                window.location = "../../logout.php";
                }
                })
                }
            </script>
            <link href="../../js/sweet/sweetalert2.min.css" rel="stylesheet" type="text/css">

            <!-- Custom fonts for this template-->
            <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

            <!-- Custom styles for this template-->
            <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

        </head>

        <body id="page-top">
            <div id="wrapper">
                <?php include '../menu.php'; ?> 
                <div id="content-wrapper" class="d-flex flex-column">
                    <div id="content">
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                            <ul class="navbar-nav ml-auto">
                                <div class="topbar-divider d-none d-sm-block"></div>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo NomeUsuario($idUsuario); ?></span>
                                        <img class="img-profile rounded-circle" src="../usuarios/fotos/<?php echo FotoUsuario($idUsuario); ?>">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="../../perfil.php">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Perfil
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="Deslogar()">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Deslogar
                                        </a>
                                    </div>
                                </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Vendas</h1>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2 border-bottom-info">
                                        <a href="../../home.php" class="semsublinhar">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Voltar</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> Voltar</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-reply fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2 border-bottom-info">
                                        <a href="cad_venda_cliente.php" class="semsublinhar">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nova Venda</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> Nova Venda</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2 border-bottom-info">
                                        <a href="list_venda.php" class="semsublinhar">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Lista de Vendas</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo QtdVendas(); ?> Vendas</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-comment-dollar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2 border-bottom-info">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Receita Total</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?php echo number_format(ReceitaTotal(), 2, ',', '.'); ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </button>
                            </div>

                            <!-- Content Row -->

                            <div class="row">
                                <div class="col-xl-8 col-lg-7">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Visão Geral de <?php echo AnoAtual(); ?></h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="pt-1 mt-4">

                                                <div class="chart-area">
                                                    <canvas id="GraficoAnual"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Últimas Vendas</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="pt-4 mt-3">
                                                <div class="row">
                                                    <?php foreach ($pdo->query($sqlUV) as $row) { ?>
                                                        <div class=" col-lg-12">
                                                            <td><a href="info_venda.php?num_venda=<?php echo $row['num_venda']; ?>" style="vertical-align:middle" class="semsublinhar"><button class="btn-sm btn-circle btn-info semborda"><i class="fas fa-info-circle"></i></button></a> <a href="info_venda.php?num_venda=<?php echo $row['num_venda']; ?>" style="vertical-align:middle" class="semsublinhar">Comprador(a): <?php echo $row['nome_cliente']; ?></a></td>
                                                            <br>
                                                            <td><a style="vertical-align:middle" class="semsublinhar">Valor: <?php echo number_format($row['valor'], 2, ",", ".") ?>; <?php echo substr($row['criadoem'], 5); ?>.</a></td>
                                                            <br><br>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Davi Monteiro 2020</span>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
            <script src="../../vendor/jquery/jquery.min.js"></script>
            <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="../../js/sb-admin-2.min.js"></script>
            <script src="../../vendor/chart.js/Chart.min.js"></script>
            <script src="../../js/demo/chart-area-demo.js"></script>
            <script src="../../js/demo/chart-pie-demo.js"></script>
            <script src="../../js/sweet/sweetalert2.all.min.js"></script>

            <script type="text/javascript">
                var ctx = document.getElementById("GraficoAnual");
                var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                datasets: [{
                label: "Receita",
                lineTension: 0,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 1,
                pointBorderWidth: 2,
                data: [<?php echo GraficoAnual(); ?>],
                }],
                },
                options: {
                maintainAspectRatio: false,
                layout: {
                padding: {
                left: -1,
                right: 25,
                top: 0,
                bottom: 0
                }
                },
                scales: {
                xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false,
                drawBorder: false
                },
                ticks: {
                maxTicksLimit: 12
                }
                }],
                yAxes: [{
                ticks: {
                maxTicksLimit: 10,
                padding: 10,
                callback: function(value, index, values) {
                return 'R$ ' + number_format(value, 2, ',', '.');
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
                }],
                },
                legend: {
                display: false
                },
                tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': R$ ' + number_format(tooltipItem.yLabel, 2, ',', '.');
                }
                }
                }
                }
                });

            </script>
        </body>
    </html>
<?php } ?>