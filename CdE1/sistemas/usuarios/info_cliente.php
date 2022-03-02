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
        $sql = "SELECT * FROM cde_usuario ORDER BY id DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        $idCliente = $result['id'];
    } else {
        $idCliente = $_GET['id'];
    }

    $pdo = Database::connect();
    $sql = "SELECT * FROM cde_usuario where id = $idCliente";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $SenhaIncorreta = null;
    if (isset($data['buttoncadastrar']) == 'Cadastrar') {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE cde_usuario SET nome = ?,foto = ?,email = ?,endereco = ?,telefone = ?,cpf = ?,nascimento = ? where id = ?";
        $q = $pdo->prepare($sql);

        //codico destinado à foto
        if ($_FILES['foto']['name'] != '') {
            //apaga a foto antiga
            if (file_exists("fotos/" . $result['foto'])) {
                unlink("fotos/" . $result['foto']);
            }

            //verfica se é jpeg
            $pos = strpos(substr($_FILES['foto']['name'], -4), ".");
            if ($pos === false) {
                $ponto = -5;
            } else {
                $ponto = -4;
            }

            $extensao = strtolower(substr($_FILES['foto']['name'], $ponto));
            $novo_nome = $result['id'] . $extensao;
            $diretorio = "fotos/";
            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $novo_nome);
            $foto = $novo_nome;
        } else {
            $foto = $result['foto'];
        }
        ///////////////////////
//        if ($data['senha'] != $data['senhaC']) {
//            $SenhaIncorreta = 1;
//        } else {
        $q->execute(array($data['nome'], $foto, $data['email'], $data['endereco'], $data['telefone'], $data['cpf'], $data['nascimento'], $idCliente));
        $SenhaIncorreta = 2;
        
        $sqlVenda = "UPDATE cde_venda_detalhe SET nome_cliente = ? WHERE id_cliente = ?";
        $qVenda = $pdo->prepare($sqlVenda);
        $qVenda->execute(array($data['nome'], $idCliente));
        
        //pra não bugar a foto q aparece lá embaixo
        $pdo = Database::connect();
        $sql = "SELECT * FROM cde_usuario where id = $idCliente";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
//        }
    }
    ?>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Informações do Cliente</title>
            <style type="text/css">
                input[type='file'] {
                    display: none
                }
            </style>
                        <script src="../../vendor/jquery/jquery.min.js"></script>

            <script type="text/javascript">
                $(function(){
                $('#imagem').change(function(){
                const file = $(this)[0].files[0]
                const fileReader = new FileReader()
                fileReader.onloadend = function(){
                $('#img').attr('src', fileReader.result)
                }
                fileReader.readAsDataURL(file)
                })
                })
            </script>
             <script type="text/javascript">
                $(document).ready(function(){
                $("#cpf").mask("999.999.999-99");
                });

                $(document).ready(function(){
                $("#telefone").mask("(99) 99999-9999");
                });
            </script>


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
                                                    <img style="max-height: 150px; max-width: 150px;" id="img" src="fotos/<?php echo $result['foto']; ?>" class="img-thumbnail">
                                                </div><br>
                                                <div class="text-center">
                                                    <label for='selecao-arquivo'class="btn btn-primary btn-user"> <i class="fas fa-image"></i> Escolher Foto</label>
                                                    <input id='selecao-arquivo' type='file' name="foto" accept="image/*">
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label>Nome do Cliente:<a style="color: red;">*</a></label>
                                                        <input required="" type="name" name="nome" class="form-control form-control-user" value="<?php echo $result['nome']; ?>" placeholder="Nome">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Tipo:</label>
                                                        <input disabled="" type="name" name="tipo" class="form-control form-control-user" value="<?php echo $result['tipo']; ?>">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>E-mail:</label>
                                                        <input  type="email" name="email" class="form-control form-control-user" value="<?php echo $result['email']; ?>" placeholder="E-mail">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-8">
                                                        <label>Endereço:</label>
                                                        <input type="name" name="endereco" class="form-control form-control-user" value="<?php echo $result['endereco']; ?>" placeholder="Endereço" minlength="8">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Telefone/Celular:</label>
                                                        <input type="text" name="telefone" id="telefone" class="form-control form-control-user" value="<?php echo $result['telefone']; ?>" placeholder="(00) 00000-0000">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label >CPF:</label>
                                                        <input type="text" name="cpf" id="cpf" class="form-control form-control-user" value="<?php echo $result['cpf']; ?>" placeholder="000.000.000-00">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label >Data de Nascimento:</label>
                                                        <input type="date" name="nascimento" class="form-control form-control-user" value="<?php echo $result['nascimento']; ?>">
                                                    </div>
                                                    <?php if ($SenhaIncorreta == 1) { ?>
                                                        <div class="form-group col-lg-4">
                                                            <label style="color: white">a</label>
                                                            <button class="form-control form-control-user btn-danger"><i class="fas fa-exclamation-triangle"></i> Há divergência nas senhas!</button>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($SenhaIncorreta == 2) { ?>
                                                        <div class="form-group col-lg-4">
                                                            <label style="color: white">a</label>
                                                            <button class="form-control form-control-user btn-success"><i class="fas fa-check-circle"></i> Dados editados!</button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <br>
                                                <a href="list_cliente.php" class="btn btn-user btn-primary">
                                                    <i class="fas fa-reply"></i> Voltar
                                                </a>
                                                <button name="buttoncadastrar" value="Cadastrar" class="btn btn-success btn-user" type="submit" style="float: right;">Confirmar Alterações</button>
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
