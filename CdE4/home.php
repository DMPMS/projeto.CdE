<!doctype html>
<?php
session_start();

require_once("database.php");
$pdo = Database::connect();

require_once("outros/logado.php");

include_once("outros/redirecionarPara.php");

if (!logado()) {
    redirecionarPara("index.php", false);
} else {
    include_once("funcoes.php");
    include_once("componentes/html.php");
    include_once("componentes/scripts.php");
    include_once("componentes/toasts.php");
?>
    <html>

    <head>
        <title>Página Inicial</title>
        <!--Ícone-->
        <link rel="icon" href="dist/img/icone.png">
        <!--Fonte-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800">
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

        <!--Scripts-->
        <?php sair("outros/sair.php"); ?>
        <?php notificacaoBemVindo($_SESSION['nome']); ?>
        <!--/Scripts-->
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
                            <?php botaoNavegacao1("Usuários", "80", "primary", "users", "test.php"); ?>
                            <?php botaoNavegacao1("Produtos", "67", "success", "package", "test2.php"); ?>
                            <?php botaoNavegacao1("Vendas", "854", "warning", "shopping-cart", "test3.php"); ?>
                            <?php botaoNavegacao1("Tarefas", "93", "danger", "clipboard", "test4.php"); ?>
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