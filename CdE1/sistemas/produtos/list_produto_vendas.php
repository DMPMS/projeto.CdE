<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "../../necessariologar.php";
        </script>';
} else {
    $idUsuario = $_SESSION['id'];
    $idProduto = $_GET['idProduto'];

    $pdo = Database::connect();
    $sql = "SELECT * FROM cde_venda_detalhe as so WHERE (SELECT COUNT(*) FROM cde_venda as ta WHERE ta.id_produto = $idProduto and ta.num_venda = so.num_venda) != 0";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    ?>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
<link rel="icon" type="image/png" href="../../img/ico.png">
            <title>Compras de <?php echo NomeProduto($idProduto); ?></title>
            <script>
                function Deslogar(){
                Swal.fire({
                title: 'Deseja realmente sair?',
                text: 'Selecione "Deslogar" abaixo se você estiver pronto para encerrar sua sessão atual.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonText: '<i class="fas fa-reply"></i> Cancelar',
                confirmButtonText: 'Deslogar <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                window.location = "../../logout.php";
                }
                })
                }
            </script>
            <link href="../../js/sweet/sweetalert2.min.css" rel="stylesheet" type="text/css">
            <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
            <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
            <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        </head>

        <body id="page-top">
            <div id="wrapper">
                <?php include '../menu.php'; ?> 
                <div id="content-wrapper" class="d-flex flex-column">
                    <div id="content">
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                            <ul class="navbar-nav ml-auto">

                                <div class="topbar-divider d-none d-sm-block"></div>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo NomeUsuario($idUsuario); ?></span>
                                        <img class="img-profile rounded-circle" src="../usuarios/fotos/<?php echo FotoUsuario($idUsuario); ?>">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="../../perfil.php">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Perfil
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="Deslogar()">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Deslogar
                                        </a>
                                    </div>
                                </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <a href="list_produto.php" class="btn btn-user btn-primary">
                                        <i class="fas fa-reply"></i> Voltar
                                    </a>
                                    <h1 class="h2 mb-0 text-gray-800" style="float: right">Vendas de <?php echo NomeProduto($idProduto); ?></h1>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="traduzir" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Número da Venda</th>
                                                    <th>Comprador</th>
                                                    <th>Valor</th>
                                                    <th>Data</th>
                                                    <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                                        <th>Excluir</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Número da Venda</th>
                                                    <th>Comprador</th>
                                                    <th>Valor</th>
                                                    <th>Data</th>
                                                    <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                                        <th>Excluir</th>
                                                    <?php } ?>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                foreach ($pdo->query($sql) as $row) {
                                                    ?>
                                                    <tr>
                                                        <td style="vertical-align:middle"><a href="info_venda.php?num_venda=<?php echo $row['num_venda']; ?>" style="vertical-align:middle" class="semsublinhar"><button class="btn-sm btn-circle btn-info semborda"><i class="fas fa-info-circle"></i></button></a> <a href="info_venda.php?num_venda=<?php echo $row['num_venda']; ?>" style="vertical-align:middle" class="semsublinhar"><?php echo $row['num_venda']; ?></a></td>
                                                        <td style="vertical-align:middle"><?php echo $row['nome_cliente']; ?></td>
                                                        <td style="vertical-align:middle">R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?></td>
                                                        <td style="vertical-align:middle"><?php echo substr($row['criadoem'], 5); ?></td>
                                                        <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?>
                                                            <td class="text-center"><a href="javascript: 
                                                                                       Swal.fire({
                                                                                       title: 'Deseja realmente excluir?',
                                                                                       text: 'Se você excluir a venda os produtos não serão restituídos, e poderá haver descontos nos ganhos mensais, anuais, totais e na receita total do cliente. Selecione Excluir abaixo se você realmente deseja excluir a venda para <?php echo $row['nome_cliente']; ?> no valor de R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?>.',
                                                                                       icon: 'question',
                                                                                       showCancelButton: true,
                                                                                       confirmButtonColor: '#d33',
                                                                                       cancelButtonText: 'Cancelar',
                                                                                       confirmButtonText: 'Excluir',
                                                                                       reverseButtons: true
                                                                                       }).then((result) => {
                                                                                       if (result.value) {
                                                                                       window.location = 'del_venda.php?num_venda=<?php echo $row['num_venda']; ?>';
                                                                                       }
                                                                                       })"><button class="btn-sm btn-circle btn-danger semborda"><i class="fas fa-trash"></i></button></a>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>   
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Davi Monteiro 2020</span>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
            <script src="../../vendor/jquery/jquery.min.js"></script>
            <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="../../js/sb-admin-2.min.js"></script>
            <script src="../../js/sweet/sweetalert2.all.min.js"></script>
            <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="../../js/demo/datatables-demo.js"></script>

            <script>
                $(document).ready(function() {
                $('#traduzir').DataTable( {
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
                } );
                } );
            </script>
        </body>
    </html>
<?php } ?>