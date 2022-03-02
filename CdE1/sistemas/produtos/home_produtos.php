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

    $sqlMV = "SELECT *, SUM(qtd_produto) as total FROM cde_venda GROUP BY id_produto ORDER BY total DESC LIMIT 3";
    $recordsMV = $pdo->prepare($sqlMV);
    $recordsMV->execute();
    $resultMV = $recordsMV->fetch(PDO::FETCH_ASSOC);

    $sqlMR = "SELECT *, SUM(preco_produto * qtd_produto) as total FROM cde_venda GROUP BY id_produto ORDER BY total DESC LIMIT 3";
    $recordsMR = $pdo->prepare($sqlMR);
    $recordsMR->execute();
    $resultMR = $recordsMR->fetch(PDO::FETCH_ASSOC);

    $sqlUC = "SELECT * FROM cde_produto ORDER BY id DESC LIMIT 4";
    $recordsUC = $pdo->prepare($sqlUC);
    $recordsUC->execute();
    $resultUC = $recordsUC->fetch(PDO::FETCH_ASSOC);

    $sqlMV1 = "SELECT *, SUM(qtd_produto) as total FROM cde_venda GROUP BY id_produto ORDER BY total DESC LIMIT 1";
    $sqlMV2 = "SELECT *, SUM(qtd_produto) as total FROM cde_venda GROUP BY id_produto ORDER BY total DESC LIMIT 1,1";
    $sqlMV3 = "SELECT *, SUM(qtd_produto) as total FROM cde_venda GROUP BY id_produto ORDER BY total DESC LIMIT 2,1";
    $sqlMR1 = "SELECT *, SUM(preco_produto * qtd_produto) as total FROM cde_venda GROUP BY id_produto ORDER BY total DESC LIMIT 1";
    $sqlMR2 = "SELECT *, SUM(preco_produto * qtd_produto) as total FROM cde_venda GROUP BY id_produto ORDER BY total DESC LIMIT 1,1";
    $sqlMR3 = "SELECT *, SUM(preco_produto * qtd_produto) as total FROM cde_venda GROUP BY id_produto ORDER BY total DESC LIMIT 2,1";
    ?>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
