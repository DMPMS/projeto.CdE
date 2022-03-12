<!doctype html>
<?php
session_start();

require_once("../../database.php");
$pdo = Database::connect();

require_once("../../outros/outrasFuncoes.php");

if (!logado()) {
    redirecionarPara("../../index.php", false);
} else {
    include_once("../../funcoes.php");
    include_once("../../componentes/modals.php");
    include_once("../../componentes/html.php");
    include_once("../../componentes/scripts.php");
    include_once("../../componentes/toasts.php");

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['NovoUsuario']) == 'NovoUsuario') {
        NovoUsuario($data);
    }
?>
    <html>

    <head>
        <title>Novo Usuário</title>
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
                            [6, [["../../home.php", "home", "blue"], ["usuarios.home.php", "users", "blue"]], ["plus-circle", "blue"]],
                            [6, [["../../home.php", "Página Inicial"], ["usuarios.home.php", "Usuários"]], "Novo Usuário"]
                        ); ?>
                        <!--/Page-Header-->
                        <div class="row wizard-card">
                            <div class="col-md-12">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        <h3>Novo Usuário</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <?php formPicture([2], ["../../dist/img/default-usuario.jpg", "preview"], ["foto", "img-input"]) ?>
                                                    <?php formInput(["", 4, ""], ["Nome"], [true, "", ""], ["nome", "", "text", "Nome", "", true, false, false]) ?>
                                                    <?php formInput(["", 3, ""], ["E-mail"], [true, "mostrarAsterisco", "display: none;"], ["email", "email", "email", "email@email.com", "", false, false, false]) ?>
                                                    <?php formInput(["mostrarSenha", 3, "display: none;"], ["Senha"], [true, "", ""], ["senha", "senha", "password", "********", "", false, false, false]) ?>
                                                </div>
                                                <div class="row">
                                                    <?php formInputSelect2(["", 2, ""], ["Tipo"], [true, "", ""], ["tipo", "tipo", true, formInputSelect2Usuarios()]); ?>
                                                    <?php formInput(["", 6, ""], ["Endereço"], [false, "", ""], ["endereco", "", "text", "Endereço", "", false, false, false]) ?>
                                                    <?php formInput(["", 2, ""], ["CPF"], [false, "", ""], ["cpf", "cpf", "text", "000.000.000-00", "", false, false, false]) ?>
                                                    <?php formInput(["", 2, ""], ["Contato"], [false, "", ""], ["contato", "contato", "text", "(00) 00000-0000", "", false, false, false]) ?>
                                                </div>
                                                <a class="btn btn-primary text-white mr-2" href="home_usuarios.php">Início</a>
                                                <button name="NovoUsuario" type="submit" class="btn btn-primary" value="NovoUsuario">Confirmar</button>
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
        <!--Theme JS-->
        <script src="../../dist/js/theme.min.js"></script>
        <!--Select 2-->
        <script src="../../plugins/select2/js/select2.min.js"></script>
        <!--Máscaras-->
        <script src="../../plugins/maskedinput/js/jquery.maskedinput-1.1.4.pack.js"></script>

        <!--Configurações de Campos-->
        <?php usuariosConfiguracaoDeCampos(); ?>
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