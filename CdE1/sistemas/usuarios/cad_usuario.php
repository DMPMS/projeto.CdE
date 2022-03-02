<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "../../necessariologar.php";
        </script>';
} else {

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['buttoncadastrar']) == 'Cadastrar') {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO cde_usuario (nome,foto,email,senha,tipo,endereco,telefone,cpf,nascimento,criadoem,id_responsavel,nome_responsavel) values(?,?,?,?,?,?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);

        //codico destinado à foto
        $sqlID = "SELECT * FROM cde_usuario ORDER BY id DESC LIMIT 1";
        $recordsID = $pdo->prepare($sqlID);
        $recordsID->execute();
        $resultID = $recordsID->fetch(PDO::FETCH_ASSOC);
        $ID = $resultID['id'] + 1;

        if ($_FILES['foto']['name'] != '') {
            //verfica se é jpeg
            $pos = strpos(substr($_FILES['foto']['name'], -4), ".");
            if ($pos === false) {
                $ponto = -5;
            } else {
                $ponto = -4;
            }

            $extensao = strtolower(substr($_FILES['foto']['name'], $ponto));
            $novo_nome = $ID++ . $extensao;
            $diretorio = "fotos/";
            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $novo_nome);
            $foto = $novo_nome;
        } else {
            $novo_nome = $ID . ".png";
            copy("img_padrao.png", "fotos/" . $novo_nome);
            $foto = $novo_nome;
        }
        ///////////////////////

//        if ($data['tipo'] == "Cliente") {
//            $q->execute(array($data['nome'], $foto, $data['email'], '', $data['tipo'], $data['endereco'], $data['telefone'], $data['cpf'], $data['nascimento'], date('d/m/Y \à\s H:i'), $_SESSION['id'], $_SESSION['nome']));
//
//            //notificação de cliente novo
//            $sql = "INSERT INTO cde_notificacao (tipo,id_registro,visualizado,criadoem,nome,id_responsavel,nome_responsavel,tipo_responsavel) values(?,?,?,?,?,?,?,?)";
//            $q = $pdo->prepare($sql);
//            $q->execute(array("Usuário", NumUltimoUsuario(), "." . $_SESSION['id'] . ".", date('Y-m-d H:i:s'), $data['nome'], $_SESSION['id'], $_SESSION['nome'], $_SESSION['tipo']));
//        } else {
//            $q->execute(array($data['nome'], $foto, $data['email'], $data['senha'], $data['tipo'], $data['endereco'], $data['telefone'], $data['cpf'], $data['nascimento'], date('d/m/Y \à\s H:i'), $_SESSION['id'], $_SESSION['nome']));
//        }
        Database::disconnect();

        echo '<script>
            window.location = "sweet_cadastrado.php"
                 </script>';
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
            <title>Novo Usuário</title>
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


            <!-- Custom fonts for this template-->
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
                                                    <img style="max-height: 150px; max-width: 150px;" id="img" src="img_padrao.png" class="img-thumbnail">
                                                </div><br>
                                                <div class="text-center">
                                                    <label for='selecao-arquivo'class="btn btn-primary btn-user"> <i class="fas fa-image"></i> Escolher Foto</label>
                                                    <input id='selecao-arquivo' type='file' name="foto" accept="image/*">
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Nome do Usuário:<a style="color: red;">*</a></label>
                                                        <input required="" type="name" name="nome" class="form-control form-control-user" value="<?php echo isset($data['nome']); ?>" placeholder="Nome" minlength="8">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Tipo:<a style="color: red;">*</a></label>
                                                        <select name="tipo" id="tipo" class="form-control" required="">
                                                            <option value="Cliente">Cliente</option>
    <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                                                <option value="Administrador">Administrador</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório para tipo Administrador">E-mail:<a style="color: orange;">*</a></label>
                                                        <input type="email" name="email" id="email" class="form-control form-control-user" value="<?php echo isset($data['email']); ?>" placeholder="E-mail">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-8">
                                                        <label>Endereço:</label>
                                                        <input  type="name" name="endereco" class="form-control form-control-user" value="<?php echo isset($data['endereco']); ?>" placeholder="Endereço" minlength="8">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Telefone/Celular:</label>
                                                        <input type="text" name="telefone" id="telefone" class="form-control form-control-user" value="<?php echo isset($data['telefone']); ?>" placeholder="(00) 00000-0000">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label >CPF:</label>
                                                        <input type="text" name="cpf" id="cpf" class="form-control form-control-user" value="<?php echo isset($data['cpf']); ?>" placeholder="000.000.000-00">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label >Data de Nascimento:</label>
                                                        <input type="date" name="nascimento" class="form-control form-control-user" value="<?php echo isset($data['nascimento']); ?>">
                                                    </div>
                                                </div>
                                                <div class="row" id="mostrar" style="display:none;">
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Senha:<a style="color: red;">*</a></label>
                                                        <input minlength="8" id="senha" type="password" name="senha" class="form-control form-control-user" value="<?php echo isset($data['senha']); ?>">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Confirmar senha:<a style="color: red;">*</a></label>
                                                        <input minlength="8" id="senhaC" type="password" name="senhaC" class="form-control form-control-user" value="<?php isset($data['senhaC']); ?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <a href="home_usuarios.php" class="btn btn-user btn-primary">
                                                    <i class="fas fa-reply"></i> Voltar
                                                </a>
                                                <button name="buttoncadastrar" onclick="return validarSenha()" value="Cadastrar" class="btn btn-success btn-user" type="submit" style="float: right;">Cadastrar</button>
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
            <script type="text/javascript" src="../../js/jquery.maskedinput-1.1.4.pack.js"></script>

            <script>
                $("#tipo").change(function() {
                if (this.value == "Administrador") {
                $('#mostrar').show();
                $('#email').attr('required','required');
                $('#senha').attr('required','required');
                $('#senhaC').attr('required','required');
                } else {
                $('#mostrar').hide();
                $('#email').removeAttr('required');
                $('#senha').removeAttr('required');
                $('#senhaC').removeAttr('required');
                }
                });
            </script>
            <script>
                let senha = document.getElementById('senha');
                let senhaC = document.getElementById('senhaC');

                function validarSenha() {
                if (senha.value != senhaC.value) {
                senhaC.setCustomValidity("Senhas diferentes!");
                senhaC.reportValidity();
                return false;
                } else {
                senhaC.setCustomValidity("");
                return true;
                }
                }

                senhaC.addEventListener('input', validarSenha);
            </script>
        </body>
    </html>
<?php } ?>
