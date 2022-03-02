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

    if ($_SESSION['tipo'] == "Administrador Geral") {
        $sqlAT = "SELECT * FROM cde_tarefa WHERE status = 'Pendente' AND CAST(data_prazo AS DATE) < '" . date('Y-m-d H:i:s') . "'";
        $sqlUC = "SELECT * FROM cde_tarefa WHERE status = 'Concluída' ORDER BY id DESC LIMIT 4";
        $sqlUT = "SELECT * FROM cde_tarefa ORDER BY id DESC LIMIT 4";
    } else {
        $sqlAT = "SELECT * FROM cde_tarefa WHERE id_responsavel IN(0,".$_SESSION['id'].") AND status = 'Pendente' AND CAST(data_prazo AS DATE) < '" . date('Y-m-d H:i:s') . "'";
        $sqlUC = "SELECT * FROM cde_tarefa WHERE id_responsavel IN(0,".$_SESSION['id'].") AND status = 'Concluída' ORDER BY id DESC LIMIT 4";
        $sqlUT = "SELECT * FROM cde_tarefa WHERE id_responsavel IN(0,".$_SESSION['id'].") ORDER BY id DESC LIMIT 4";
    }
    ?>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
<link rel="icon" type="image/png" href="../../img/ico.png">
            <title><?php if ($_SESSION['tipo'] != "Administrador Geral") { ?>Minhas <?php } ?>Tarefas</title>
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
                                <h1 class="h3 mb-0 text-gray-800"><?php if ($_SESSION['tipo'] != "Administrador Geral") { ?>Minhas <?php } ?>Tarefas</h1>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2 border-bottom-warning">
                                        <a href="../../home.php" class="semsublinhar">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Voltar</div>
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
                                        <div class="card border-left-warning shadow h-100 py-2 border-bottom-warning">
                                            <a href="cad_tarefa.php" class="semsublinhar">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Nova Tarefa</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> Nova Tarefa</div>
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
                                    <div class="card border-left-warning shadow h-100 py-2 border-bottom-warning">
                                        <a href="list_tarefa_pendente.php" class="semsublinhar">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tarefas Pendentes</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo QtdTarefasPendentes(); ?> Pendentes</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2 border-bottom-warning">
                                        <a href="list_tarefa_concluida.php" class="semsublinhar">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tarefas Concluídas</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo QtdTarefasConcluidas(); ?> Concluídas</div>
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
                                            <h6 class="m-0 font-weight-bold text-primary">Atrasadas</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="pt-4 mt-3">
                                                <div class="row">
                                                    <?php foreach ($pdo->query($sqlAT) as $row) { ?>
                                                        <div class=" col-lg-12">
                                                            <td><a href="info_tarefa.php?id=<?php echo $row['id']; ?>" style="vertical-align:middle" class="semsublinhar"><button class="btn-sm btn-circle btn-info semborda"><i class="fas fa-info-circle"></i></button></a> <a href="info_tarefa.php?id=<?php echo $row['id']; ?>" style="vertical-align:middle" class="semsublinhar"><?php echo $row['nome']; ?></a></td>
                                                            <br>
                                                            <td><a style="vertical-align:middle" class="semsublinhar">Prazo até <?php echo date('d/m/Y \à\s H:i', strtotime($row['data_prazo'])); ?></a></td>
                                                            <br><br>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Últimas Concluídas</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="pt-4 mt-3">
                                                <div class="row">
                                                    <?php foreach ($pdo->query($sqlUC) as $row) { ?>
                                                        <div class=" col-lg-12">
                                                            <td><a href="info_tarefa.php?id=<?php echo $row['id']; ?>" style="vertical-align:middle" class="semsublinhar"><button class="btn-sm btn-circle btn-info semborda"><i class="fas fa-info-circle"></i></button></a> <a href="info_tarefa.php?id=<?php echo $row['id']; ?>" style="vertical-align:middle" class="semsublinhar"><?php echo $row['nome']; ?></a></td>
                                                            <br>
                                                            <td><a style="vertical-align:middle" class="semsublinhar">Concluída no dia <?php echo date('d/m/Y \à\s H:i', strtotime($row['data_conclusao'])); ?></a></td>
                                                            <br><br>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Últimas Cadastradas</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="pt-4 mt-3">
                                                <div class="row">
                                                    <?php foreach ($pdo->query($sqlUT) as $row) { ?>
                                                        <div class=" col-lg-12">
                                                            <td><a href="info_tarefa.php?id=<?php echo $row['id']; ?>" style="vertical-align:middle" class="semsublinhar"><button class="btn-sm btn-circle btn-info semborda"><i class="fas fa-info-circle"></i></button></a> <a href="info_tarefa.php?id=<?php echo $row['id']; ?>" style="vertical-align:middle" class="semsublinhar"><?php echo $row['nome']; ?></a></td>
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

        </body>
    </html>
<?php } ?>