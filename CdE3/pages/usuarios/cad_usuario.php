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
        $sql = "INSERT INTO usuario_usuarios (nome,foto,email,senha,tipo,endereco,celular,cpf,id_responsavel,criadoem) values(?,?,?,?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);

        $ID = UltimoIdUsuario() + 1;
        
        $data['email'] = strtolower($data['email']);

        //Foto
        if ($_FILES['foto']['name'] != '') {
            $novo_nome = $ID . ".png";
            move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/usuarios/" . $novo_nome);
            $foto = $novo_nome;
        } else {
            $novo_nome = $ID . ".png";
            copy("../../img/usuarios/default-usuario.jpg", "../../img/usuarios/" . $novo_nome);
            $foto = $novo_nome;
        }

        if ($_SESSION['tipo'] == "Administrador Geral") {
            if ($data['tipo'] == "Cliente") {
                $q->execute(array($data['nome'], $foto, $data['email'], '', $data['tipo'], $data['endereco'], $data['celular'], $data['cpf'], $_SESSION['id'], date('Y-m-d H:i:s')));
            } else if ($data['tipo'] == "Administrador") {
                $q->execute(array($data['nome'], $foto, $data['email'], $data['senha'], $data['tipo'], $data['endereco'], $data['celular'], $data['cpf'], $_SESSION['id'], date('Y-m-d H:i:s')));
            }
        } else if ($_SESSION['tipo'] == "Administrador") {
            $q->execute(array($data['nome'], $foto, $data['email'], '', "Cliente", $data['endereco'], $data['celular'], $data['cpf'], $_SESSION['id'], date('Y-m-d H:i:s')));
        }

        //Atualização
        $sql = "INSERT INTO atualizacao_atualizacoes (tipo, acao, id_usuario, id_responsavel, ids_vizualizados, criadoem) values(?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);

        if ($_SESSION['tipo'] == "Administrador Geral") {
            if ($data['tipo'] == "Cliente") {
                $q->execute(array("Usuário", "Cadastrar-Cliente", $ID, $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));
            } else if ($data['tipo'] == "Administrador") {
                $q->execute(array("Usuário", "Cadastrar-Administrador", $ID, $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));
            }
        } else if ($_SESSION['tipo'] == "Administrador") {
            $q->execute(array("Usuário", "Cadastrar-Cliente", $ID, $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));
        }

        $_SESSION['Cadastrado'] = True;
        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location = "home_usuarios.php");
                }
            </script>';

        Database::disconnect();
    }
?>
    <html class="no-js" lang="en">

    <head>
        <title>Novo Usuário</title>
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
        <!--Card Foto Circular-->
        <link rel="stylesheet" href="../../plugins/paper-bootstrap-wizard/paper-bootstrap-wizard.css">
        <!--Select 2-->
        <link rel="stylesheet" href="../../plugins/select2/dist/css/select2.min.css">
        <!--Meus Scripts-->
        <?php include_once '../../meus_scripts.php'; ?>
        <!--Verificar E-mail-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!--Scripts Das Máscaras-->
        <script src="../../js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#cpf").mask("999.999.999-99");
            });

            $(document).ready(function() {
                $("#celular").mask("(99) 99999-9999");
            });
        </script>
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
                                        <a href="../../home.php"><i class="ik ik-home bg-blue"></i></a>
                                    </div>
                                    <div class="page-header-title">
                                        <a href="home_usuarios.php"><i class="ik ik-users bg-blue"></i></a>
                                    </div>
                                    <div class="page-header-title">
                                        <i class="ik ik-plus-circle bg-blue"></i>
                                    </div>
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../../home.php">Página Inicial</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="home_usuarios.php">Usuários</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Novo Usuário</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
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
                                                    <div class="form-group col-lg-2">
                                                        <div class="picture-container">
                                                            <div class="picture">
                                                                <img src="../../img/usuarios/default-usuario.jpg" id="preview" class="picture-src rounded-circle" />
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
                                                        <label>E-mail <span id="mostrar_asterisco" class="text-warning" style="display: none;">*</span></label>
                                                        <input name="email" id="email" type="email" class="form-control" placeholder="E-mail">
                                                    </div>
                                                    <div class="form-group col-lg-3" id="mostrar_senha" style="display:none;">
                                                        <label>Senha <span class="text-danger">*</span></label>
                                                        <input name="senha" id="senha" type="password" class="form-control" placeholder="********">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                        <label>Tipo <span class="text-danger">*</span></label>
                                                        <select name="tipo" id="tipo" class="form-control" required="" <?php if ($_SESSION['tipo'] == "Administrador") { ?> disabled="" <?php } ?>>
                                                            <option value="Cliente">Cliente</option>
                                                            <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?><option value="Administrador">Administrador</option> <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label>Endereço</label>
                                                        <input name="endereco" type="text" class="form-control" placeholder="Endereço">
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>CPF</label>
                                                        <input name="cpf" id="cpf" type="text" class="form-control" placeholder="000.000.000-00">
                                                    </div>

                                                    <div class="form-group col-lg-2">
                                                        <label>Celular</label>
                                                        <input name="celular" id="celular" type="text" class="form-control" placeholder="(00) 00000-0000">
                                                    </div>
                                                </div>
                                                <a class="btn btn-primary text-white mr-2" href="home_usuarios.php">Início</a>
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
        <!--Script Das Máscaras-->
        <script type="text/javascript" src="../../js/jquery.maskedinput-1.1.4.pack.js"></script>
        <!--Select 2-->
        <script src="../../plugins/select2/dist/js/select2.min.js"></script>
        <!--Mostrar e Ocultar campos-->
        <script>
            $("#tipo").change(function() {
                if (this.value == "Administrador") {
                    $('#mostrar_senha').show();
                    $('#mostrar_asterisco').show();
                    $('#email').attr('required', 'required');
                    $('#senha').attr('required', 'required');
                } else {
                    $('#mostrar_senha').hide();
                    $('#mostrar_asterisco').hide();
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
                    file.onload = function(e) {
                        document.getElementById("preview").src = e.target.result;
                    };
                    file.readAsDataURL(this.files[0]);
                }
            }
            document.getElementById("img-input").addEventListener("change", readImage, false);
        </script>
        <!--Verificar E-mail-->
        <script>
            var email = $("#email");
            email.blur(function() {
                $.ajax({
                    url: 'verifica_email.php',
                    type: 'POST',
                    data: {
                        "email": email.val()
                    },
                    success: function(data) {
                        data = $.parseJSON(data);

                        if (data.email == "Existe") {
                            document.querySelector("#email").setCustomValidity("O e-mail '" + email.val() + "' já está cadastrado.");
                        } else {
                            document.querySelector("#email").setCustomValidity("");
                        }
                    }
                });
            });
        </script>
        <!--Desabilitar Enter-->
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
                $('#tipo').select2();
            });
        </script>
    </body>

    </html>
<?php } ?>