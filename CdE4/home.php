<!doctype html>
<?php
session_start();

require_once("database.php");
$pdo = Database::connect();

require_once("outros/outrasFuncoes.php");

if (!logado()) {
    redirecionarPara("index.php", false);
} else {
    include_once("funcoes.php");
    include_once("componentes/modals.php");
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
        <link rel="stylesheet" href="<?php fonte();?>">
        <!--Bootstrap-->
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <!--Ik Ícones-->
        <link rel="stylesheet" href="plugins/icon-kit/css/iconkit.min.css">
        <!--ScroolBar Menu-->
        <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <!--jQuery Toast-->
        <link rel="stylesheet" href="plugins/jquery-toast/css/jquery.toast.min.css">
        <!--Theme CSS-->
        <link rel="stylesheet" href="dist/css/theme.min.css">

        <!--Scripts-->
        <?php sair("outros/sair.php"); ?>
        <?php toastBemVindo(); ?>
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
                        <!--Page-Header-->
                        <?php pageHeader([6, [], ["home", "blue"]],
                                         [6, [], "Página Inicial"]); ?>
                        <!--/Page-Header-->
                        <div class="row clearfix">
                            <?php botaoNavegacao1("Usuários", qtdUsuarios(), "primary", "users", "modulos/usuarios/usuarios.home.php"); ?>
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