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
    $idCliente = $_GET['idCliente'];

    $pdo = Database::connect();
    $sql = "SELECT * FROM cde_produto";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['buttoncadastrar']) == 'Cadastrar') {
        //Pego id dos produtos
        if (isset($_POST["checkbox"])) {
            $checkboxN = null;
            foreach ($_POST["checkbox"] as $checkbox) {
                $checkboxN = $checkboxN . $checkbox;
            }
            $idProdutos = substr($checkboxN, 0, -1);

            //Pego quantidade dos produtos
            $sqlQTD = "SELECT * FROM cde_produto WHERE id IN (" . $idProdutos . ")";
            $QTDProdutos = null;
            foreach ($pdo->query($sqlQTD) as $row) {
                $id = $row['id'];
                $QTDProdutos = $QTDProdutos . $data[$id] . ",";
            }
            $QTDProdutos = substr($QTDProdutos, 0, -1);

            //Insiro vazio para pegar o último num_venda
            $sqlVendaDetalhe = "INSERT INTO cde_venda_detalhe (criadoem) values(?)";
            $qVendaDetalhe = $pdo->prepare($sqlVendaDetalhe);
            $qVendaDetalhe->execute(array($DataVenda));

            $NumProximaVenda = NumProximaVenda();

            //Dados para o for
            $Num_idProdutos = explode(",", $idProdutos);
            $Num_QTDProdutos = explode(",", $QTDProdutos);

            $Repeticoes = count($Num_idProdutos);
            $valor = 0;
            for ($i = 0; $i < $Repeticoes; $i++) {
                //Pego dados do produto
                $sqlProduto = "SELECT * FROM cde_produto WHERE id = $Num_idProdutos[$i]";
                $recordsProduto = $pdo->prepare($sqlProduto);
                $recordsProduto->execute();
                $resultProduto = $recordsProduto->fetch(PDO::FETCH_ASSOC);
                //Insiro na cde_venda
                $sqlVenda = "INSERT INTO cde_venda (num_venda,id_produto,nome_produto,preco_produto,qtd_produto,id_cliente) values(?,?,?,?,?,?)";
                $qVenda = $pdo->prepare($sqlVenda);
                $qVenda->execute(array($NumProximaVenda, $Num_idProdutos[$i], $resultProduto['nome'], $resultProduto['preco'], $Num_QTDProdutos[$i], $idCliente));
                //Valor para o cde_venda_detalhe
                $valor = $valor + ($resultProduto['preco'] * $Num_QTDProdutos[$i]);
                //Retiro do estoque
                $sqlEstoque = "UPDATE cde_produto SET qtdrestante = ? WHERE id = ?";
                $qEstoque = $pdo->prepare($sqlEstoque);
                $qEstoque->execute(array($resultProduto['qtdrestante'] - $Num_QTDProdutos[$i], $Num_idProdutos[$i]));
            }
            //Cadastro final do cde_venda_detalhe 
            $sqlVendaDetalhe = "UPDATE cde_venda_detalhe SET id_cliente = ?,nome_cliente = ?,valor = ?,criadoem = ?,id_responsavel = ?,nome_responsavel = ? WHERE num_venda = ?";
            $qVendaDetalhe = $pdo->prepare($sqlVendaDetalhe);
            $qVendaDetalhe->execute(array($idCliente, NomeCliente($idCliente), $valor, $DataVenda, $_SESSION['id'], $_SESSION['nome'], $NumProximaVenda));

            //notificação de venda realizada
            $sql = "INSERT INTO cde_notificacao (tipo,id_registro,visualizado,criadoem,valor,id_responsavel,nome_responsavel,tipo_responsavel) values(?,?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array("Venda", $NumProximaVenda, "." . $_SESSION['id'] . ".", date('Y-m-d H:i:s'), $valor, $_SESSION['id'], $_SESSION['nome'], $_SESSION['tipo']));


            echo '<script>
            window.location = "sweet_venda_produto.php"
                 </script>';
        }
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
            <title>Selecionar Produto(s)</title>
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
            <style type="text/css">
                input[type="number"] {
                    display: none;
                }
            </style>
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
                        <form method="post" enctype="multipart/form-data">
                            <div class="container-fluid">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <a href="list_cliente_compras.php?idCliente=<?php echo $idCliente; ?>" class="btn btn-user btn-primary">
                                            <i class="fas fa-reply"></i> Voltar
                                        </a>
                                        <button name="buttoncadastrar" value="Cadastrar" class="btn btn-user btn-success" id="Habilitar" type="submit" onclick="Checar()" disabled> <i class="fas fa-check-circle"></i> Confirmar</button>
                                        <span>Total: </span><input disabled="" id="total" style="width: 120px;">
                                        <h1 class="h2 mb-0 text-gray-800" style="float: right">Selecionar Produto(s)</h1>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="traduzir" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Qtd.</th>
                                                        <th>Produto</th>
                                                        <th>Tipo</th>
                                                        <th>Preço</th>
                                                        <th>Estoque</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Qtd.</th>
                                                        <th>Produto</th>
                                                        <th>Tipo</th>
                                                        <th>Preço</th>
                                                        <th>Estoque</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                    foreach ($pdo->query($sql) as $row) {
                                                        ?>
                                                        <tr>
                                                    <script>
                                                        function checa(e){
                                                        const mi = +e.min;
                                                        const ma = +e.max;
                                                        const va = e.value;

                                                        if(va.length) {
                                                        if(va < mi){
                                                        e.value = mi;
                                                        }else if(va > ma){
                                                        e.value = ma;
                                                        }
                                                        }
                                                        }

                                                        function valorMinimo(e) {
                                                        if (!e.value.length) {
                                                        e.value = e.min;
                                                        }
                                                        }
                                                    </script>

                                                    <td style="vertical-align:middle" class="text-center"> 
                                                        <input <?php if ($row['qtdrestante'] == 0) { ?> disabled="" <?php } ?>type="checkbox" name="checkbox[]" value="<?php echo $row['id'] . ","; ?>"> 
                                                        <input type="number" oninput="checa(this)" onblur="valorMinimo(this)" name="<?php echo $row['id']; ?>" <?php if ($row['qtdrestante'] != 0) { ?> value="1" min="1" required="" <?php } ?> max="<?php echo $row['qtdrestante']; ?>" style="width: 50px" > 
                                                        <input hidden="" disabled="" type="number" class="preco" value="<?php echo $row['preco']; ?>"></td>
                                                    <td style="vertical-align:middle"><a href="javascript:window.open('../produtos/info_produto.php?id=<?php echo $row['id']; ?>', '_blank');"  style="vertical-align:middle" class="semsublinhar"><button name="buttoncadastrar" type="button" class="btn-sm btn-circle btn-info semborda"><i class="fas fa-info-circle"></i></button></a> <a href="javascript:window.open('../produtos/info_produto.php?id=<?php echo $row['id']; ?>', '_blank');" style="vertical-align:middle" class="semsublinhar"><?php echo $row['nome']; ?></a></td>
                                                    <td style="vertical-align:middle"><?php
                                                        $idTipo = $row['id_tipo'];
                                                        $sqlTipo = "SELECT COUNT(*) as total FROM cde_produto_tipo WHERE id = $idTipo";
                                                        $recordsTipo = $pdo->prepare($sqlTipo);
                                                        $recordsTipo->execute();
                                                        $resultTipo = $recordsTipo->fetch(PDO::FETCH_ASSOC);

                                                        if ($resultTipo['total'] == 0) {
                                                            echo "Nenhum";
                                                        } else if ($row['id_tipo'] == 0) {
                                                            echo "Nenhum";
                                                        } else {
                                                            $queryTipo = "SELECT * from cde_produto_tipo";
                                                            $dataTipo = mysqli_query($dbc, $queryTipo);
                                                            while ($Tiponome = mysqli_fetch_array($dataTipo)):
                                                                if ($Tiponome['id'] == $row['id_tipo']):
                                                                    echo $Tiponome['nome'];
                                                                endif;
                                                            endwhile;
                                                        }
                                                        ?></td>
                                                    <td style="vertical-align:middle">R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                                                    <td style="vertical-align:middle"><?php
                                                        if ($row['qtdrestante'] > 0) {
                                                            echo $row['qtdrestante'];
                                                        } else {
                                                            echo "Sem Estoque";
                                                        }
                                                        ?></td>
                                                    </tr>
                                                <?php } ?>   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div></form>
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
            <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

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

            <script>
                var Checar = document.getElementsByName("checkbox[]");
                var numMarcados = Checar.length;
                var Botao = document.getElementById("Habilitar");
                for(var x = 0; x < numMarcados; x++){
                Checar[x].onclick = function(){
                var cont = document.querySelectorAll("input[name='checkbox[]']:checked").length;
                Botao.disabled = cont ? false : true;
                }
                }
            </script>
            <script>
                $('input').change(function () {
                var total = 0;
                $('input[type=checkbox]:checked').each(function () {
                var qtde = $(this).next("input").val();
                var preco = $(this).next("input").next(".preco").val();
                total += Number(qtde) * Number(preco);
                });
                $('#total').val(total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
                });
            </script>
            <script>
                $('input[type="checkbox"]').on('click touchstart', function() {
                if (this.checked) {
                $(this).parent('td').find('input[type="number"]').show(); 
                } else {
                $(this).parent('td').find('input[type="number"]').hide();
                }
                });
            </script>
        </body>
    </html>
<?php } ?>