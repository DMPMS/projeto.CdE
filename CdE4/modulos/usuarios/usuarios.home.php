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
    include_once("../../componentes/cards.php");
    include_once("../../componentes/html.php");
    include_once("../../componentes/scripts.php");
    include_once("../../componentes/toasts.php");

    $sqlNovosUsuarios = "SELECT * FROM usuarios_usuarios WHERE ativo = 0 ORDER BY id DESC limit 5";
    $sqlAtualizacoesUsuarios = "SELECT * FROM usuarios_atualizacoes WHERE ativo = 0 ORDER BY id DESC";

    // $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // if (isset($data['MarcarComoLidas']) == 'MarcarComoLidas') {
    //     marcarAtualizacoesComoLidas("usuarios_atualizacoes");
    // }
?>
    <html>

    <head>
        <title>Página Inicial - Usuários</title>
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
        <!--Theme CSS-->
        <link rel="stylesheet" href="../../dist/css/theme.min.css">

        <!--Scripts-->
        <?php sair("../../outros/sair.php"); ?>
        <?php toastMarcadasComoLidas("Usuários"); ?>
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
                        <?php pageHeader([6, [["../../home.php", "home", "blue"]], ["users", "blue"]], [6, [["../../home.php", "Página Inicial"]], "Usuários"]); ?>
                        <!--/Page-Header-->
                        <div class="row clearfix">
                            <?php botaoNavegacao1("Voltar", "Voltar", "primary", "home", "../../home.php"); ?>
                            <?php botaoNavegacao1("Usuário", "Novo", "primary", "plus-circle", "usuarios.novoUsuario.php"); ?>
                            <?php botaoNavegacao1("Administradores", qtdUsuarios("'Administrador'"), "primary", "user-check", "usuarios.administradores.php"); ?>
                            <?php botaoNavegacao1("Clientes", qtdUsuarios("'Cliente'"), "primary", "list", "usuarios.clientes.php"); ?>
                        </div>
                        <div class="row clearfix">
                            <!--Novos Clientes-->
                            <?php cardNovosClientes($pdo, $sqlNovosUsuarios); ?>
                            <!--/Novos Clientes-->
                            <!--Últimas Atualizações-->
                            <?php cardAtualizacoesUsuarios($pdo, $sqlAtualizacoesUsuarios); ?>
                            <!--/Últimas Atualizações-->
                        </div>
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
        <!--Theme JS-->
        <script src="../../dist/js/theme.min.js"></script>
    </body>

    </html>
<?php } ?>