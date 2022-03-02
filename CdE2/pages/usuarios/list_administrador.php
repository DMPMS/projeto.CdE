<!DOCTYPE html>
<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (isset($_SESSION['id']) == '') {
    echo '<script> window.location = "index.php"; </script>';
} else {
    $pdo = Database::connect();
    $sql = "SELECT * FROM usuario_usuarios WHERE tipo = 'Administrador' AND ativo = 0";

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['excluir']) == 'excluir') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sqlExcluir = "UPDATE usuario_usuarios SET ativo = ? WHERE id = ?";
        $qExcluir = $pdo->prepare($sqlExcluir);
        $qExcluir->execute(array(1, $data['id']));

        $sqlBuscar = "SELECT * FROM usuario_usuarios WHERE id = " . $data['id'];
        $recordsBuscar = $pdo->prepare($sqlBuscar);
        $recordsBuscar->execute();
        $resultBuscar = $recordsBuscar->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();

        $excluido = $resultBuscar['nome'];
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
            <link rel="stylesheet" href="../../assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="../../assets/css/fontawesome.css">
            <!--DataTable-->
            <link rel="stylesheet" href="../../assets/css/dataTables.bootstrap4.min.css">
            <!--Pra Notificação-->
            <link rel="stylesheet" href="../../assets/css/alertify.min.css">
            <title>Administradores</title>
            <script>
                function Sair() {
                    window.location = "../../sair.php";
                }
            </script>
            <!--Notificação Excluído-->
            <?php if (isset($excluido)) { ?>
                <script>
                    window.onload = function () {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success('<strong><?php echo $excluido; ?></strong> excluído(a).').dismissOthers();
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
                            <strong>Administradores</strong>
                        </h5>
                        <!--Página-->
                        <div class="row">
                            <div class="col-sm-12">
                                <!--DataTable-->
                                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                                    <a class="btn btn-primary" href="home_usuarios.php"><i class="fa fa-reply"></i> Voltar</a>
                                    <div class="table-responsive">
                                        <table id="traduzir" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>E-mail</th>
                                                    <th>Vendas</th>
                                                    <th>Lucro</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pdo->query($sql) as $row) { ?>
                                                    <tr>
                                                        <td style="vertical-align:middle">
                                                            <img src="../../assets/img/usuarios/<?php echo $row['foto']; ?>" class="rounded-circle" width="40px" height="40px">
                                                            <?php echo $row['nome']; ?>
                                                        </td>
                                                        <td style="vertical-align:middle"><?php echo $row['celular']; ?></td>
                                                        <td style="vertical-align:middle">37</td>
                                                        <td style="vertical-align:middle">R$ 12.000,00</td>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <button title="Dados" type="button" class="btn btn-primary icon-round" data-toggle="modal" data-target="#Dados<?php echo $row['id']; ?>"><i class="fa fa-eye"></i></button>
                                                            <a href="edit_usuario.php?id=<?php echo $row['id']; ?>"><button title="Editar" type="button" class="btn btn-warning icon-round"><i class="fa fa-pencil text-white"></i></button></a>
                                                            <button type="button" title="Excluir" data-toggle="modal" data-target="#Excluir<?php echo $row['id']; ?>" class="btn btn-danger icon-round"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>E-mail</th>
                                                    <th>Vendas</th>
                                                    <th>Lucro</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!--/DataTable-->
                                <!--Modal de Dados-->
                                <?php foreach ($pdo->query($sql) as $row) { ?>
                                    <div class="modal fade" id="Dados<?php echo $row['id']; ?>">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Dados: <strong><?php echo $row['nome']; ?></strong></h5>
                                                    <button type="button" class="close semborda" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 text-center">
                                                            <img src="../../assets/img/usuarios/<?php echo $row['foto']; ?>" class="rounded-circle" width="120px" height="120px">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-4">
                                                            <label>Nome</label>
                                                            <input name="nome" type="text" class="form-control" disabled="" value="<?php echo $row['nome']; ?>">
                                                        </div>
                                                        <div class="form-group col-lg-4">
                                                            <label>E-mail</label>
                                                            <input name="email" type="email" class="form-control" disabled="" value="<?php echo $row['email']; ?>">
                                                        </div>
                                                        <div class="form-group col-lg-4">
                                                            <label>Tipo</label>
                                                            <input name="tipo" type="text" class="form-control" disabled="" value="<?php echo $row['tipo']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-3">
                                                            <label>CPF</label>
                                                            <input name="cpf" type="text" class="form-control" disabled="" value="<?php echo $row['cpf']; ?>">
                                                        </div>
                                                        <div class="form-group col-lg-5">
                                                            <label>Endereço</label>
                                                            <input name="endereco" type="text" class="form-control" disabled="" value="<?php echo $row['endereco']; ?>">
                                                        </div>
                                                        <div class="form-group col-lg-4">
                                                            <label>Celular</label>
                                                            <input name="celular" type="text" class="form-control" disabled="" value="<?php echo $row['celular']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!--/Modal de Dados-->
                            </div>
                            <!--Modal de Excluir-->
                            <?php foreach ($pdo->query($sql) as $row) { ?>
                                <div class="modal fade" id="Excluir<?php echo $row['id']; ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Excluir: <strong><?php echo $row['nome']; ?></strong></h5>
                                                <button type="button" class="close semborda" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 text-center">
                                                            <img src="../../assets/img/usuarios/<?php echo $row['foto']; ?>" class="rounded-circle" width="120px" height="120px">
                                                        </div>
                                                    </div>
                                                    <p>Deseja excluir <b><?php echo $row['nome']; ?></b>? As vendas deste(a) administrador(a) serão mantidas.</p>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                    <button type="submit" name="excluir" value="excluir"  class="btn btn-danger">Sim</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--/Modal de Excluir-->
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
            <!--DataTable-->
            <script src="../../assets/js/jquery.dataTables.min.js"></script>
            <script src="../../assets/js/dataTables.bootstrap4.min.js"></script>
            <!--Traduzir Tabela-->
            <script>
                    $(document).ready(function () {
                        $('#traduzir').DataTable({
                            "language": {
                                "sEmptyTable": "Nenhum registro encontrado",
                                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                                "sInfoPostFix": "",
                                "sInfoThousands": ".",
                                "sLengthMenu": "Exibindo _MENU_ resultados por página",
                                "sLoadingRecords": "Carregando...",
                                "sProcessing": "Processando...",
                                "sZeroRecords": "Nenhum registro encontrado",
                                "sSearch": "Pesquisar",
                                "oPaginate": {
                                    "sNext": "Próximo",
                                    "sPrevious": "Anterior",
                                    "sFirst": "Primeiro",
                                    "sLast": "Último"
                                },
                                "oAria": {
                                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                                    "sSortDescending": ": Ordenar colunas de forma descendente"
                                }
                            }
                        });
                    });
            </script>
        </body>
    </html>
<?php } ?>