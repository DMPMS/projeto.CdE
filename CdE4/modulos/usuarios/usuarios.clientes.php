<!doctype html>
<?php
session_start();

require_once("../../database.php");
$pdo = Database::connect();

require_once("../../outros/logado.php");

include_once("../../outros/redirecionarPara.php");

if (!logado()) {
    redirecionarPara("../../index.php", false);
} else {
    include_once("../../funcoes.php");
    include_once("../../componentes/modals.php");
    include_once("../../componentes/html.php");
    include_once("../../componentes/scripts.php");
    include_once("../../componentes/toasts.php");

    $sqlClientes = "SELECT * FROM usuarios_usuarios WHERE tipo IN('Cliente') AND ativo = 0";

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['Excluir']) == 'Excluir') {
        ExcluirUsuario($data);
    }
?>
    <html>

    <head>
        <title>Clientes</title>
        <!--Ícone-->
        <link rel="icon" href="../../dist/img/icone.png">
        <!--Fonte-->
        <link rel="stylesheet" href="<?php fonte(); ?>">
        <!--Bootstrap-->
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">
        <!--Ik Ícones-->
        <link rel="stylesheet" href="../../plugins/icon-kit/css/iconkit.min.css">
        <!--ScroolBar Menu-->
        <link rel="stylesheet" href="../../plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <!--jQuery Toast-->
        <link rel="stylesheet" href="../../plugins/jquery-toast/css/jquery.toast.min.css">
        <!--Datatable-->
        <link rel="stylesheet" href="../../plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <!--Theme CSS-->
        <link rel="stylesheet" href="../../dist/css/theme.min.css">

        <!--Scripts-->
        <?php sair("../../outros/sair.php"); ?>
        <?php toastUsuarioExcluido(); ?>
        <!--/Scripts-->
    </head>

    <body>
        <div class="wrapper">
            <!--Header-->
            <?php include_once '../../componentes/headerDeModulos.php'; ?>
            <!--/Header-->
            <div class="page-wrap">
                <!--Sidebar-->
                <?php include_once '../../componentes/sidebarDeModulos.php'; ?>
                <!--/Sidebar-->
                <!--Principal-->
                <div class="main-content">
                    <div class="container-fluid">
                        <!--Page-Header-->
                        <?php pageHeader(
                            [6, [["../../home.php", "home", "blue"], ["usuarios.home.php", "users", "blue"]], ["list", "blue"]],
                            [6, [["../../home.php", "Página Inicial"], ["usuarios.home.php", "Usuários"]], "Clientes"]
                        ); ?>
                        <!--/Page-Header-->
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="dt-responsive">
                                    <?php dataTable("clientes", "Clientes", ["Nome", "E-mail", "Compras", "Dinheiro em Compras", "Ações"], $pdo, $sqlClientes) ?>
                                </div>
                            </div>
                        </div>
                        <!--Modais de Dados-->
                        <?php foreach ($pdo->query($sqlClientes) as $row) {
                            modalCliente($row, ['../../dist/img/usuarios/' . $row['id'] . '.png']);
                        } ?>
                        <!--/Modais de Dados-->

                        <?php if (tipoUsuario($_SESSION['id']) == "Administrador Geral") { ?>
                            <!--Modais de Excluir-->
                            <?php foreach ($pdo->query($sqlClientes) as $row) {
                                modalExcluirCliente($row, ['../../dist/img/usuarios/' . $row['id'] . '.png']);
                            } ?>
                            <!--/Modais de Excluir-->
                        <?php } ?>

                    </div>
                </div>
                <!--/Principal-->
                <!--Footer-->
                <?php include_once '../../componentes/footer.php'; ?>
                <!--/Footer-->
            </div>
        </div>
        <!--jQuery-->
        <script src="../../plugins/jquery/js/jquery-3.3.1.min.js"></script>
        <!--Popper (Header)-->
        <script src="../../plugins/popper.js/js/popper.min.js"></script>
        <!--Bootstrap-->
        <script src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <!--ScroolBar Menu-->
        <script src="../../plugins/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
        <!--jQuery Toast-->
        <script src="../../plugins/jquery-toast/js/jquery.toast.min.js"></script>
        <!--Datatable-->
        <script src="../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!--Theme JS-->
        <script src="../../dist/js/theme.min.js"></script>

        <!--Script da Datatable-->
        <?php scriptDataTablePadrao("clientes"); ?>
    </body>

    </html>
<?php } ?>