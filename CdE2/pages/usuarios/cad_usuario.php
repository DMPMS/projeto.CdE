<!DOCTYPE html>
<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (isset($_SESSION['id']) == '') {
    echo '<script> window.location = "index.php"; </script>';
} else {
    $pdo = Database::connect();
    
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['cadastrar']) == 'cadastrar') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO usuario_usuarios (nome,foto,email,senha,tipo,endereco,celular,cpf,id_responsavel,criadoem) values(?,?,?,?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);

        $ID = UltimoIdUsuario() + 1;

        //Foto
        if ($_FILES['foto']['name'] != '') {
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
            $novo_nome = $ID . ".png";
            copy("../../assets/img/usuarios/default-usuario.jpg", "../../assets/img/usuarios/" . $novo_nome);
            $foto = $novo_nome;
        }

        if ($data['tipo'] == "Cliente") {
            $q->execute(array($data['nome'], $foto, $data['email'], '', $data['tipo'], $data['endereco'], $data['celular'], $data['cpf'], $_SESSION['id'], date('Y-m-d H:i:s')));
        } else if ($data['tipo'] == "Administrador") {
            $q->execute(array($data['nome'], $foto, $data['email'], $data['senha'], $data['tipo'], $data['endereco'], $data['celular'], $data['cpf'], $_SESSION['id'], date('Y-m-d H:i:s')));
        }

        Database::disconnect();
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
            <title>Novo Usuário</title>
            <!--Meus Scripts Personalizados-->
            <script src="../../assets/js/jquery.min.js"></script>
            <?php include_once '../../meus_scripts.php'; ?>
            <script>
                function Sair() {
                    window.location = "../../sair.php";
                }
            </script>
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
                            <strong>Novo Usuário</strong>
                        </h5>
                        <!--Página-->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-lg wizard-card">
                                    <form class="mt-2" method="POST" enctype="multipart/form-data">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="picture-container">
                                                        <div class="picture">
                                                            <img src="../../assets/img/usuarios/default-usuario.jpg" class="picture-src" id="preview"/>
                                                            <input name="foto" id="img-input" type="file" accept="image/*">
                                                        </div>
                                                        <h6>Escolher Imagem</h6>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Nome <span class="text-danger">*</span></label>
                                                    <input name="nome" type="text" class="form-control" placeholder="Nome" required="">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>E-mail <span class="text-warning">*</span></label>
                                                    <input name="email" id="email" type="email" class="form-control" placeholder="E-mail">
                                                </div>
                                                <div class="form-group col-lg-2" id="mostrar" style="display:none;">
                                                    <label>Senha <span class="text-danger">*</span></label>
                                                    <input name="senha" id="senha" type="password" class="form-control" placeholder="********">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-3">
                                                    <label>Tipo <span class="text-danger">*</span></label>
                                                    <select name="tipo" id="tipo" class="form-control" required="" <?php if ($_SESSION['tipo'] == "Administrador") { ?> disabled=""<?php } ?>>
                                                        <option value="Cliente">Cliente</option>
                                                        <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?><option value="Administrador">Administrador</option> <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>CPF</label>
                                                    <input name="cpf" id="cpf" type="text" class="form-control" placeholder="000.000.000-00">
                                                </div>
                                                <div class="form-group col-lg-5">
                                                    <label>Endereço</label>
                                                    <input name="endereco" type="text" class="form-control" placeholder="Endereço">
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>Celular</label>
                                                    <input name="celular" id="celular" type="text" class="form-control" placeholder="(00) 00000-0000">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <a class="btn btn-primary" href="home_usuarios.php"><i class="fa fa-reply"></i> Voltar</a>
                                                    <button name="cadastrar" type="submit" class="btn btn-theme" value="cadastrar">Confirmar</button>
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
            <!--jQuery-->
            <script src="../../assets/js/jquery.min.js"></script>
            <script src="../../assets/js/jquery-1.12.4.min.js"></script>
            <!--Popper-->
            <script src="../../assets/js/popper.min.js"></script>
            <!--Bootstrap-->
            <script src="../../assets/js/bootstrap.min.js"></script>
            <!--Máscara Inputs-->
            <script type="text/javascript" src="../../assets/js/jquery.maskedinput-1.1.4.pack.js"></script>
            <!--Mostrar e Ocultar campos-->
            <script>
                $("#tipo").change(function () {
                    if (this.value == "Administrador") {
                        $('#mostrar').show();
                        $('#email').attr('required', 'required');
                        $('#senha').attr('required', 'required');
                    } else {
                        $('#mostrar').hide();
                        $('#email').removeAttr('required');
                        $('#senha').removeAttr('required');
                    }
                });
            </script>
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