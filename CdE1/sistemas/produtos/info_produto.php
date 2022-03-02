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
        $sql = "SELECT * FROM cde_produto ORDER BY id DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        $idProduto = $result['id'];
    } else {
        $idProduto = $_GET['id'];
    }

    $pdo = Database::connect();
    $sql = "SELECT * FROM cde_produto where id = $idProduto";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    //Saber se tem tipo cadastrado
    $sqlTipo = "SELECT COUNT(*) as total FROM cde_produto_tipo";
    $recordsTipo = $pdo->prepare($sqlTipo);
    $recordsTipo->execute();
    $resultTipo = $recordsTipo->fetch(PDO::FETCH_ASSOC);
    //////////

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $editsucesso = null;
    if (isset($data['buttoncadastrar']) == 'Cadastrar') {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE cde_produto SET nome = ?,foto = ?,id_tipo = ?,preco = ?,qtdrestante = ? where id = ?";
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

        //Parte do tipo iniciado lá em cima
        if ($resultTipo['total'] == 0) {
            $id_tipo = 0;
        } else {
            $id_tipo = $data['id_tipo'];
        }
        //////////
        //Ajeitando Preço
        $data['preco'] = str_replace(".", "", $data['preco']);
        $data['preco'] = str_replace(",", ".", $data['preco']);

        $q->execute(array($data['nome'], $foto, $id_tipo, $data['preco'], $data['qtdrestante'], $idProduto));
        $editsucesso = 1;

        $sqlVenda = "UPDATE cde_venda SET nome_produto = ? WHERE id_produto = ?";
        $qVenda = $pdo->prepare($sqlVenda);
        $qVenda->execute(array($data['nome'], $idProduto));

        //pra não bugar a foto q aparece lá embaixo
        $pdo = Database::connect();
        $sql = "SELECT * FROM cde_produto where id = $idProduto";
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
            <title>Meu Perfil</title>
            <style type="text/css">
                input[type='file'] {
                    display: none
                }
            </style>
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


            <script src="../../vendor/jquery/jquery.min.js"></script>
            <link href="../../js/toastr/toastr.min.css">
            <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
            <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
            <script src="http://blog.conradosaud.com.br/js/jquery-3.2.0.min.js"></script>
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
                                                    <input id='selecao-arquivo' type='file' name="foto" accept="image/*" <?php if ($_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Nome do Produto:<a style="color: red;">*</a></label>
                                                        <input required="" type="name" name="nome" class="form-control form-control-user" value="<?php echo $result['nome']; ?>" placeholder="Nome" minlength="3" <?php if ($_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
                                                    </div>
                                                    <?php if ($resultTipo['total'] == 0) { ?>
                                                        <div class="form-group col-lg-4">
                                                            <label title="Campo Obrigatório">Tipo<a style="color: red;">*</a>:</label>
                                                            <input disabled="" type="name" name="id_tipo" class="form-control form-control-user" value="Nenhum" placeholder="Nome" minlength="3" <?php if ($_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="form-group col-lg-4">
                                                            <label title="Campo Obrigatório">Tipo<a style="color: red;">*</a>:</label>
                                                            <select name="id_tipo" class="form-control" required="" <?php if ($_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
                                                                <?php
                                                                while ($tipos = mysqli_fetch_array($ConsTipoPoduto)):
                                                                    ?>
                                                                    <option value="<?php echo $tipos['id']; ?>"<?php
                                                                    if ($result['id_tipo'] == $tipos['id']) {
                                                                        echo 'selected=""';
                                                                    }
                                                                    ?>
                                                                            ><?php echo $tipos['nome'] ?></option>
                                                                        <?php endwhile; ?>                             
                                                            </select>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Preço<a style="color: red;">*</a>:</label>
                                                        <input required="" type="text" name="preco" class="dinheiro form-control form-control-user" value="<?php echo $result['preco']; ?>" placeholder="0.00" <?php if ($_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Quantidade<a style="color: red;">*</a>:</label>
                                                        <input required="" type="number" name="qtdrestante" class="form-control form-control-user" value="<?php echo $result['qtdrestante']; ?>" placeholder="0" <?php if ($_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
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
                                                <a href="list_produto.php" class="btn btn-user btn-primary">
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
            <script src="../../vendor/jquery/jquery.min.js"></script>
            <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="../../js/sb-admin-2.min.js"></script>
            <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

            <script>
                $('.dinheiro').mask('#.##0,00', {reverse: true});
            </script>
        </body>
    </html>
<?php } ?>
