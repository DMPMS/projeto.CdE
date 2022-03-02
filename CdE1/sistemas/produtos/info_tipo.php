<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "../../necessariologar.php";
        </script>';
} else {
    if (!isset($_GET['id'])) {
        $pdo = Database::connect();
        $sql = "SELECT * FROM cde_produto_tipo ORDER BY id DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        $idTipo = $result['id'];
    } else {
        $idTipo = $_GET['id'];
    }

    $pdo = Database::connect();
    $sql = "SELECT * FROM cde_produto_tipo where id = $idTipo";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $editsucesso = null;
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['buttoncadastrar']) == 'Cadastrar') {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE cde_produto_tipo SET nome = ? where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($data['nome'], $idTipo));

        $editsucesso = 1;
        $pdo = Database::connect();
        $sql = "SELECT * FROM cde_produto_tipo where id = $idTipo";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
    ?>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
<link rel="icon" type="image/png" href="../../img/ico.png">
            <title>Informações do Tipo</title>

            <script src="../../vendor/jquery/jquery.min.js"></script>

            <link href="../../js/toastr/toastr.min.css">
            <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

            <!-- Custom styles for this template-->
            <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

        </head>

        <body class="bg-gradient-primary">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12 col-md-9">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-5">
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Nome do Tipo:<a style="color: red;">*</a></label>
                                                        <input minlength="3" required="" type="name" name="nome" class="form-control form-control-user" value="<?php echo $result['nome']; ?>" placeholder="Nome" <?php if ($_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
                                                    </div>
                                                    <?php if ($editsucesso == 1) { ?>
                                                        <div class="form-group col-lg-4">
                                                            <label style="color: white">a</label>
                                                        </div>
                                                        <div class="form-group col-lg-4">
                                                            <label style="color: white">a</label>
                                                            <button style="float: right;" class="form-control form-control-user btn-success"><i class="fas fa-check-circle"></i> Dados editados!</button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <br>
                                                <a href="list_tipo.php" class="btn btn-user btn-primary">
                                                    <i class="fas fa-reply"></i> Voltar
                                                </a>
                                                <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                                    <button name="buttoncadastrar" value="Cadastrar" class="btn btn-success btn-user" type="submit" style="float: right;">Confirmar Alterações</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="../../vendor/jquery/jquery.min.js"></script>
            <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../../js/sb-admin-2.min.js"></script>

        </body>

    </html>
<?php } ?>
