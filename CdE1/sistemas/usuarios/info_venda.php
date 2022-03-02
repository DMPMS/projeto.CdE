<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "../../necessariologar.php";
        </script>';
} else {
    if (!isset($_GET['num_venda'])) {
        $pdo = Database::connect();
        $sql = "SELECT * FROM cde_venda_detalhe ORDER BY num_venda DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        $num_venda = $result['num_venda'];
    } else {
        $num_venda = $_GET['num_venda'];
    }

    $pdo = Database::connect();

    $sql = "SELECT * FROM cde_venda WHERE num_venda = $num_venda";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $sqlVenda = "SELECT * FROM cde_venda_detalhe WHERE num_venda = $num_venda";
    $recordsVenda = $pdo->prepare($sqlVenda);
    $recordsVenda->execute();
    $resultVenda = $recordsVenda->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    ?>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" type="image/png" href="../../img/ico.png">
            <title>Informações da Venda <?php echo $result['num_venda']; ?></title>
            <style type="text/css">
                .scroll{
                    width: 850px;
                    height: 195px;
                    overflow-y: scroll;
                }
            </style>
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
                                                <div class="text-center">
                                                    <h1>Venda <?php echo $result['num_venda']; ?></h1>
                                                </div><br>
                                                <div class="row">
                                                    <div class="form-group col-lg-5">
                                                        <label>Nome do Cliente:</label>
                                                        <input class="form-control form-control-user" value="<?php echo $resultVenda['nome_cliente']; ?>" disabled=""><br>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <label>Responsável pela Venda:</label>
                                                        <input class="form-control form-control-user" value="<?php echo $resultVenda['nome_responsavel']; ?>" disabled=""><br>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>Total:</label>
                                                        <input class="form-control form-control-user" value="R$ <?php echo number_format($resultVenda['valor'], 2, ',', '.'); ?>" disabled=""><br>
                                                    </div>
                                                </div>
                                                <div class="row scroll">
                                                    <div class="form-group col-lg-2">
                                                        <label>Nº do Produto:</label>
                                                        <?php foreach ($pdo->query($sql) as $row) { ?>
                                                            <input class="form-control form-control-user" value="<?php echo $row['id_produto']; ?>" disabled=""><br>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label>Nome do Produto:</label>
                                                        <?php
                                                        foreach ($pdo->query($sql) as $row) {
                                                            $idProduto = $row['id_produto'];

                                                            $sqlProdutoExiste = "SELECT * FROM cde_produto WHERE id = $idProduto";
                                                            $recordsProdutoExiste = $pdo->prepare($sqlProdutoExiste);
                                                            $recordsProdutoExiste->execute();
                                                            $resultProdutoExiste = $recordsProdutoExiste->fetch(PDO::FETCH_ASSOC);

                                                            $contar = is_array($resultProdutoExiste) ? count($resultProdutoExiste) : 0;
                                                            ?>

                                                            <input <?php if ($contar == 0) { ?> title="Produto Removido" style="color: red;" <?php } ?> class="form-control form-control-user" value="<?php echo $row['nome_produto']; ?>" disabled=""><br>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>Preço:</label>
                                                        <?php foreach ($pdo->query($sql) as $row) { ?>
                                                            <input class="form-control form-control-user" value="R$ <?php echo number_format($row['preco_produto'], 2, ',', '.'); ?>" disabled=""><br>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>Quantidade:</label>
                                                        <?php foreach ($pdo->query($sql) as $row) { ?>
                                                            <input class="form-control form-control-user" value="<?php echo $row['qtd_produto']; ?>" disabled=""><br>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <a href="list_cliente_compras.php?idCliente=<?php echo $resultVenda['id_cliente']; ?>" class="btn btn-user btn-primary">
                                                    <i class="fas fa-reply"></i> Voltar
                                                </a>
                                                <button name="buttoncadastrar" value="Cadastrar" class="btn btn-danger btn-user" type="submit" style="float: right;">Excluir</button>
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
            <script type="text/javascript" src="../../js/jquery.maskedinput-1.1.4.pack.js"></script>


        </body>

    </html>
<?php } ?>
