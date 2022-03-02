<!doctype html>
<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "../../index.php"; </script>';
} else {
    $pdo = Database::connect();

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['cadastrar']) == 'cadastrar') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Cadastrar
        $sql = "INSERT INTO produto_tipos (nome,id_responsavel,criadoem) values(?,?,?)";
        $q = $pdo->prepare($sql);

        $ID = UltimoIdTipo() + 1;

        if ($_SESSION['tipo'] == "Administrador Geral") {
            $q->execute(array($data['nome'], $_SESSION['id'], date('Y-m-d H:i:s')));
        }

        //Atualização
        $sql = "INSERT INTO atualizacao_atualizacoes (tipo, acao, id_tipo, id_responsavel, ids_vizualizados, criadoem) values(?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);

        if ($_SESSION['tipo'] == "Administrador Geral") {
            $q->execute(array("Produto", "Cadastrar-Tipo", $ID, $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));
        }

        $_SESSION['Cadastrado'] = NomeTipo($ID);
        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location = "list_tipo.php");
                }
            </script>';

        Database::disconnect();
    }
    ?>
    <html class="no-js" lang="en">
        <head>
            <title>Novo Tipo</title>
            <!--Ícone-->
            <link rel="icon" href="../../ico.png" type="image/x-icon" />
            <!--Fonte-->
            <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
            <!--Bootstrap-->
            <link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">
            <!--Ik Ícones-->
            <link rel="stylesheet" href="../../plugins/icon-kit/dist/css/iconkit.min.css">
            <!--ScroolBar Menu-->
            <link rel="stylesheet" href="../../plugins/perfect-scrollbar/css/perfect-scrollbar.css">
            <!--Theme CSS-->
            <link rel="stylesheet" href="../../dist/css/theme.min.css">
            <!--Meus Scripts-->
            <?php include_once '../../meus_scripts.php'; ?>
            <!--Verificar Tipo-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        </head>
        <body>
            <div class="wrapper">
                <!--Header-->
                <?php include_once '../header.php'; ?>
                <!--/Header-->
                <div class="page-wrap">
                    <!--Sidebar-->
                    <?php include_once '../sidebar.php'; ?>
                    <!--/Sidebar-->
                    <!--Principal-->
                    <div class="main-content">
                        <div class="container-fluid">
                            <div class="page-header">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="page-header-title">
                                            <a href="../../home.php"><i class="ik ik-home bg-green"></i></a>
                                        </div>
                                        <div class="page-header-title">
                                            <a href="home_produtos.php"><i class="ik ik-package bg-green"></i></a>
                                        </div>
                                        <div class="page-header-title">
                                            <i class="ik ik-plus-circle bg-green"></i>
                                        </div>
                                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a href="../../home.php">Página Inicial</a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="home_produtos.php">Produtos</a>
                                                </li>
                                                <li class="breadcrumb-item active" aria-current="page">Novo Tipo</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card shadow-lg">
                                        <div class="card-header"><h3>Novo Tipo</h3></div>
                                        <div class="card-body">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="form-group col-lg-4">
                                                            <label>Nome <span class="text-danger">*</span></label>
                                                            <input name="nome" id="nome" type="text" class="form-control" placeholder="Nome" required="">
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-primary text-white mr-2" href="home_produtos.php">Início</a>
                                                    <button name="cadastrar" type="submit" class="btn btn-primary" value="cadastrar">Confirmar</button>
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
                    <?php include_once '../../footer.php'; ?>
                    <!--/Footer-->
                </div>
            </div>
            <!--jQuery-->
            <script src="../../src/js/vendor/jquery-3.3.1.min.js"></script>
            <!--Popper (Header)-->
            <script src="../../plugins/popper.js/dist/umd/popper.min.js"></script>
            <!--Bootstrap-->
            <script src="../../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
            <!--ScroolBar Menu-->
            <script src="../../plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
            <!--Theme JS-->
            <script src="../../dist/js/theme.min.js"></script>
            <!--Verificar Tipo-->
            <script>
                var nome = $("#nome");
                nome.blur(function () {
                    $.ajax({
                        url: 'verifica_tipo.php',
                        type: 'POST',
                        data: {"nome": nome.val()},
                        success: function (data) {
                            data = $.parseJSON(data);

                            if (data.nome == "Existe") {
                                document.querySelector("#nome").setCustomValidity("O tipo '" + nome.val() + "' já está cadastrado.");
                            } else {
                                document.querySelector("#nome").setCustomValidity("");
                            }
                        }
                    });
                });
            </script>
            <!--Desabilitar Enter-->
            <script>
                $(document).ready(function () {
                    $('input').keypress(function (e) {
                        var code = null;
                        code = (e.keyCode ? e.keyCode : e.which);
                        return (code == 13) ? false : true;
                    });
                });
            </script>
        </body>
    </html>
<?php } ?>
