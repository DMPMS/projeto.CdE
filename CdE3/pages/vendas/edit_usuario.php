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
        $idUsuario = $_GET['id'];
    }

    $pdo = Database::connect();
    $sql = "SELECT * FROM usuario_usuarios WHERE id = $idUsuario";
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
        if ($result['tipo'] == "Cliente") {
            $sql = "UPDATE usuario_usuarios SET nome = ?,foto = ?,email = ?,endereco = ?, celular = ?,cpf = ? WHERE id = ?";
        } else if ($result['tipo'] == "Administrador") {
            $sql = "UPDATE usuario_usuarios SET nome = ?,foto = ?,email = ?,endereco = ?, celular = ?,cpf = ?,senha = ? WHERE id = ?";
        }

        $q = $pdo->prepare($sql);

        $ID = $idUsuario;

        $data['email'] = strtolower($data['email']);

        //Foto        
        if ($_FILES['foto']['name'] != '') {
            $novo_nome = $ID . ".png";
            move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/usuarios/" . $novo_nome);
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

        //Atualização
        $sql = "INSERT INTO atualizacao_atualizacoes (tipo, acao, id_usuario, id_responsavel, ids_vizualizados, criadoem) values(?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);

        if ($result['tipo'] == "Cliente") {
            $q->execute(array("Usuário", "Editar-Cliente", $ID, $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));
        } else if ($result['tipo'] == "Administrador") {
            $q->execute(array("Usuário", "Editar-Administrador", $ID, $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));
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
        <title>Editar Usuário</title>
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
        <?php if (isset($_SESSION['Editado'])) { ?>
            <!--Notificação Editado-->
            <script>
                window.onload = function() {
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
                                <div class="col-lg-4">
                                    <div class="page-header-title">
                                        <a href="../../home.php"><i class="ik ik-home bg-blue"></i></a>
                                    </div>
                                    <div class="page-header-title">
                                        <a href="home_usuarios.php"><i class="ik ik-users bg-blue"></i></a>
                                    </div>
                                    <?php if ($result['tipo'] == "Cliente") { ?>
                                        <div class="page-header-title">
                                            <a href="list_cliente.php"><i class="ik ik-list bg-blue"></i></a>
                                        </div>
                                    <?php } else if ($result['tipo'] == "Administrador") { ?>
                                        <div class="page-header-title">
                                            <a href="list_administrador.php"><i class="ik ik-user-check bg-blue"></i></a>
                                        </div>
                                    <?php } ?>
                                    <div class="page-header-title">
                                        <i class="ik ik-edit-2 bg-blue"></i>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../../home.php">Página Inicial</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="home_usuarios.php">Usuários</a>
                                            </li>
                                            <?php if ($result['tipo'] == "Cliente") { ?>
                                                <li class="breadcrumb-item">
                                                    <a href="list_cliente.php">Clientes</a>
                                                </li>
                                            <?php } else if ($result['tipo'] == "Administrador") { ?>
                                                <li class="breadcrumb-item">
                                                    <a href="list_administrador.php">Administradores</a>
                                                </li>
                                            <?php } ?>
                                            <li class="breadcrumb-item active" aria-current="page">Editar Usuário</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="row wizard-card">
                            <div class="col-md-12">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        <h3>Editar Usuário</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                        <div class="picture-container">
                                                            <div class="picture">
                                                                <img src="../../img/usuarios/<?php echo $result['foto']; ?>" id="preview" class="picture-src rounded-circle" />
                                                                <input name="foto" id="img-input" type="file" accept="image/*">
                                                            </div>
                                                            <h6>Escolher Imagem</h6>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Nome <span class="text-danger">*</span></label>
                                                        <input name="nome" type="text" class="form-control" placeholder="Nome" required="" value="<?php echo $result['nome']; ?>">
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label>E-mail <?php if ($result['tipo'] == "Administrador") { ?><span class="text-warning">*</span><?php } ?></label>
                                                        <input name="email" id="email" type="email" class="form-control" placeholder="E-mail" <?php if ($result['tipo'] == "Administrador") { ?> required="" <?php } ?> value="<?php echo $result['email']; ?>">
                                                    </div>
                                                    <?php if ($result['tipo'] == "Administrador") { ?>
                                                        <div class="form-group col-lg-3">
                                                            <label>Senha <span class="text-danger">*</span></label>
                                                            <input name="senha" type="password" class="form-control" placeholder="********" <?php if ($result['tipo'] == "Administrador") { ?> required="" <?php } ?> value="<?php echo $result['senha']; ?>">
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                        <label>Tipo <span class="text-danger">*</span></label>
                                                        <select name="tipo" id="tipo" class="form-control" required="" disabled="">
                                                            <?php if ($result['tipo'] == "Cliente") { ?>
                                                                <option value="Cliente">Cliente</option>
                                                            <?php } else if ($result['tipo'] == "Administrador") { ?>
                                                                <option value="Administrador">Administrador</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label>Endereço</label>
                                                        <input name="endereco" type="text" class="form-control" placeholder="Endereço" value="<?php echo $result['endereco']; ?>">
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>CPF</label>
                                                        <input name="cpf" id="cpf" type="text" class="form-control" placeholder="000.000.000-00" value="<?php echo $result['cpf']; ?>">
                                                    </div>

                                                    <div class="form-group col-lg-2">
                                                        <label>Celular</label>
                                                        <input name="celular" id="celular" type="text" class="form-control" placeholder="(00) 00000-0000" value="<?php echo $result['celular']; ?>">
                                                    </div>
                                                </div>
                                                <?php if (isset($_SESSION['Administrador-Cliente'])) { ?>
                                                    <a class="btn btn-primary text-white mr-2" href="list_administrador_cliente.php?id=<?php echo $_SESSION['Administrador-Cliente']; ?>">Clientes de "<?php echo NomeUsuario($_SESSION['Administrador-Cliente']); ?>"</a>
                                                <?php } ?>
                                                <?php if ($result['tipo'] == "Cliente") { ?>
                                                    <a class="btn btn-primary text-white mr-2" href="list_cliente.php">Clientes</a>
                                                <?php } else if ($result['tipo'] == "Administrador") { ?>
                                                    <a class="btn btn-primary text-white mr-2" href="list_administrador.php">Administradores</a>
                                                <?php } ?>
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
        <!--Script Das Máscaras-->
        <script type="text/javascript" src="../../js/jquery.maskedinput-1.1.4.pack.js"></script>
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

                        if (data.email == "Existe" && email.val() != "<?php echo $result['email']; ?>") {
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
    </body>

    </html>
<?php } ?>