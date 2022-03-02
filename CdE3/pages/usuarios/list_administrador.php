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
    $sql = "SELECT * FROM usuario_usuarios WHERE tipo = 'Administrador' AND ativo = 0";

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['excluir']) == 'excluir') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Excluir
        $sqlExcluir = "UPDATE usuario_usuarios SET ativo = ? WHERE id = ?";
        $qExcluir = $pdo->prepare($sqlExcluir);
        $qExcluir->execute(array(1, $data['id']));

        //Atualização
        $sqlAtualizacao = "INSERT INTO atualizacao_atualizacoes (tipo, acao, id_usuario, id_responsavel, ids_vizualizados, criadoem) values(?,?,?,?,?,?)";
        $qAtualizacao = $pdo->prepare($sqlAtualizacao);
        $qAtualizacao->execute(array("Usuário", "Excluir-Administrador", $data['id'], $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));

        Database::disconnect();

        $_SESSION['Excluir'] = NomeUsuario($data['id']);
        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>';
    }
    ?>
    <html class="no-js" lang="en">
        <head>
            <title>Administradores</title>
            <!--Ícone-->
            <link rel="icon" href="../../ico.png" type="image/x-icon"/>
            <!--Fonte-->
            <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
            <!--Bootstrap-->
            <link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">
            <!--Ik Ícones-->
            <link rel="stylesheet" href="../../plugins/icon-kit/dist/css/iconkit.min.css">
            <!--ScroolBar Menu-->
            <link rel="stylesheet" href="../../plugins/perfect-scrollbar/css/perfect-scrollbar.css">
            <!--Datatable-->
            <link rel="stylesheet" href="../../plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
            <!--Pra Notificação-->
            <link rel="stylesheet" href="../../plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
            <!--Theme CSS-->
            <link rel="stylesheet" href="../../dist/css/theme.min.css">
            <!--Meus Scripts-->
            <?php include_once '../../meus_scripts.php'; ?>
            <?php if (isset($_SESSION['Excluir'])) { ?>
                <!--Notificação Excluído-->
                <script>
                    window.onload = function () {
                        $.toast({
                            text: '<b><?php echo $_SESSION['Excluir']; ?></b> excluído(a).',
                            icon: 'success',
                            hideAfter: 5000,
                            loader: false,
                            position: 'top-right'
                        })
                    }
                </script>
                <?php
                unset($_SESSION['Excluir']);
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
                                            <a href="../../home.php"><i class="ik ik-home bg-blue"></i></a>
                                        </div>
                                        <div class="page-header-title">
                                            <a href="home_usuarios.php"><i class="ik ik-users bg-blue"></i></a>
                                        </div>
                                        <div class="page-header-title">
                                            <i class="ik ik-user-check bg-blue"></i>
                                        </div>
                                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a href="../../home.php">Página Inicial</a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="home_usuarios.php">Usuários</a>
                                                </li>
                                                <li class="breadcrumb-item active" aria-current="page">Administradores</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="dt-responsive">
                                        <table id="traduzir" class="table table-striped table-bordered nowrap">
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
                                                        <td><img src="../../img/usuarios/<?php echo $row['foto']; ?>" class="table-user-thumb">
                                                            <?php echo $row['nome']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td>19</td>
                                                        <td style="vertical-align:middle">R$ 3000,00</td>
                                                        <td class="text-center">
                                                            <button title="Dados" type="button" class="btn btn-icon btn-primary mr-1" data-toggle="modal" data-target="#Dados<?php echo $row['id']; ?>"><i class="ik ik-eye"></i></button>
                                                            <a title="Clientes de <?php echo $row['nome']; ?>" href="list_administrador_cliente.php?id=<?php echo $row['id']; ?>" class="btn btn-icon btn-primary mr-1"><i class="ik ik-users"></i></a>
                                                            <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                                                <a title="Editar" href="edit_usuario.php?id=<?php echo $row['id']; ?>" class="btn btn-icon btn-warning mr-1"><i class="ik ik-edit-2"></i></a>
                                                                <button title="Excluir" type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#Excluir<?php echo $row['id']; ?>"><i class="ik ik-trash-2"></i></button>
                                                            <?php } ?>
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
                            </div>
                            <!--Modal de Dados-->
                            <?php foreach ($pdo->query($sql) as $row) { ?>
                                <div class="modal fade" id="Dados<?php echo $row['id']; ?>">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Dados: <strong><?php echo $row['nome']; ?></strong></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-lg-12 text-center">
                                                        <img src="../../img/usuarios/<?php echo $row['foto']; ?>" class="rounded-circle" width="120px" height="120px">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-3">
                                                        <label>Data de Cadastro</label>
                                                        <input type="text" class="form-control" readonly="" value="<?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?>">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Responsável pelo Cadastro</label>
                                                        <input type="text" class="form-control" readonly="" value="<?php echo NomeUsuario($row['id_responsavel']); ?>">
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>Vendas <a href="cad_usuario.php"><i class="ik ik-arrow-right-circle text-primary"></i></a></label>
                                                        <input type="text" class="form-control" readonly="" value="1262">
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label>Lucro</label>
                                                        <input type="text" class="form-control" readonly="" value="R$ 12.000,00">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-2">
                                                        <label>Clientes <a href="list_administrador_cliente.php?id=<?php echo $row['id']; ?>"><i class="ik ik-arrow-right-circle text-primary"></i></a></label>
                                                        <input type="text" class="form-control" readonly="" value="<?php echo QtdClientesDoAdministrador($row['id']); ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label>Nome</label>
                                                        <input name="nome" type="text" class="form-control" readonly="" value="<?php echo $row['nome']; ?>">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>E-mail</label>
                                                        <input name="email" type="email" class="form-control" readonly="" value="<?php echo $row['email']; ?>">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Tipo</label>
                                                        <input name="tipo" type="text" class="form-control" readonly="" value="<?php echo $row['tipo']; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-3">
                                                        <label>CPF</label>
                                                        <input name="cpf" type="text" class="form-control" readonly="" value="<?php echo $row['cpf']; ?>">
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <label>Endereço</label>
                                                        <input name="endereco" type="text" class="form-control" readonly="" value="<?php echo $row['endereco']; ?>">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Celular</label>
                                                        <input name="celular" type="text" class="form-control" readonly="" value="<?php echo $row['celular']; ?>">
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
                            <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                <!--Modal de Excluir-->
                                <?php foreach ($pdo->query($sql) as $row) { ?>
                                    <div class="modal fade" id="Excluir<?php echo $row['id']; ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Excluir: <strong><?php echo $row['nome']; ?></strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 text-center">
                                                                <img src="../../img/usuarios/<?php echo $row['foto']; ?>" class="rounded-circle" width="120px" height="120px">
                                                            </div>
                                                        </div>
                                                        <p>Deseja excluir <b><?php echo $row['nome']; ?></b>? As vendas, tarefas e clientes deste(a) administrador(a) serão mantidas.</p>
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
                            <?php } ?>
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
            <!--Datatable-->
            <script src="../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="../../plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
            <!--Theme JS-->
            <script src="../../dist/js/theme.min.js"></script>
            <!--Pra Notificação-->
            <script src="../../plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
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