<link rel="icon" type="image/png" href="../../img/ico.png">
            <title>Produtos</title>
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
                                <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2 border-bottom-success">
                                        <a href="../../home.php" class="semsublinhar">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Voltar</div>
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
                                <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2 border-bottom-success">
                                            <a href="cad_produto.php" class="semsublinhar">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Novo Produto</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> Novo Produto</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2 border-bottom-success">
                                        <a href="list_produto.php" class="semsublinhar">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Lista de Produtos</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo QtdProdutos(); ?> Produtos</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-box-open fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2 border-bottom-success">
                                            <a href="cad_tipo.php" class="semsublinhar">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Novo Tipo</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> Novo Tipo</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2 border-bottom-success">
                                        <a href="list_tipo.php" class="semsublinhar">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Lista de Tipos</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo QtdTipos(); ?> Tipos</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                </button>
                            </div>

                            <!-- Content Row -->

                            <div class="row">
                                <div class="col-xl-4 col-lg-5">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Mais Vendidos</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="chart-pie pt-4 pb-2">
                                                <canvas id="MaisVendas"></canvas>
                                            </div>
                                            <div class="mt-3">
                                                <?php foreach ($pdo->query($sqlMV1) as $row) { ?>
                                                    <div class="small">
                                                        <span>
                                                            <i class="fas fa-circle text-success"></i> <?php echo $row['total']; ?> Unidades - <?php echo $row['nome_produto']; ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                <?php foreach ($pdo->query($sqlMV2) as $row) { ?>
                                                    <div class="small">
                                                        <span>
                                                            <i class="fas fa-circle" style="color: #FFB5C5;"></i> <?php echo $row['total']; ?> Unidades - <?php echo $row['nome_produto']; ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                <?php foreach ($pdo->query($sqlMV3) as $row) { ?>
                                                    <div class="small">
                                                        <span>
                                                            <i class="fas fa-circle" style="color: #ADFF2F;"></i> <?php echo $row['total']; ?> Unidades - <?php echo $row['nome_produto']; ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Maiores Receitas</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="chart-pie pt-4 pb-2">
                                                <canvas id="MaisReceitas"></canvas>
                                            </div>
                                            <?php foreach ($pdo->query($sqlMR1) as $row) { ?>
                                                <div class="small mt-3">
                                                    <span>
                                                        <i class="fas fa-circle text-success"></i> R$ <?php echo number_format($row['total'], 2, ',', '.'); ?> - <?php echo $row['nome_produto']; ?>
                                                    </span>
                                                </div>
                                            <?php } ?>
                                            <?php foreach ($pdo->query($sqlMR2) as $row) { ?>
                                                <div class="small">
                                                    <span>
                                                        <i class="fas fa-circle" style="color: #FFB5C5;"></i> R$ <?php echo number_format($row['total'], 2, ',', '.'); ?> - <?php echo $row['nome_produto']; ?>
                                                    </span>
                                                </div>
                                            <?php } ?>
                                            <?php foreach ($pdo->query($sqlMR3) as $row) { ?>
                                                <div class="small">
                                                    <span>
                                                        <i class="fas fa-circle" style="color: #ADFF2F;"></i> R$ <?php echo number_format($row['total'], 2, ',', '.'); ?> - <?php echo $row['nome_produto']; ?>
                                                    </span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Últimos cadastrados</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="pt-4 mt-3">
                                                <div class="row">
                                                    <?php foreach ($pdo->query($sqlUC) as $row) { ?>
                                                        <div class=" col-lg-12">
                                                            <td><a href="info_produto.php?id=<?php echo $row['id']; ?>" style="vertical-align:middle" class="semsublinhar"><button class="btn-sm btn-circle btn-info semborda"><i class="fas fa-info-circle"></i></button></a> <a href="info_produto.php?id=<?php echo $row['id']; ?>" style="vertical-align:middle" class="semsublinhar"><?php echo $row['nome']; ?></a></td>
                                                            <br>
                                                            <td><a style="vertical-align:middle" class="semsublinhar">Criado no dia <?php echo $row['criadoem']; ?></a></td>
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
                var MV = document.getElementById("MaisVendas");
                var MaisVendas = new Chart(MV, {
                type: 'doughnut',
                data: {
                labels: [<?php
                foreach ($pdo->query($sqlMV) as $row) {
                    echo '"' . $row['nome_produto'] . '",';
                }
                ?>],
                datasets: [{
                data: [<?php
                foreach ($pdo->query($sqlMV) as $row) {
                    echo $row['total'] . ',';
                }
                ?>],
                backgroundColor: ['#1cc88a', '#FFB5C5', '#ADFF2F'],
                hoverBackgroundColor: ['#17a673', '#CD919E', '#9ACD32'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
                },
                options: {
                maintainAspectRatio: false,
                tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                },
                legend: {
                display: false
                },
                cutoutPercentage: 80,
                },
                });
                ///////////////////////////////////////////////////////////////////
                var sqlMR = document.getElementById("MaisReceitas");
                var MaisReceitas = new Chart(sqlMR, {
                type: 'doughnut',
                data: {
                labels: [<?php
                foreach ($pdo->query($sqlMR) as $row) {
                    echo '"' . $row['nome_produto'] . '",';
                }
                ?>],
                datasets: [{
                data: [<?php
                foreach ($pdo->query($sqlMR) as $row) {
                    echo $row['total'] . ',';
                }
                ?>],
                backgroundColor: ['#1cc88a', '#FFB5C5', '#ADFF2F'],
                hoverBackgroundColor: ['#17a673', '#CD919E', '#9ACD32'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
                },
                options: {
                maintainAspectRatio: false,
                tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                },
                legend: {
                display: false
                },
                cutoutPercentage: 80,
                },
                });

            </script>
        </body>
    </html>
<?php } ?>