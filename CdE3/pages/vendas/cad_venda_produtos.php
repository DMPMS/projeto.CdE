<!doctype html>
<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "../../index.php"; </script>';
} else if (isset($_SESSION['Venda-idCliente']) == '') {
    $_SESSION['Venda-SelecionarCliente'] = True;
    echo '<script> window.location = "cad_venda_cliente.php"; </script>';
} else {
    $pdo = Database::connect();
    $sql = "SELECT * FROM produto_produtos WHERE ativo = 0";

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['cadastrar']) == 'cadastrar') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Cadastrar venda geral
        $sql = "INSERT INTO venda_vendas (id_cliente,id_responsavel,tipo_desconto,desconto,subtrair_estoque,atualizacoes_produtos,criadoem) values(?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);

        //Verificando qual é o desconto
        if ($data['HabilitarDesconto'] == "EmPorcentagem") {
            $desconto = $data['DescontoEmPorcentagem'];

            if ($desconto > 100) {
                $desconto = 100;
            } else if ($desconto < 0) {
                $desconto = 0;
            }
        } else if ($data['HabilitarDesconto'] == "EmReais") {
            $desconto = $data['DescontoEmReais'];

            //Ajeitando preço
            $desconto = str_replace(".", "", $desconto);
            $desconto = str_replace(",", ".", $desconto);

            if ($desconto > $_SESSION['Venda-TotalProdutos']) {
                $desconto = $_SESSION['Venda-TotalProdutos'];
            } else if ($desconto < 0) {
                $desconto = 0;
            }
        } else if ($data['HabilitarDesconto'] == "SemDesconto") {
            $desconto = 0;
        }

        //Verificando se subtraiu do estoque
        if (isset($_POST["SubtrairEstoque"])) {
            $subtrair = "Sim";
        } else {
            $subtrair = "Não";
        }

        //Verificando se teve atualizações para Produtos
        if (!isset($_POST["AtualizacoesProdutos"])) {
            $atualizacoes = "Sim";
        } else {
            $atualizacoes = "Não";
        }

        $q->execute(array($_SESSION['Venda-idCliente'], $_SESSION['id'], $data['HabilitarDesconto'], $desconto, $subtrair, $atualizacoes, date('Y-m-d H:i:s')));

        //Cadastrar produtos da venda
        $sql = "INSERT INTO venda_produtos (id_venda,id_produto,preco,qtd,id_cliente,id_responsavel,criadoem) values(?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);

        foreach ($_SESSION['Venda-idProdutos'] as $produto) {
            $q->execute(array(UltimoIdVenda(), $produto, PrecoProduto($produto), $_SESSION['Venda-QTDProdutos'][array_search($produto, $_SESSION['Venda-idProdutos'])], $_SESSION['Venda-idCliente'], $_SESSION['id'], date('Y-m-d H:i:s')));
        }

        //Subtrair do Estoque e cadastrar atualizações em produtos
        if (isset($_POST["SubtrairEstoque"])) {
            foreach ($_SESSION['Venda-idProdutos'] as $produto) {
                if (!isset($_POST["AtualizacoesProdutos"])) {
                    $sql = "INSERT INTO atualizacao_atualizacoes (tipo, acao, id_produto, unidades_antigo, unidades_novo, id_responsavel, ids_vizualizados, criadoem) values(?,?,?,?,?,?,?,?)";
                    $q = $pdo->prepare($sql);
                    $q->execute(array("Produto", "Editar-Produto-Estoque-PósVenda", $produto, UnidadesDoProduto($produto), UnidadesDoProduto($produto) - $_SESSION['Venda-QTDProdutos'][array_search($produto, $_SESSION['Venda-idProdutos'])], $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));
                }
                AlterarUnidadesDoProduto($produto, UnidadesDoProduto($produto) - $_SESSION['Venda-QTDProdutos'][array_search($produto, $_SESSION['Venda-idProdutos'])]);
            }
        }

        //Atualização
        $sql = "INSERT INTO atualizacao_atualizacoes (tipo, acao, id_venda, total_venda, id_responsavel, ids_vizualizados, criadoem) values(?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array("Venda", "Cadastrar-Venda", UltimoIdVenda(), TotalDaVendaComDesconto(UltimoIdVenda()), $_SESSION['id'], ".{$_SESSION['id']}.", date('Y-m-d H:i:s')));

        unset($_SESSION['Venda-idCliente']);
        unset($_SESSION['Venda-idProdutos']);
        unset($_SESSION['Venda-QTDProdutos']);
        unset($_SESSION['Venda-TotalProdutos']);

        $_SESSION['Venda-Cadastrada'] = True;

        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location = "list_venda.php");
                }
            </script>';

        Database::disconnect();
    }
    if (isset($data['previsualizar']) == 'previsualizar') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Recebo os produtos e suas respectivas quantidades
        if (isset($_POST["checkbox"])) {
            $produtos = array();
            $QTDprodutos = array();
            $Totalprodutos = 0;

            foreach ($_POST["checkbox"] as $produto) {
                array_push($produtos, $produto);
                array_push($QTDprodutos, $data[$produto]);
                $Totalprodutos += $data[$produto] * PrecoProduto($produto);
            }

            $_SESSION['Venda-idProdutos'] = $produtos;
            $_SESSION['Venda-QTDProdutos'] = $QTDprodutos;
            $_SESSION['Venda-TotalProdutos'] = $Totalprodutos;
        } else {
            $_SESSION['Venda-NenhumProduto'] = True;
        }

        $_SESSION['Venda-PreVisualizar'] = True;

        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>';

        Database::disconnect();
    }
    if (isset($data['resetar']) == 'resetar') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Apagando valor das variáveis
        unset($_SESSION['Venda-idProdutos']);
        unset($_SESSION['Venda-QTDProdutos']);
        unset($_SESSION['Venda-TotalProdutos']);

        $_SESSION['Venda-ResetarVenda'] = True;
        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>';

        Database::disconnect();
    }
