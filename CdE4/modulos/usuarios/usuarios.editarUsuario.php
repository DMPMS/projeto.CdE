<!doctype html>
<?php
session_start();

require_once("../../database.php");
$pdo = Database::connect();

require_once("../../outros/outrasFuncoes.php");

if (!logado()) {
    redirecionarPara("../../index.php", false);
} else if (tipoUsuario($_SESSION['id']) != "Administrador Geral") {
    $_SESSION['Indisponivel'] = True;
    redirecionarPara("../../home.php", false);
} else if (getIdInvalido($_GET['id'])) {
    redirecionarPara("../../home.php", false);
} else {
    include_once("../../funcoes.php");
    include_once("../../componentes/modals.php");
    include_once("../../componentes/html.php");
    include_once("../../componentes/scripts.php");
    include_once("../../componentes/toasts.php");

    $idUsuario = $_GET['id'];

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['EditarUsuario']) == 'EditarUsuario') {
        editarUsuario($data, selecionarUsuario($idUsuario));
    }
?>
    <html>

    <head>
        <title>Editar Usuário</title>
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
        <!--Card Foto Circular-->
        <link rel="stylesheet" href="../../plugins/paper-bootstrap-wizard/paper-bootstrap-wizard.css">
        <!--Select 2-->
        <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">

        <!--Scripts-->
        <!--Máscaras-->
        <script src="../../plugins/maskedinput/js/jquery.min.js"></script>
        <?php sair("../../outros/sair.php"); ?>
        <?php mascaraCPF("cpf"); ?>
        <?php mascaraContato("contato"); ?>
        <?php toastEditado(); ?>
        <?php toastNaoEditado(); ?>
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
                            [6, [["../../home.php", "home", "blue"], ["usuarios.home.php", "users", "blue"], ["usuarios.clientes.php", "list", "blue"]], ["edit-2", "blue"]],
                            [6, [["../../home.php", "Página Inicial"], ["usuarios.home.php", "Usuários"], ["usuarios.clientes.php", "Clientes"]], "Editar Usuário"]
                        ); ?>
                        <!--/Page-Header-->
                        <div class="row wizard-card">
                            <div class="col-md-12">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        <h3>Editar Usuário</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <?php formPicture([2], ["../../dist/img/usuarios/" . selecionarUsuario($idUsuario)['id'] . ".png", "preview"], ["foto", "img-input"]); ?>
                                                    <?php formInput(["", 4, ""], ["Nome"], [true, "", ""], ["nome", "", "text", "Nome", selecionarUsuario($idUsuario)['nome'], true, false, false]); ?>
                                                    <?php if (tipoUsuario($idUsuario) == "Administrador") {
                                                        formInput(["", 3, ""], ["E-mail"], [true, "", ""], ["email", "email", "email", "email@email.com", selecionarUsuario($idUsuario)['email'], true, false, false]);
                                                        formInput(["", 3, ""], ["Senha"], [true, "", ""], ["senha", "", "password", "********", selecionarUsuario($idUsuario)['senha'], true, false, false]);
                                                    } else {
                                                        formInput(["", 3, ""], ["E-mail"], [false, "", ""], ["email", "email", "email", "email@email.com", selecionarUsuario($idUsuario)['email'], false, false, false]);
                                                    } ?>
                                                </div>
                                                <div class="row">
                                                    <?php formInput(["", 2, ""], ["Tipo"], [false, "", ""], ["", "", "text", "", selecionarUsuario($idUsuario)['tipo'], false, true, true]); ?>
                                                    <?php formInput(["", 6, ""], ["Endereço"], [false, "", ""], ["endereco", "", "text", "Endereço", selecionarUsuario($idUsuario)['endereco'], false, false, false]); ?>
                                                    <?php formInput(["", 2, ""], ["CPF"], [false, "", ""], ["cpf", "cpf", "text", "000.000.000-00", selecionarUsuario($idUsuario)['cpf'], false, false, false]); ?>
                                                    <?php formInput(["", 2, ""], ["Contato"], [false, "", ""], ["contato", "contato", "text", "(00) 00000-0000", selecionarUsuario($idUsuario)['contato'], false, false, false]); ?>
                                                </div>
                                                <?php if (tipoUsuario(selecionarUsuario($idUsuario)['id']) == "Administrador") { ?>
                                                    <a class="btn btn-primary text-white mr-2" href="usuarios.administradores.php">Administradores</a>
                                                <?php } else { ?>
                                                    <a class="btn btn-primary text-white mr-2" href="usuarios.clientes.php">Clientes</a>
                                                <?php } ?>
                                                <button name="EditarUsuario" type="submit" class="btn btn-primary" value="EditarUsuario">Confirmar Alterações</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
        <!--Select 2-->
        <script src="../../plugins/select2/js/select2.min.js"></script>
        <!--Máscaras-->
        <script src="../../plugins/maskedinput/js/jquery.maskedinput-1.1.4.pack.js"></script>

        <!--Preview da Foto-->
        <?php previewDaFoto("preview"); ?>
        <!--Verificar E-mail-->
        <?php usuariosVerificarEmail("email", "../../outros/usuarios.verificarEmail.php") ?>
        <!--Desabilitar Enter no Formulário-->
        <?php desabilitarEnterNoFormulario(); ?>
        <!--Pro Select 2-->
        <?php select2("tipo"); ?>
    </body>

    </html>
<?php } ?>