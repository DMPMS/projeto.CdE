<!doctype html>
<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "../../index.php"; </script>';
} else {
    if (!isset($_GET['id']) || $_GET['id'] == '') {
        $_SESSION['indisponivel'] = True;
        echo '<script> window.location = "../../home.php"; </script>';
    } else {
        $idProduto = $_GET['id'];
    }

    $pdo = Database::connect();
    $sql = "SELECT * FROM produto_produtos WHERE id = $idProduto";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    $sqlTipos = "SELECT * FROM produto_tipos WHERE ativo = 0 ORDER BY nome";

    if ((is_array($result) ? count($result) : 0) == 0 || $result['ativo'] == 1) {
        $_SESSION['indisponivel'] = True;
        echo '<script> window.location = "../../home.php"; </script>';
    }

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['editar']) == 'editar') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Editar
        if ($_SESSION['tipo'] == "Administrador Geral") {
            $sql = "UPDATE produto_produtos SET nome = ?,foto = ?,codigo = ?,id_tipo = ?,preco = ?,unidades = ? WHERE id = ?";
        } else if ($_SESSION['tipo'] == "Administrador") {
            $sql = "UPDATE produto_produtos SET unidades = ? WHERE id = ?";
        }
        $q = $pdo->prepare($sql);

        $ID = $idProduto;

        if ($_SESSION['tipo'] == "Administrador Geral") {
            //Preço
            $data['preco'] = str_replace(".", "", $data['preco']);
            $data['preco'] = str_replace(",", ".", $data['preco']);

            //Tipos
            $TiposN = null;
            foreach ($_POST['id_tipo'] as $Tipos) {
                $TiposN = $TiposN . $Tipos;
            }

            //Foto        
            if ($_FILES['foto']['name'] != '') {
                $novo_nome = $ID . ".png";
                move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/produtos/" . $novo_nome);
                $foto = $novo_nome;
            } else {
                $foto = $result['foto'];
            }

            $q->execute(array($data['nome'], $foto, $data['codigo'], $TiposN, $data['preco'], $data['unidades'], $idProduto));
        } else if ($_SESSION['tipo'] == "Administrador") {
            $UnidadesAntigo = $result['unidades'];
            $q->execute(array($data['unidades'], $idProduto));
        }

        //Mostrar foto correta
        $sql = "SELECT * FROM produto_produtos WHERE id = $idProduto";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);

        //Atualização
        if ($_SESSION['tipo'] == "Administrador Geral") {
            $sql = "INSERT INTO atualizacao_atualizacoes (tipo, acao, id_produto, id_responsavel, ids_vizualizados, criadoem) values(?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array("Produto", "Editar-Produto", $ID, $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));
        } else if ($_SESSION['tipo'] == "Administrador") {
            $sql = "INSERT INTO atualizacao_atualizacoes (tipo, acao, id_produto, unidades_antigo, unidades_novo, id_responsavel, ids_vizualizados, criadoem) values(?,?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array("Produto", "Editar-Produto-Estoque", $ID, $UnidadesAntigo, $data['unidades'], $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));
        }

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
        <title>Editar Produto</title>
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
        <!--Card Foto Circular-->
        <link rel="stylesheet" href="../../plugins/paper-bootstrap-wizard/paper-bootstrap-wizard.css">
        <!--Select 2-->
        <link rel="stylesheet" href="../../plugins/select2/dist/css/select2.min.css">
        <!--Meus Scripts-->
        <?php include_once '../../meus_scripts.php'; ?>
        <?php if (isset($_SESSION['Editado'])) { ?>
            <!--Notificação Editado-->
            <script>
                window.onload = function() {
                    $.toast({
                        text: 'Dados editados.',
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
                                        <a href="list_produto.php"><i class="ik ik-list bg-green"></i></a>
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
                                                <a href="list_produto.php">Produtos</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Editar Produto</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="row wizard-card">
                            <div class="col-md-12">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        <h3>Editar Produto</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                        <div class="picture-container">
                                                            <div class="picture">
                                                                <img src="../../img/produtos/<?php echo $result['foto']; ?>" id="preview" class="picture-src rounded-circle" />
                                                                <input name="foto" id="img-input" type="file" accept="image/*" <?php if ($_SESSION['tipo'] == "Administrador") { ?> disabled="" <?php } ?>>
                                                            </div>
                                                            <h6>Escolher Imagem</h6>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <label>Nome <span class="text-danger">*</span></label>
                                                        <input name="nome" type="text" class="form-control" placeholder="Nome" required="" <?php if ($_SESSION['tipo'] == "Administrador") { ?> disabled="" <?php } ?> value="<?php echo $result['nome']; ?>">
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label>Código</label>
                                                        <input name="codigo" id="codigo" type="text" class="form-control" placeholder="Código" <?php if ($_SESSION['tipo'] == "Administrador") { ?> disabled="" <?php } ?> value="<?php echo $result['codigo']; ?>">
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>Unidades <span class="text-danger">*</span></label>
                                                        <input name="unidades" type="number" class="form-control" placeholder="0" required="" min="0" onkeypress="return event.charCode >= 48" value="<?php echo $result['unidades']; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-7">
                                                        <label>Tipo(s) <span class="text-danger">*</span></label>
                                                        <select name="id_tipo[]" id="id_tipo" class="form-control" required="" <?php if ($_SESSION['tipo'] == "Administrador") { ?> disabled="" <?php } ?> multiple="multiple">
                                                            <?php foreach ($pdo->query($sqlTipos) as $row) { ?>
                                                                <option value="(<?= $row['id']; ?>)" <?php if (str_contains($result['id_tipo'], "({$row['id']})")) { ?> selected="" <?php } ?>><?= $row['nome']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>Preço <span class="text-danger">*</span></label>
                                                        <input name="preco" type="text" class="preco form-control" placeholder="0.000,00" required="" <?php if ($_SESSION['tipo'] == "Administrador") { ?> disabled="" <?php } ?> value="<?php echo number_format($result['preco'], 2, ',', '.'); ?>">
                                                    </div>
                                                </div>
                                                <?php if (isset($_SESSION['Tipo-Produto'])) { ?>
                                                    <a class="btn btn-primary text-white mr-2" href="list_tipo_produto.php?id=<?php echo $_SESSION['Tipo-Produto']; ?>">Produtos de "<?php echo NomeTipo($_SESSION['Tipo-Produto']); ?>"</a>
                                                <?php } ?>
                                                <a class="btn btn-primary text-white mr-2" href="list_produto.php">Produtos</a>
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
        <!--Script Da Máscara do Preço-->
        <script src="../../js/mascaradinheiro.js"></script>
        <!--Select 2-->
        <script src="../../plugins/select2/dist/js/select2.min.js"></script>
        <!--Preview da Foto-->
        <script>
            function readImage() {
                if (this.files && this.files[0]) {
                    var file = new FileReader();
                    file.onload = function(e) {
                        document.getElementById("preview").src = e.target.result;
                    };
                    file.readAsDataURL(this.files[0]);
                }
            }
            document.getElementById("img-input").addEventListener("change", readImage, false);
        </script>
        <!--Verificar Código-->
        <script>
            var codigo = $("#codigo");
            codigo.blur(function() {
                $.ajax({
                    url: 'verifica_codigo.php',
                    type: 'POST',
                    data: {
                        "codigo": codigo.val()
                    },
                    success: function(data) {
                        data = $.parseJSON(data);

                        if (data.codigo == "Existe") {
                            document.querySelector("#codigo").setCustomValidity("O código '" + codigo.val() + "' já está cadastrado.");
                        } else {
                            document.querySelector("#codigo").setCustomValidity("");
                        }
                    }
                });
            });
        </script>
        <!-- Máscara do Preço -->
        <script>
            $('.preco').mask('#.##0,00', {
                reverse: true
            });
        </script>
        <!-- Desabilitar Enter -->
        <script>
            $(document).ready(function() {
                $('input').keypress(function(e) {
                    var code = null;
                    code = (e.keyCode ? e.keyCode : e.which);
                    return (code == 13) ? false : true;
                });
            });
        </script>
        <!--Pro Select-->
        <script>
            $(document).ready(function() {
                $('#id_tipo').select2();
            });
        </script>
    </body>

    </html>
<?php } ?>