?>
    <html class="no-js" lang="en">

    <head>
        <title>Nova Venda - Selecionar Produtos</title>
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
        <?php if (isset($_SESSION['SelecionarProdutos'])) { ?>
            <!--Notificação Selecionar Produtos-->
            <script>
                window.onload = function() {
                    $.toast({
                        text: 'Selecione os produtos para a venda.',
                        icon: 'info',
                        hideAfter: 5000,
                        loader: false,
                        position: 'top-right'
                    })
                }
            </script>
        <?php
            unset($_SESSION['SelecionarProdutos']);
        }
        ?>
        <?php if (isset($_SESSION['Venda-ResetarVenda'])) { ?>
            <!--Notificação Resetar Venda-->
            <script>
                window.onload = function() {
                    $.toast({
                        text: 'Venda resetada. Selecione os produtos para a venda.',
                        icon: 'success',
                        hideAfter: 5000,
                        loader: false,
                        position: 'top-right'
                    })
                }
            </script>
        <?php
            unset($_SESSION['Venda-ResetarVenda']);
        }
        ?>
        <?php if (isset($_SESSION['Venda-NenhumProduto'])) { ?>
            <!--Notificação Resetar Venda-->
            <script>
                window.onload = function() {
                    $.toast({
                        text: 'Nenhum produto selecionado. Caso deseje remover os produtos da venda atual, clique no botão <b>Resetar Venda</b>.',
                        icon: 'warning',
                        hideAfter: 5000,
                        loader: false,
                        position: 'top-right'
                    })
                }
            </script>
        <?php
            unset($_SESSION['Venda-NenhumProduto']);
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
                                        <a href="../../home.php"><i class="ik ik-home bg-orange"></i></a>
                                    </div>
                                    <div class="page-header-title">
                                        <a href="home_vendas.php"><i class="ik ik-shopping-cart bg-orange"></i></a>
                                    </div>
                                    <div class="page-header-title">
                                        <i class="ik ik-plus-circle bg-orange"></i>
                                    </div>
                                    <div class="page-header-title">
                                        <i class="ik ik-package bg-green"></i>
                                    </div>
                                    <nav class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../../home.php">Página Inicial</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="home_vendas.php">Vendas</a>
                                            </li>
                                            <li class="breadcrumb-item active">Nova Venda - <?php echo NomeUsuario($_SESSION['Venda-idCliente']); ?> - Selecionar Produtos</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="dt-responsive">
                                    <form method="POST" enctype="multipart/form-data">
                                        <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#AlterarCliente">Alterar Cliente</button>
                                        <!--Modal de Alterar Cliente-->
                                        <div class="modal fade" id="AlterarCliente" tabindex="-1" role="dialog" aria-labelledby="AlterarCliente" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterLabel">Alterar Cliente</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Ao alterar o cliente sem pré-vizualizar os detahes da venda, você perderá os novos produtos selecionados e suas respectivas quantidades. Deseja realmente alterar o cliente agora?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                        <a href="cad_venda_cliente.php" type="button" class="btn btn-primary">Sim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/Modal de Alterar Cliente-->
                                        <button name="previsualizar" type="submit" class="btn btn-primary mr-2" value="previsualizar">Pré-Visualizar Venda</button>
                                        <?php if (isset($_SESSION['Venda-idProdutos']) && isset($_SESSION['Venda-QTDProdutos']) && isset($_SESSION['Venda-TotalProdutos'])) { ?>
                                            <!--Modal de Pré-vizualização-->
                                            <div class="modal fade" id="PreVisualizar">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detalhes da Venda</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="form-group col-lg-4">
                                                                    <label>Nome do Cliente</label>
                                                                    <input type="text" class="form-control" readonly="" value="<?php echo NomeUsuario($_SESSION['Venda-idCliente']); ?>">
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label>Responsável pela Venda</label>
                                                                    <input type="text" class="form-control" readonly="" value="<?php echo NomeUsuario($_SESSION['id']); ?>">
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label>Data de Atualização da Venda <i title="A data da venda aumentará conforme a demora da confiirmação da venda." class="ik ik-info text-primary"></i></label>
                                                                    <input type="text" class="form-control" readonly="" value="<?php echo date('d/m/Y \à\s H:i:s'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-lg-3">
                                                                    <label>Total</label>
                                                                    <input type="text" class="form-control" readonly="" value="R$ <?php echo number_format($_SESSION['Venda-TotalProdutos'], 2, ',', '.'); ?>">
                                                                </div>
                                                                <div class="form-group col-lg-3">
                                                                    <label>Aplicar Desconto (em %)</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <input name="HabilitarDesconto" id="HabilitarDescontoEmPorcentagem" type="radio" onchange="habilitar()" value="EmPorcentagem">
                                                                            </div>
                                                                        </div>
                                                                        <input name="DescontoEmPorcentagem" id="DescontoEmPorcentagem" type="number" class="form-control" step="0.001" disabled="" oninput="calcular()">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-lg-3">
                                                                    <label>Aplicar Desconto (em reais)</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <input name="HabilitarDesconto" id="HabilitarDescontoEmReais" type="radio" onchange="habilitar()" value="EmReais">
                                                                            </div>
                                                                        </div>
                                                                        <input name="DescontoEmReais" id="DescontoEmReais" type="text" class="preco form-control" disabled="" onkeyup="calcular()">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-lg-3">
                                                                    <label>Sem Desconto</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <input name="HabilitarDesconto" id="HabilitarSemDesconto" type="radio" checked="true" onchange="habilitar()" value="SemDesconto">
                                                                            </div>
                                                                        </div>
                                                                        <input name="SemDesconto" id="SemDesconto" type="text" class="form-control" readonly="" onblur="calcular()" value="Sem Desconto">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-lg-3">
                                                                    <label>Total Com Desconto</label>
                                                                    <input id="TotalComDesconto" type="text" class="form-control" readonly="" value="R$ <?php echo number_format($_SESSION['Venda-TotalProdutos'], 2, ',', '.'); ?>">
                                                                </div>
                                                                <div class="form-group col-lg-3">
                                                                    <label>Subtrair do Estoque</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <input name="SubtrairEstoque" id="SubtrairEstoque" type="checkbox" checked="" onchange="atualizacoes()">
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" readonly="" value="Subtrair">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-lg-4">
                                                                    <label>Atualizações de Estoque Alterado</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <input name="AtualizacoesProdutos" id="AtualizacoesProdutos" type="checkbox">
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" readonly="" value="Sem Atualizações">
                                                                    </div>
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
                                                                        foreach ($_SESSION['Venda-idProdutos'] as $produto) { ?>
                                                                            <tr>
                                                                                <td><img src="../../img/produtos/<?php echo $produto . ".png"; ?>" class="table-user-thumb"> <?php echo NomeProduto($produto); ?></td>
                                                                                <td>R$ <?php echo number_format(PrecoProduto($produto), 2, ',', '.'); ?></td>
                                                                                <td><?php echo $_SESSION['Venda-QTDProdutos'][array_search($produto, $_SESSION['Venda-idProdutos'])] ?></td>
                                                                                <td>R$ <?php echo number_format($_SESSION['Venda-QTDProdutos'][array_search($produto, $_SESSION['Venda-idProdutos'])] * PrecoProduto($produto), 2, ',', '.'); ?></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ConfirmarVenda">Confirmar Venda</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/Modal de Pré-vizualização-->
                                            <!--Modal de Confirmar Venda-->
                                            <div class="modal fade" id="ConfirmarVenda" tabindex="-1" role="dialog" aria-labelledby="ConfirmarVenda" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterLabel">Confirmar Venda</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Ao confirmar a venda, caso selecionado, os produtos selecionados terão seu estoque reduzido conforme sua respectiva quantidade selecionada. Você não poderá excluir esta venda por definitivo, porém, poderar <b>Cancelar a Venda</b> para o cálculo das receitas (Diária, Semanal, Mensal, Anual e Total). Ao <b>Cancelar a Venda</b>, o estoque <b>não</b> será reabastecido automaticamente. Caso deseje que seja reabastecido, essa tarefa deverá ser realizada manualmente pelo administrador. Vale lembrar que caso não confirme a venda agora, o administrador poderá voltar aqui para confirmá-la enquanto sua sessão ainda estiver ativa. Deseja realmente confirmar a venda?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                            <button name="cadastrar" type="submit" class="btn btn-primary" value="cadastrar">Sim</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/Modal de Confirmar Venda-->
                                        <?php } ?>

                                        <?php if (isset($_SESSION['Venda-idProdutos']) && isset($_SESSION['Venda-QTDProdutos']) && isset($_SESSION['Venda-TotalProdutos'])) { ?>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ResetarVenda">Resetar Venda</button>
                                            <!--Modal de Resetar Venda-->
                                            <div class="modal fade" id="ResetarVenda" tabindex="-1" role="dialog" aria-labelledby="ResetarVenda" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterLabel">Resetar Venda</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Ao resetar a venda, <b>todos</b> os produtos que estavam selecionados e suas respectivas quantidades serão removidos, tendo que selecionar cada produto novamente. Deseja realmente resetar a venda?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                            <button name="resetar" type="submit" class="btn btn-danger" value="resetar">Sim</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/Modal de Resetar Venda-->
                                        <?php } ?>

                                        <br><br>
                                        <table id="traduzir" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Selecionar</th>
                                                    <th>Nome</th>
                                                    <th>Preço</th>
                                                    <th>Unidades</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pdo->query($sql) as $row) { ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php if ($row['unidades'] > 0) { ?>
                                                                <input name="checkbox[]" type="checkbox" value="<?php echo $row['id']; ?>" <?php if (isset($_SESSION['Venda-idProdutos'])) {
                                                                                                                                                if (in_array($row['id'], $_SESSION['Venda-idProdutos'])) { ?> checked="" <?php }
                                                                                                                                                                                                                    } ?> style="vertical-align: middle;">
                                                                <input name="<?php echo $row['id']; ?>" type="number" oninput="checa(this)" onblur="valorMinimo(this)" required="" <?php if (isset($_SESSION['Venda-idProdutos'])) {
                                                                                                                                                                                        if (in_array($row['id'], $_SESSION['Venda-idProdutos'])) { ?> value="<?php echo $_SESSION['Venda-QTDProdutos'][array_search($row['id'], $_SESSION['Venda-idProdutos'])]; ?>" <?php } else { ?> value="1" <?php }
                                                                                                                                                                                                                                                                                                                                                                                            } else { ?> value="1" <?php } ?> min="1" max="<?php echo $row['unidades']; ?>" style="width: 80px; <?php if (isset($_SESSION['Venda-idProdutos'])) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if (!in_array($row['id'], $_SESSION['Venda-idProdutos'])) { ?> display: none; <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } else { ?> display: none; <?php } ?>">
                                                            <?php } else {
                                                                echo "Sem Estoque";
                                                            } ?>
                                                        </td>
                                                        <td><img src="../../img/produtos/<?php echo $row['foto']; ?>" class="table-user-thumb">
                                                            <?php echo $row['nome']; ?></td>
                                                        <td><?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                                                        <td <?php if ($row['unidades'] == 0) { ?> class="text-red" <?php } ?>><?php echo $row['unidades']; ?></td>
                                                        <td class="text-center">
                                                            <button title="Dados" type="button" class="btn btn-icon btn-primary mr-1" data-toggle="modal" data-target="#Dados<?php echo $row['id']; ?>"><i class="ik ik-eye"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Selecionar</th>
                                                    <th>Nome</th>
                                                    <th>Preço</th>
                                                    <th>Unidades</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </form>
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
                                                    <img src="../../img/produtos/<?php echo $row['foto']; ?>" class="rounded-circle" width="120px" height="120px">
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
                                                <div class="form-group col-lg-3">
                                                    <label>Unidades Vendidas <a href="cad_usuario.php"><i class="ik ik-arrow-right-circle text-primary"></i></a></label>
                                                    <input type="text" class="form-control" readonly="" value="1262">
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>Lucro</label>
                                                    <input type="text" class="form-control" readonly="" value="R$ 12.000,00">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-5">
                                                    <label>Nome</label>
                                                    <input name="nome" type="text" class="form-control" readonly="" value="<?php echo $row['nome']; ?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Código</label>
                                                    <input name="codigo" type="text" class="form-control" readonly="" value="<?php echo $row['codigo']; ?>">
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>Preço</label>
                                                    <input name="preco" type="text" class="form-control" readonly="" value="<?php echo number_format($row['preco'], 2, ',', '.'); ?>">
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>Unidades</label>
                                                    <input name="unidades" type="text" class="form-control" readonly="" value="<?php echo $row['unidades']; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-10">
                                                    <label>Tipo(s)</label>
                                                    <?php
                                                    $row['id_tipo'] = str_replace("(", "", substr($row['id_tipo'], 0, -1));
                                                    $row['id_tipo'] = explode(')', $row['id_tipo']);

                                                    $Tipos = "";
                                                    foreach ($row['id_tipo'] as $valores) {
                                                        $Tipos = $Tipos . NomeTipo(intval($valores)) . ", ";
                                                    }
                                                    ?>
                                                    <input name="id_tipo" type="text" class="form-control" readonly="" value="<?php echo substr($Tipos, 0, -2); ?>">
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
        <!--Script Da Máscara do Preço-->
        <script src="../../js/mascaradinheiro.js"></script>
        <!--Pra Notificação-->
        <script src="../../plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
        <script>
            $(document).ready(function() {
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
        <!--Limitar Números no Input de Quantidade-->
        <script>
            function checa(e) {
                const mi = +e.min;
                const ma = +e.max;
                const va = e.value;

                if (va.length) {
                    if (va < mi) {
                        e.value = mi;
                    } else if (va > ma) {
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
        <!--/Limitar Números no Input de Quantidade-->
        <!--Mostrar/Ocultar Input de Quantidade-->
        <script>
            $('input[type="checkbox"]').on('click touchstart', function() {
                if (this.checked) {
                    $(this).parent('td').find('input[type="number"]').show();
                } else {
                    $(this).parent('td').find('input[type="number"]').hide();
                }
            });
        </script>
        <!--/Mostrar/Ocultar Input de Quantidade-->
        <script>
            function atualizacoes() {
                if (document.getElementById('SubtrairEstoque').checked) {
                    document.getElementById('AtualizacoesProdutos').removeAttribute("disabled");
                } else {
                    document.getElementById('AtualizacoesProdutos').checked = false;
                    document.getElementById('AtualizacoesProdutos').setAttribute("disabled", true);
                }
            }
        </script>
        <!--Mostrar/Ocultar Input de Desconto-->
        <script>
            function habilitar() {
                if (document.getElementById('HabilitarDescontoEmPorcentagem').checked) {
                    document.getElementById('DescontoEmPorcentagem').disabled = false;
                    document.getElementById('DescontoEmPorcentagem').min = 1;
                    document.getElementById('DescontoEmPorcentagem').value = 1;
                    document.getElementById('DescontoEmPorcentagem').max = 100;

                    document.getElementById('DescontoEmReais').disabled = true;
                    document.getElementById('DescontoEmReais').value = '';
                    document.getElementById('SemDesconto').value = '';

                    document.getElementById('TotalComDesconto').value = '<?php echo "R$ " . number_format($_SESSION['Venda-TotalProdutos'] - ($_SESSION['Venda-TotalProdutos'] * 0.01), 2, ',', '.'); ?>';
                } else if (document.getElementById('HabilitarDescontoEmReais').checked) {
                    document.getElementById('DescontoEmReais').disabled = false;
                    document.getElementById('DescontoEmReais').value = '1,00';

                    document.getElementById('DescontoEmPorcentagem').disabled = true;
                    document.getElementById('DescontoEmPorcentagem').value = '';
                    document.getElementById('SemDesconto').value = '';

                    document.getElementById('TotalComDesconto').value = '<?php echo "R$ " . number_format($_SESSION['Venda-TotalProdutos'] - 1, 2, ',', '.'); ?>';
                } else if (document.getElementById('HabilitarSemDesconto').checked) {
                    document.getElementById('SemDesconto').value = 'Sem Desconto';

                    document.getElementById('DescontoEmPorcentagem').disabled = true;
                    document.getElementById('DescontoEmPorcentagem').value = '';
                    document.getElementById('DescontoEmReais').disabled = true;
                    document.getElementById('DescontoEmReais').value = '';

                    document.getElementById('TotalComDesconto').value = '<?php echo "R$ " . number_format($_SESSION['Venda-TotalProdutos'], 2, ',', '.'); ?>';
                }
            }
        </script>
        <!--/Mostrar/Ocultar Input de Desconto-->
        <!--Calcular Desconto-->
        <script>
            function calcular() {
                var total = <?php echo $_SESSION['Venda-TotalProdutos']; ?>;
                if (document.getElementById('HabilitarDescontoEmPorcentagem').checked) {
                    var desconto = parseFloat(document.getElementById('DescontoEmPorcentagem').value);

                    if (desconto > 100) {
                        desconto = 100;
                    } else if (desconto < 0) {
                        desconto = 0;
                    }

                    var TotalComDesconto = total * (1 - desconto / 100);
                } else if (document.getElementById('HabilitarDescontoEmReais').checked) {
                    var desconto = document.getElementById('DescontoEmReais').value;

                    desconto = desconto.replace(".", "");
                    desconto = desconto.replace(",", ".");

                    if (desconto > total) {
                        desconto = total;
                    } else if (desconto < 0) {
                        desconto = 0;
                    }

                    var TotalComDesconto = total - desconto;
                }

                var TotalComDesconto = TotalComDesconto.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
                document.getElementById('TotalComDesconto').value = TotalComDesconto;
            }
        </script>
        <!--/Calcular Desconto-->
        <!--Máscara do Preço-->
        <script>
            $('.preco').mask('#.##0,00', {
                reverse: true
            });
        </script>
        <!--/Máscara do Preço-->
        <?php if (isset($_SESSION['Venda-PreVisualizar']) && isset($_SESSION['Venda-idProdutos']) && isset($_SESSION['Venda-QTDProdutos']) && isset($_SESSION['Venda-TotalProdutos'])) { ?>
            <!--Carregar Modal de Pré-Vizualização-->
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#PreVisualizar').modal('show');
                });
            </script>
        <?php }
        unset($_SESSION['Venda-PreVisualizar']);
        ?>
    </body>

    </html>
<?php } ?>