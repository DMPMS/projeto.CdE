<!doctype html>
<?php
session_start();

require_once("database.php");
$pdo = Database::connect();

include_once("funcoes.php");

if (!logado()) {
    redirecionarPara("index.php");
} else {
?>
    <html class="no-js" lang="en">

    <head>
        <title>Página Inicial</title>
        <!--Ícone-->
        <link rel="icon" href="dist/img/icone.png" type="image/x-icon" />
        <!--Fonte-->
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        <!--Bootstrap-->
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <!--Ik Ícones-->
        <link rel="stylesheet" href="plugins/icon-kit/css/iconkit.min.css">
        <!--ScroolBar Menu-->
        <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <!--Pra Notificação-->
        <link rel="stylesheet" href="plugins/jquery-toast/css/jquery.toast.min.css">
        <!--Theme CSS-->
        <link rel="stylesheet" href="dist/css/theme.min.css">
        <script>
            function Sair() {
                window.location = "outros/sair.php";
            }
        </script>

        <?php notificacaoBemVindo($_SESSION['nome']); ?>
    </head>

    <body>
        <div class="wrapper">
            <!--Header-->
            <?php include_once 'componentes/header.php'; ?>
            <!--/Header-->
            <div class="page-wrap">
                <!--Sidebar-->
                <?php include_once 'componentes/sidebar.php'; ?>
                <!--/Sidebar-->
                <!--Principal-->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="page-header-title">
                                        <i class="ik ik-home bg-blue"></i>
                                    </div>
                                    <nav class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Página Inicial</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="pages/usuarios/home_usuarios.php">
                                    <div class="widget bg-primary shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Usuários</h6>
                                                    <h2>28</h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-users"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="pages/produtos/home_produtos.php">
                                    <div class="widget bg-success shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Produtos</h6>
                                                    <h2>21</h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-package"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="pages/vendas/home_vendas.php">
                                    <div class="widget bg-warning shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Vendas</h6>
                                                    <h2>35</h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-shopping-cart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="">
                                    <div class="widget bg-danger shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Tarefas</h6>
                                                    <h2>23</h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-clipboard"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Principal-->
                <!--Footer-->
                <?php include_once 'componentes/footer.php'; ?>
                <!--/Footer-->
            </div>
        </div>
        <!--jQuery-->
        <script src="plugins/jquery/js/jquery-3.3.1.min.js"></script>
        <!--Popper (Header)-->
        <script src="plugins/popper.js/js/popper.min.js"></script>
        <!--Bootstrap-->
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
        <!--ScroolBar Menu-->
        <script src="plugins/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
        <!--Pra Notificação-->
        <script src="plugins/jquery-toast/js/jquery.toast.min.js"></script>
        <!--Theme JS-->
        <script src="dist/js/theme.min.js"></script>
    </body>

    </html>
<?php } ?>