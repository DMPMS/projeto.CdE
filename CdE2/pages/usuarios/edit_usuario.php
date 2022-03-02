<!DOCTYPE html>
<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (isset($_SESSION['id']) == '') {
    echo '<script> window.location = "index.php"; </script>';
} else {
    $pdo = Database::connect();

    $idUsuario = $_GET['id'];

    $sql = "SELECT * FROM usuario_usuarios WHERE id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['editar']) == 'editar') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($result['tipo'] == "Cliente") {
            $sql = "UPDATE usuario_usuarios SET nome = ?,foto = ?,email = ?,endereco = ?, celular = ?,cpf = ? WHERE id = ?";
        } else if ($result['tipo'] == "Administrador") {
            $sql = "UPDATE usuario_usuarios SET nome = ?,foto = ?,email = ?,endereco = ?, celular = ?,cpf = ?,senha = ? WHERE id = ?";
        }

        $q = $pdo->prepare($sql);

        $ID = $idUsuario;

        //Foto
        if ($_FILES['foto']['name'] != '') {
            //Apagando foto antiga
            if (file_exists("../../assets/img/usuarios/" . $result['foto'])) {
                unlink("../../assets/img/usuarios/" . $result['foto']);
            }

            //Verificando se é JPEG
            $pos = strpos(substr($_FILES['foto']['name'], -4), ".");
            if ($pos === false) {
                $ponto = -5;
            } else {
                $ponto = -4;
            }

            $extensao = strtolower(substr($_FILES['foto']['name'], $ponto));
            $novo_nome = $ID . $extensao;
            move_uploaded_file($_FILES['foto']['tmp_name'], "../../assets/img/usuarios/" . $novo_nome);
            $foto = $novo_nome;
        } else {
            $foto = $result['foto'];
        }

        if ($result['tipo'] == "Cliente") {
            $q->execute(array($data['nome'], $foto, $data['email'], $data['endereco'], $data['celular'], $data['cpf'], $idUsuario));
        } else if ($result['tipo'] == "Administrador") {
            $q->execute(array($data['nome'], $foto, $data['email'], $data['endereco'], $data['celular'], $data['cpf'], $data['senha'], $idUsuario));
        }

        //Mostrar foto correta
        $sql = "SELECT * FROM usuario_usuarios WHERE id = $idUsuario";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();

        $editado = true;
    }
    ?>
    <html lang="en">
        <head>
            <!--Metas-->
            <meta charset="utf-8">
            <meta name="description" content="" >
            <meta name="author" content="">
            <meta name="keywords" content="">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--Meta Responsiva-->
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!--Ícone-->
            <link rel="icon" href="../../ico.png" type="image/x-icon">
            <!--Bootstrap CSS-->
            <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
            <!--Custom style.css-->
            <link rel="stylesheet" href="../../assets/css/quicksand.css">
            <link rel="stylesheet" href="../../assets/css/style.css">
            <!--Font Awesome-->
            <link rel="stylesheet" href="../../assets/css/fontawesome.css">
            <!--Pra foto-->
            <link rel="stylesheet" href="../../assets/css/paper-bootstrap-wizard.css">
            <!--Pra Notificação-->
            <link rel="stylesheet" href="../../assets/css/alertify.min.css">
            <title>Editar Usuário</title>
            <!--Meus Scripts Personalizados-->
            <script src="../../assets/js/jquery.min.js"></script>
            <?php include_once '../../meus_scripts.php'; ?>
            <script>
                function Sair() {
                    window.location = "../../sair.php";
                }
            </script>
            <!--Notificação Editado-->
            <?php if (isset($editado)) { ?>
                <script>
                    window.onload = function () {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success('Dados editados.').dismissOthers();
                    }
                </script>
            <?php } ?>
        </head>
        <body>
            <div class="container-fluid">
                <!--Navbar-->
                <?php include_once "../navbar.php"; ?>
                <!--/Navbar-->
                <!--Principal-->
                <div class="row">
                    <!--Sidebar-->
                    <?php include_once "../sidebar.php"; ?>
                    <!--/Sidebar-->
                    <!--Direita-->
                    <div class="col-sm-10 pt-3 pl-0">
                        <h5 class="mb-3" >
                            <a href="../../home.php"><strong>Página Inicial</strong></a> / 
                            <a href="home_usuarios.php"><strong>Usuários</strong></a> /
                            <?php if ($result['tipo'] == "Cliente") { ?>
                                <a href="list_cliente.php"><strong>Clientes</strong></a> /
                            <?php } else if ($result['tipo'] == "Administrador") { ?>
                                <a href="list_administrador.php"><strong>Administrador</strong></a> /
                            <?php } ?>
                            <strong>Editar Usuário</strong>
                        </h5>
                        <!--Página-->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-lg wizard-card">
                                    <form class="mt-2" method="POST" enctype="multipart/form-data">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-3" data-color="theme" id="wizardProfile">
                                                    <div class="picture-container">
                                                        <div class="picture">
                                                            <img src="../../assets/img/usuarios/<?php echo $result['foto']; ?>" class="picture-src" id="preview" title="" />
                                                            <input name="foto" id="img-input" type="file"  accept="image/*">
                                                        </div>
                                                        <h6>Escolher Imagem</h6>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Nome <span class="text-danger">*</span></label>
                                                    <input name="nome" type="text" class="form-control" placeholder="Nome" required="" value="<?php echo $result['nome']; ?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>E-mail <span class="text-danger">*</span></label>
                                                    <input name="email" id="email" type="email" class="form-control" placeholder="E-mail" value="<?php echo $result['email']; ?>">
                                                </div>
                                                <?php if ($result['tipo'] == "Administrador") { ?>
                                                    <div class="form-group col-lg-2">
                                                        <label>Senha <span class="text-danger">*</span></label>
                                                        <input name="senha" type="password" class="form-control" placeholder="********" value="<?php echo $result['senha']; ?>">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-3">
                                                    <label>Tipo <span class="text-danger">*</span></label>
                                                    <select name="tipo" id="tipo" class="form-control" required="" disabled="">
                                                        <?php if ($result['tipo'] == "Cliente") { ?>
                                                            <option value="Cliente">Cliente</option>
                                                        <?php } else if ($result['tipo'] == "Administrador") { ?>
                                                            <option value="Administrador">Administrador</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>CPF</label>
                                                    <input name="cpf" id="cpf" type="text" class="form-control" placeholder="000.000.000-00" value="<?php echo $result['cpf']; ?>">
                                                </div>
                                                <div class="form-group col-lg-5">
                                                    <label>Endereço</label>
                                                    <input name="endereco" type="text" class="form-control" placeholder="Endereço" value="<?php echo $result['endereco']; ?>">
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>Celular</label>
                                                    <input name="celular" id="celular" type="text" class="form-control" placeholder="(00) 00000-0000" value="<?php echo $result['celular']; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <?php if ($result['tipo'] == "Cliente") { ?>
                                                        <a class="btn btn-primary" href="list_cliente.php"><i class="fa fa-reply"></i> Voltar</a>
                                                    <?php } else if ($result['tipo'] == "Administrador") { ?>
                                                        <a class="btn btn-primary" href="list_administrador.php"><i class="fa fa-reply"></i> Voltar</a>
                                                    <?php } ?>
                                                    <button name="editar" type="submit" class="btn btn-theme" value="editar">Confirmar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>      
                                </div>
                            </div>
                        </div>
                        <!--/Página-->
                        <!--Rodapé-->
                        <?php include_once '../../footer.php'; ?>
                        <!--/Rodapé-->
                    </div>
                    <!--/Direita-->
                </div>
                <!--/Principal-->
            </div>
            <!--Pra Notificação-->
            <script src="../../assets/js/alertify.min.js"></script>
            <!--jQuery-->
            <script src="../../assets/js/jquery.min.js"></script>
            <script src="../../assets/js/jquery-1.12.4.min.js"></script>
            <!--Popper-->
            <script src="../../assets/js/popper.min.js"></script>
            <!--Bootstrap-->
            <script src="../../assets/js/bootstrap.min.js"></script>
            <!--Máscara Inputs-->
            <script type="text/javascript" src="../../assets/js/jquery.maskedinput-1.1.4.pack.js"></script>
            <!--Preview da Foto-->
            <script>
                    function readImage() {
                        if (this.files && this.files[0]) {
                            var file = new FileReader();
                            file.onload = function (e) {
                                document.getElementById("preview").src = e.target.result;
                            };
                            file.readAsDataURL(this.files[0]);
                        }
                    }
                    document.getElementById("img-input").addEventListener("change", readImage, false);
            </script>
        </body>
    </html>
<?php } ?>