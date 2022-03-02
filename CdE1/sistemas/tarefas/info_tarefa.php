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
        $sql = "SELECT * FROM cde_terefa ORDER BY id DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        $idTarefa = $result['id'];
    } else {
        $idTarefa = $_GET['id'];
    }

    $pdo = Database::connect();
    $sql = "SELECT * FROM cde_tarefa WHERE id = $idTarefa";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $editsucesso = null;
    if (isset($data['buttoncadastrar']) == 'Cadastrar') {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE cde_tarefa SET nome = ?,descricao = ?,id_responsavel = ?,local = ?,data_prazo = ? WHERE id = ?";
        $q = $pdo->prepare($sql);

        $q->execute(array($data['nome'], $data['descricao'], $data['id_responsavel'], $data['local'], $data['data_prazo'], $idTarefa));
        $editsucesso = 1;

        $pdo = Database::connect();
        $sql = "SELECT * FROM cde_tarefa WHERE id = $idTarefa";
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
            <title>Informações da Tarefa</title>
            <script src="../../vendor/jquery/jquery.min.js"></script>
            <script src="../../js/ckeditor/ckeditor.js"></script>

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
                                                    <div class="form-group col-lg-8">
                                                        <label title="Campo Obrigatório">Tarefa:<a style="color: red;">*</a></label>
                                                        <input required="" type="name" name="nome" class="form-control form-control-user" value="<?php echo $result['nome']; ?>" placeholder="Nome da Tarefa" minlength="8" <?php if ($result['status'] == "Concluída" || $_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Responsável:<a style="color: red;">*</a></label>
                                                        <select name="id_responsavel" class="form-control" required="" <?php if ($result['status'] == "Concluída" || $_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
                                                            <option value="0">Todos</option>
                                                            <?php
                                                            while ($usuarios = mysqli_fetch_array($ConsUsuario)):
                                                                ?>
                                                                <option value="<?php echo $usuarios['id']; ?>"<?php
                                                                if ($result['id_responsavel'] == $usuarios['id']) {
                                                                    echo 'selected=""';
                                                                }
                                                                ?>
                                                                        ><?php echo $usuarios['nome'] ?></option>
                                                                    <?php endwhile; ?>                             
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-8">
                                                        <label>Descrição:</label>
                                                        <textarea style=" height: 250px" name="descricao" id="descricao" class="form-control form-control-user" placeholder="Descrição" minlength="8" <?php if ($result['status'] == "Concluída"|| $_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>><?php echo $result['descricao']; ?></textarea>
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label title="Campo Obrigatório">Prazo:<a style="color: red;">*</a></label>
                                                        <input type="datetime-local" name="data_prazo" min="<?php echo date("Y-m-d\TH:i"); ?>" class="form-control form-control-user" value="<?php echo date('Y-m-d\TH:i', strtotime($result['data_prazo'])); ?>" required="" <?php if ($result['status'] == "Concluída"|| $_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>
                                                        <br>
                                                        <label>Local/Setor:</label>
                                                        <input type="name" name="local" class="form-control form-control-user" value="<?php echo $result['local']; ?>" placeholder="Local/Setor" minlength="8" <?php if ($result['status'] == "Concluída" || $_SESSION['tipo'] != "Administrador Geral") { ?> disabled="" <?php } ?>>

                                                        <?php if ($editsucesso == 1) { ?>
                                                            <label style="color: white">a</label><br><br><br>
                                                            <span type="button" class="form-control form-control-user btn-success" ><i class="fas fa-check-circle"></i> Dados editados!</span>
                                                            <?php
                                                        } else if ($result['status'] == "Concluída") {
                                                            ?>
                                                            <label style="color: white">a</label><br>
                                                            <span style="height: 86px" type="button" class="form-control form-control-user btn-success" ><i class="fas fa-check-circle"></i> Tarefa concluída dia <?php echo date('d/m/Y \à\s H:i', strtotime($result['data_conclusao'])); ?> por <?php echo $result['nome_responsavel_conclusao'] ?>.</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php if ($result['status'] == "Pendente") { ?>
                                                    <a href="list_tarefa_pendente.php" class="btn btn-user btn-primary">
                                                        <i class="fas fa-reply"></i> Voltar
                                                    </a>
                                                    <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                                        <button  name="buttoncadastrar" value="Cadastrar" class="btn btn-success btn-user" type="submit" style="float: right;">Confirmar alterações</button>
                                                    <?php } ?>
                                                <?php } else if ($result['status'] == "Concluída") { ?>
                                                    <a href="list_tarefa_concluida.php" class="btn btn-user btn-primary">
                                                        <i class="fas fa-reply"></i> Voltar
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        CKEDITOR.replace('descricao')
                                        CKEDITOR.config.language = 'pt-br';
                                        CKEDITOR.config.height = 180;
                                        CKEDITOR.config.removePlugins = 'resize';
                                        CKEDITOR.config.toolbar =
                                        [
                                        { name: 'clipboard', items : ['Undo','Redo' ] },
                                        { name: 'styles', items : [ 'Styles','Format' ] },
                                        { name: 'basicstyles', items : [ 'Bold','Italic','RemoveFormat' ] },
                                        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','SpacingLine' ] }
                                        ];
                                    </script>
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
