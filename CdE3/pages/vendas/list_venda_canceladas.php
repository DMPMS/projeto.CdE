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
    $sql = "SELECT * FROM venda_vendas WHERE ativo = 1";

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
?>
    <html class="no-js" lang="en">

    <head>
        <title>Vendas Canceladas</title>
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
        <!--Datatable-->
        <link rel="stylesheet" href="../../plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <!--Pra Notificação-->
        <link rel="stylesheet" href="../../plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
        <!--Theme CSS-->
        <link rel="stylesheet" href="../../dist/css/theme.min.css">
        <!--Meus Scripts-->
        <?php include_once '../../meus_scripts.php'; ?>
        <?php if (isset($_SESSION['Cancelar'])) { ?>
            <!--Notificação Cancelada-->
            <script>
                window.onload = function() {
                    $.toast({
                        text: '<b>Venda <?php echo $_SESSION['Cancelar']; ?></b> cancelada.',
                        icon: 'success',
                        hideAfter: 5000,
                        loader: false,
                        position: 'top-right'
                    })
                }
            </script>
        <?php } ?>
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
                                        <a href="../../home.php"><i class="ik ik-home bg-orange"></i></a>
                                    </div>
                                    <div class="page-header-title">
                                        <a href="home_vendas.php"><i class="ik ik-shopping-cart bg-orange"></i></a>
                                    </div>
                                    <div class="page-header-title">
                                        <i class="ik ik-x-circle bg-orange"></i>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <nav class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../../home.php">Página Inicial</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="home_vendas.php">Vendas</a>
                                            </li>
                                            <li class="breadcrumb-item active">Vendas Canceladas</li>
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
                                                <th>Número da Venda</th>
                                                <th>Cliente</th>
                                                <th>Total</th>
                                                <th>Desconto</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pdo->query($sql) as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo NomeUsuario($row['id_cliente']); ?></td>
                                                    <td><?php echo "R$ " . number_format(TotalDaVendaComDesconto($row['id']), 2, ',', '.'); ?></td>
                                                    <td><?php if ($row['tipo_desconto'] == "SemDesconto") { ?>
                                                            <div class="badge badge-pill badge-secondary">Sem Desconto</div>
                                                        <?php } else {
                                                            if ($row['tipo_desconto'] == "EmPorcentagem") {
                                                                $desconto = "{$row['desconto']}%";
                                                            } else {
                                                                $desconto = "R$ " . number_format($row['desconto'], 2, ',', '.');
                                                            } ?>
                                                            <div class="badge badge-pill badge-success"><?php echo $desconto; ?></div>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <button title="Dados" type="button" class="btn btn-icon btn-primary mr-1" data-toggle="modal" data-target="#Dados<?php echo $row['id']; ?>"><i class="ik ik-eye"></i></button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Número da Venda</th>
                                                <th>Cliente</th>
                                                <th>Total</th>
                                                <th>Desconto</th>
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
                                            <h5 class="modal-title">Dados da Venda <strong><?php echo $row['id']; ?></strong></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label style="color: red;">Responsável pelo Cancelamento</label>
                                                    <input type="text" class="form-control" readonly="" value="<?php echo NomeUsuario($row['id_responsavel_cancelamento']); ?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label style="color: red;">Data de Cancelamento</label>
                                                    <input type="text" class="form-control" readonly="" value="<?php echo date('d/m/Y \à\s H:i', strtotime($row['data_cancelamento'])); ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label>Nome do Cliente</label>
                                                    <input type="text" class="form-control" readonly="" value="<?php echo NomeUsuario($row['id_cliente']); ?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Responsável pela Venda</label>
                                                    <input type="text" class="form-control" readonly="" value="<?php echo NomeUsuario($row['id_responsavel']); ?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Data da Venda</label>
                                                    <input type="text" class="form-control" readonly="" value="<?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-3">
                                                    <label>Total</label>
                                                    <input type="text" class="form-control" readonly="" value="R$ <?php echo number_format(TotalDaVendaSemDesconto($row['id']), 2, ',', '.'); ?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Desconto</label>
                                                    <input type="text" class="form-control" readonly="" value="<?php
                                                                                                                if ($row['tipo_desconto'] == "EmPorcentagem") {
                                                                                                                    echo "{$row['desconto']}%";
                                                                                                                } else if ($row['tipo_desconto'] == "EmReais") {
                                                                                                                    echo "R$ " . number_format($row['desconto'], 2, ',', '.');
                                                                                                                } else {
                                                                                                                    echo "Sem Desconto";
                                                                                                                } ?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Total Com Desconto</label>
                                                    <input id="TotalComDesconto" type="text" class="form-control" readonly="" value="R$ <?php echo number_format(TotalDaVendaComDesconto($row['id']), 2, ',', '.'); ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-3">
                                                    <label>Subtrair do Estoque</label>
                                                    <input id="TotalComDesconto" type="text" class="form-control" readonly="" value="<?php
                                                                                                                                        if ($row['subtrair_estoque'] == "Sim") {
                                                                                                                                            echo "Subtraiu";
                                                                                                                                        } else {
                                                                                                                                            echo "Não Subtraiu";
                                                                                                                                        } ?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Atualizações de Estoque Alterado</label>
                                                    <input id="TotalComDesconto" type="text" class="form-control" readonly="" value="<?php
                                                                                                                                        if ($row['atualizacoes_produtos'] == "Sim") {
                                                                                                                                            echo "Com Atualizações";
                                                                                                                                        } else {
                                                                                                                                            echo "Sem Atualizações";
                                                                                                                                        } ?>">
                                                </div>
                                            </div>
                                            <div>
                                                <table class="table table-hover table-bordered" style="overflow: auto; max-height: 150px;">
                                                    <thead>
                                                        <tr>
                                                            <th>Produto</th>
                                                            <th>Preço</th>
                                                            <th>Quantidade</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sqlProdutosDaVenda = "SELECT * FROM venda_produtos WHERE id_venda = {$row['id']} AND ativo = 0";
                                                        foreach ($pdo->query($sqlProdutosDaVenda) as $produto) { ?>
                                                            <tr>
                                                                <td><img src="../../img/produtos/<?php echo $produto['id_produto'] . ".png"; ?>" class="table-user-thumb"> <?php echo NomeProduto($produto['id_produto']); ?></td>
                                                                <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                                                                <td><?php echo $produto['qtd']; ?></td>
                                                                <td>R$ <?php echo number_format($produto['qtd'] * $produto['preco'], 2, ',', '.'); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
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
            $(document).ready(function() {
                $('#traduzir').DataTable({
                    "order": [
                        [0, "desc"]
                    ],
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
        <?php if (isset($_SESSION['Cancelar'])) { ?>
            <!--Carregar Modal de Venda Cancelada-->
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#Dados<?php echo $_SESSION['Cancelar']; ?>').modal('show');
                });
            </script>
        <?php
            unset($_SESSION['Cancelar']);
        } ?>
    </body>

    </html>
<?php } ?>