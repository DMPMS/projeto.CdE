<!DOCTYPE html>
<?php
session_start();
require_once './funcoes.php';
include_once './database.php';

if (isset($_SESSION['id']) == '') {
    echo '<script> window.location = "index.php"; </script>';
} else {
?>
    <html lang="en">
        <head>
            <!--Metas-->
            <meta charset="utf-8">
            <meta name="description" content="" >
            <meta name="author" content="">
            <meta name="keywords" content="">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--Meta Responsiva-->
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!--Ícone-->
            <link rel="icon" href="ico.png" type="image/x-icon">
            <!--Bootstrap CSS-->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <!--Custom style.css-->
            <link rel="stylesheet" href="assets/css/quicksand.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <!--Font Awesome-->
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/fontawesome.css">
            <title>Página Inicial</title>
            <script>
                function Sair() {
                    window.location = "sair.php";
                }
            </script>
        </head>
        <body>
            <div class="container-fluid">
                <!--Navbar-->
                <?php include_once "./navbar.php"; ?>
                <!--/Navbar-->
                <!--Principal-->
                <div class="row">
                    <!--Sidebar-->
                    <?php include_once "./sidebar.php"; ?>
                    <!--/Sidebar-->
                    <!--Direita-->
                    <div class="col-sm-10 content pt-3 pl-0">
                        <h5 class="mb-3"><strong>Página Inicial</strong></h5>
                        <!--Página-->
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 mb-3">
                                    <a href="pages/usuarios/home_usuarios.php">
                                        <div class="bg-theme border shadow">
                                            <div class="media p-4">
                                                <div class="align-self-center mr-3 rounded-circle notify-icon bg-white">
                                                    <i class="fa fa-users text-theme"></i>
                                                </div>
                                                <div class="media-body pl-2">
                                                    <h3 class="mb-0"><strong><?php echo QtdUsuarios(); ?></strong></h3>
                                                    <p><small class="bc-description text-white">Usuários</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 mb-3">
                                    <a href="pages/usuarios/home_usuarios.php">
                                        <div class="bg-danger border shadow">
                                            <div class="media p-4">
                                                <div class="align-self-center mr-3 rounded-circle notify-icon bg-white">
                                                    <i class="fas fa-envelope-open text-danger"></i>
                                                </div>
                                                <div class="media-body pl-2 text-white">
                                                    <h3 class="mb-0"><strong>3.1M</strong></h3>
                                                    <p><small class="bc-description text-white">Customers</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--/Página-->
                        <!--Rodapé-->
                        <?php include_once './footer.php'; ?>
                        <!--/Rodapé-->
                    </div>
                    <!--/Direita-->
                </div>
                <!--/Principal-->
            </div>
            <!--jQuery-->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery-1.12.4.min.js"></script>
            <!--Popper-->
            <script src="assets/js/popper.min.js"></script>
            <!--Bootstrap-->
            <script src="assets/js/bootstrap.min.js"></script>
        </body>
    </html>
<?php } ?>