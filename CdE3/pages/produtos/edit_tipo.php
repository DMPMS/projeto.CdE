<!doctype html>
<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "../../index.php"; </script>';
} else if ($_SESSION['tipo'] != "Administrador Geral") {
    $_SESSION['indisponivel'] = True;
    echo '<script> window.location = "../../home.php"; </script>';
} else {
    if (!isset($_GET['id']) || $_GET['id'] == '') {
        $_SESSION['indisponivel'] = True;
        echo '<script> window.location = "../../home.php"; </script>';
    } else {
        $idTipo = $_GET['id'];
    }

    $pdo = Database::connect();
    $sql = "SELECT * FROM produto_tipos WHERE id = $idTipo";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ((is_array($result) ? count($result) : 0) == 0 || $result['ativo'] == 1) {
        $_SESSION['indisponivel'] = True;
        echo '<script> window.location = "../../home.php"; </script>';
    }

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['editar']) == 'editar') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Editar
        $sql = "UPDATE produto_tipos SET nome = ? WHERE id = ?";
        $q = $pdo->prepare($sql);

        $q->execute(array($data['nome'], $idTipo));

        //Mostrar foto correta
        $sql = "SELECT * FROM produto_tipos WHERE id = $idTipo";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);

        //Atualização
        $sql = "INSERT INTO atualizacao_atualizacoes (tipo, acao, id_tipo, id_responsavel, ids_vizualizados, criadoem) values(?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array("Produto", "Editar-Tipo", $idTipo, $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));

        Database::disconnect();

        $_SESSION['Editado'] = True;
        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>';
    }
    ?>
    <html class="no-js" lang="en">
        <head>
            <title>Editar Tipo</title>
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
            <!--Pra Notificação-->
            <link rel="stylesheet" href="../../plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
            <!--Theme CSS-->
            <link rel="stylesheet" href="../../dist/css/theme.min.css">
            <!--Meus Scripts-->
            <?php include_once '../../meus_scripts.php'; ?>
            <!--Verificar Tipo-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <?php if (isset($_SESSION['Editado'])) { ?>
                <!--Notificação Editado-->
                <script>
                    window.onload = function () {
                        $.toast({
                            text: 'Dados editados.',
                            hideAfter: 5000,
                            icon: 'success',
                            loader: false,
                            position: 'top-right'
                        })
                    }
                </script>
                <?php
                unset($_SESSION['Editado']);
            }
            ?>
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
                                            <a href="list_tipo.php"><i class="ik ik-server bg-green"></i></a>
                                        </div>
                                        <div class="page-header-title">
                                            <i class="ik ik-edit-2 bg-green"></i>
                                        </div>
                                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a href="../../home.php">Página Inicial</a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="home_produtos.php">Produtos</a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="list_tipo.php">Tipos</a>
                                                </li>
                                                <li class="breadcrumb-item active" aria-current="page">Editar Tipo</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="row wizard-card">
                                <div class="col-md-12">
                                    <div class="card shadow-lg">
                                        <div class="card-header"><h3>Editar Tipo</h3></div>
                                        <div class="card-body">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="form-group col-lg-4">
                                                            <label>Nome <span class="text-danger">*</span></label>
                                                            <input name="nome" id="nome" type="text" class="form-control" placeholder="Nome" required="" value="<?php echo $result['nome']; ?>">
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-primary text-white mr-2" href="list_tipo.php">Tipos</a>
                                                    <button name="editar" type="submit" class="btn btn-primary" value="editar">Confirmar</button>
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
            <!--Pra Notificação-->
            <script src="../../plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
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
