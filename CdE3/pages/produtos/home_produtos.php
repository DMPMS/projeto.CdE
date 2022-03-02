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
    $sqlAtualizacao = "SELECT * FROM atualizacao_atualizacoes WHERE tipo = 'Produto' AND ativo = 0 ORDER BY id DESC";
    $sqlProduto = "SELECT * FROM produto_produtos WHERE ativo = 0 ORDER BY id DESC LIMIT 5";

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['MarcarComoLidas']) == 'MarcarComoLidas') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Marcar
        $sql = "UPDATE atualizacao_atualizacoes SET ids_vizualizados = CONCAT(ids_vizualizados, ?) WHERE ids_vizualizados NOT LIKE '%.{$_SESSION['id']}.%' AND tipo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array(".{$_SESSION['id']}.", "Produto"));
        Database::disconnect();

        $_SESSION['MarcadasComoLidas'] = True;
        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>';
    }

    $_SESSION['grafico_novos_produtos_Produtos'] = [QtdProdutosCadastradosNoMes(date('Y-m')), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-1 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-2 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-3 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-4 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-5 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-6 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-7 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-8 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-9 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-10 months'))), QtdProdutosCadastradosNoMes(date('Y-m', strtotime('-11 months')))];
    $_SESSION['grafico_novos_produtos_Tipos'] = [QtdTiposCadastradosNoMes(date('Y-m')), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-1 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-2 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-3 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-4 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-5 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-6 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-7 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-8 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-9 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-10 months'))), QtdTiposCadastradosNoMes(date('Y-m', strtotime('-11 months')))];
?>
    <html class="no-js" lang="en">

    <head>
        <title>Página Inicial - Produtos</title>
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
        <!--Meus Scripts-->
        <?php include_once '../../meus_scripts.php'; ?>
        <?php if (isset($_SESSION['MarcadasComoLidas'])) { ?>
            <!--Notificação Marcadas Como Lidas-->
            <script>
                window.onload = function() {
                    $.toast({
                        text: 'As novas atualizações de <b>Produtos</b> foram marcadas como lidas.',
                        icon: 'success',
                        hideAfter: 5000,
                        loader: false,
                        position: 'top-right'
                    })
                }
            </script>
        <?php
            unset($_SESSION['MarcadasComoLidas']);
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
                                        <a href="../../home.php"><i class="ik ik-home bg-green"></i></a>
                                    </div>
                                    <div class="page-header-title">
                                        <i class="ik ik-package bg-green"></i>
                                    </div>
                                    <nav class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../../home.php">Página Inicial</a>
                                            </li>
                                            <li class="breadcrumb-item active">Produtos</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="../../home.php">
                                    <div class="widget bg-success shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Voltar</h6>
                                                    <h2>Voltar</h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-corner-up-left"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="cad_produto.php">
                                    <div class="widget bg-success shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Produto</h6>
                                                    <h2>Novo</h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-plus-circle"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="list_produto.php">
                                    <div class="widget bg-success shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Produtos</h6>
                                                    <h2><?php echo QtdProdutos(); ?></h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-list"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="cad_tipo.php">
                                    <div class="widget bg-success shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Tipo</h6>
                                                    <h2>Novo</h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-plus-circle"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="list_tipo.php">
                                    <div class="widget bg-success shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Tipos</h6>
                                                    <h2><?php echo QtdTipos(); ?></h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-server"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                            if (QtdProdutosSemEstoque() > 0) {
                                $sqlSemEstoque = "SELECT * FROM produto_produtos WHERE unidades = 0 AND ativo = 0";
                            ?>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <a href="" data-toggle="modal" data-target="#SemEstoque">
                                        <div class="widget bg-warning shadow-lg">
                                            <div class="widget-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="state">
                                                        <h6>Produtos sem Estoque</h6>
                                                        <h2><?php echo QtdProdutosSemEstoque(); ?></h2>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ik ik-eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!--Modal de Estoque-->
                                <div class="modal fade" id="SemEstoque">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Produtos sem Estoque</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Nome</th>
                                                            <th>Tipo</th>
                                                            <th>Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pdo->query($sqlSemEstoque) as $row) { ?>
                                                            <tr>
                                                                <td><img src="../../img/produtos/<?php echo $row['foto']; ?>" class="table-user-thumb shadow-lg">
                                                                    <?php echo $row['nome']; ?></td>
                                                                <td>
                                                                    <?php
                                                                    $row['id_tipo'] = str_replace("(", "", substr($row['id_tipo'], 0, -1));
                                                                    $row['id_tipo'] = explode(')', $row['id_tipo']);

                                                                    $Tipos = "";
                                                                    foreach ($row['id_tipo'] as $valores) {
                                                                        $Tipos = $Tipos . NomeTipo(intval($valores)) . ", ";
                                                                    }
                                                                    echo substr($Tipos, 0, -2);
                                                                    ?>
                                                                </td>
                                                                <td class="text-center"><a title="Editar" href="edit_produto.php?id=<?php echo $row['id']; ?>" class="btn btn-icon btn-warning mr-1"><i class="ik ik-edit-2"></i></a></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/Modal de Estoque-->
                        </div>
                    <?php } ?>
                    </div>
                    <div class="row clearfix">
                        <!--Novos Produtos-->
                        <div class="col-lg-5 col-md-12">
                            <div class="card new-cust-card shadow-lg">
                                <div class="card-header">
                                    <h3>Novos Produtos</h3>
                                </div>
                                <div class="card-block" style="max-height: 350px;">
                                    <?php if (QtdProdutos() == 0) { ?>
                                        <a>
                                            <div class="align-middle mb-25">
                                                <img src="../../img/produtos/default-produto.jpg" class="rounded-circle align-top mr-15" style="height: 40px; width: 40px;">
                                                <div class="d-inline-block">
                                                    <h6>Nenhum Produto Cadastrado</h6>
                                                    <p class="text-muted mb-0">Nenhum Produto Cadastrado</p>
                                                </div>
                                            </div>
                                        </a>
                                    <?php } ?>
                                    <?php foreach ($pdo->query($sqlProduto) as $row) {
                                    ?>
                                        <a title="Dados" href="" data-toggle="modal" data-target="#Dados<?php echo $row['id']; ?>">
                                            <div class="align-middle mb-25">
                                                <img src="../../img/produtos/<?php echo $row['foto']; ?>" class="rounded-circle align-top mr-15" style="height: 40px; width: 40px;">
                                                <div class="d-inline-block">
                                                    <h6><?php echo $row['nome'] ?></h6>
                                                    <?php
                                                    $row['id_tipo'] = str_replace("(", "", substr($row['id_tipo'], 0, -1));
                                                    $row['id_tipo'] = explode(')', $row['id_tipo']);

                                                    $Tipos = "";
                                                    foreach ($row['id_tipo'] as $valores) {
                                                        $Tipos = $Tipos . NomeTipo(intval($valores)) . ", ";
                                                    }
                                                    ?>
                                                    <p class="text-muted mb-0"><?php echo substr($Tipos, 0, -2); ?></p>
                                                    <span class="status text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!--Modal de Dados-->
                        <?php foreach ($pdo->query($sqlProduto) as $row) { ?>
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
                        <!--/Novos Produtos-->
                        <!--Últimas Atualizações-->
                        <div class="col-lg-7 col-md-12">
                            <div class="card shadow-lg">
                                <div class="card-header">
                                    <h3>Últimas Atualizações</h3>
                                    <div class="card-header-right">
                                        <?php if (QtdAtualizacoesProdutosNaoVizualidado() > 0) { ?>
                                            <a title="Marcar Como Lidas" href="" class="badge badge-danger" data-toggle="modal" data-target="#MarcarComoLidas">
                                                <?php
                                                echo QtdAtualizacoesProdutosNaoVizualidado();
                                                ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-body feeds-widget" style="overflow: auto; max-height: 350px;">
                                    <?php if (QtdAtualizacoesProdutos() == 0) { ?>
                                        <div class="feed-item">
                                            <a>
                                                <div class="feeds-left"><i class="ik ik-x-circle text-success"></i></div>
                                                <div class="feeds-body">
                                                    <h4 class="title text-success">Nenhuma Atualização</h4>
                                                    <small>Ainda não há nenhuma atualização disponível.</small>
                                                </div>
                                            </a>
                                        </div>
                                    <?php } else { ?>
                                        <?php
                                        foreach ($pdo->query($sqlAtualizacao) as $row) {

                                            if (str_contains($row['ids_vizualizados'], ".{$_SESSION['id']}.")) {
                                                $cor = "success";
                                            } else {
                                                $cor = "danger";
                                            }

                                            if ($row['acao'] == "Cadastrar-Produto") {
                                        ?>
                                                <div class="feed-item">
                                                    <a>
                                                        <div class="feeds-left"><i class="ik ik-plus-circle text-<?php echo $cor; ?>"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-<?php echo $cor; ?>">Novo Produto <small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                            <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> cadastrou <strong><?php echo NomeProduto($row['id_produto']); ?></strong>.</small>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } else if ($row['acao'] == "Cadastrar-Tipo") { ?>
                                                <div class="feed-item">
                                                    <a>
                                                        <div class="feeds-left"><i class="ik ik-plus-circle text-<?php echo $cor; ?>"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-<?php echo $cor; ?>">Novo Tipo <small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                            <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> cadastrou <strong><?php echo NomeTipo($row['id_tipo']); ?></strong>.</small>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } else if ($row['acao'] == "Editar-Produto") { ?>
                                                <div class="feed-item">
                                                    <a>
                                                        <div class="feeds-left"><i class="ik ik-edit-2 text-<?php echo $cor; ?>"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-<?php echo $cor; ?>">Produto Editado<small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                            <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> editou os dados de <strong><?php echo NomeProduto($row['id_produto']); ?></strong>.</small>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } else if ($row['acao'] == "Editar-Produto-Estoque") { ?>
                                                <div class="feed-item">
                                                    <a>
                                                        <div class="feeds-left"><i class="ik ik-edit-2 text-<?php echo $cor; ?>"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-<?php echo $cor; ?>">Unidades Editadas<small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                            <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> editou as unidades de <strong><?php echo NomeProduto($row['id_produto']); ?></strong> de <strong><?php echo $row['unidades_antigo']; ?></strong> para <strong><?php echo $row['unidades_novo']; ?></strong>.</small>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } else if ($row['acao'] == "Editar-Tipo") { ?>
                                                <div class="feed-item">
                                                    <a>
                                                        <div class="feeds-left"><i class="ik ik-edit-2 text-<?php echo $cor; ?>"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-<?php echo $cor; ?>">Tipo Editado<small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                            <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> editou os dados de <strong><?php echo NomeTipo($row['id_tipo']); ?></strong>.</small>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } else if ($row['acao'] == "Excluir-Produto") { ?>
                                                <div class="feed-item">
                                                    <a>
                                                        <div class="feeds-left"><i class="ik ik-trash-2 text-<?php echo $cor; ?>"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-<?php echo $cor; ?>">Produto Excluído<small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                            <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> excluiu <strong><?php echo NomeProduto($row['id_produto']); ?></strong>.</small>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } else if ($row['acao'] == "Excluir-Tipo") { ?>
                                                <div class="feed-item">
                                                    <a>
                                                        <div class="feeds-left"><i class="ik ik-trash-2 text-<?php echo $cor; ?>"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-<?php echo $cor; ?>">Tipo Excluído<small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                            <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> excluiu <strong><?php echo NomeTipo($row['id_tipo']); ?></strong>.</small>
                                                        </div>
                                                    </a>
                                                </div>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <!--Marcar como Lidas-->
                            <div class="modal fade" id="MarcarComoLidas" tabindex="-1" role="dialog" aria-labelledby="MarcarComoLidas" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterLabel">Marcar como lidas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            Gostaria de marcar as <b><?php echo QtdAtualizacoesProdutosNaoVizualidado(); ?></b> novas atualizações como lidas?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                            <form method="POST" enctype="multipart/form-data">
                                                <button name="MarcarComoLidas" type="submit" class="btn btn-primary" value="MarcarComoLidas">Sim</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Marcar como Lidas-->
                        </div>
                        <!--/Últimas Atualizações-->
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-xl-12">
                            <div class="card shadow-lg">
                                <div class="card-header">
                                    <h3>Produtos Cadastrados Por Mês</h3>
                                </div>
                                <div class="card-block text-center">
                                    <div id="grafico_novos_produtos" class="chart-shadow" style="height:400px"></div>
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
        <!--Gráficos-->
        <script src="../../plugins/amcharts/amcharts.js"></script>
        <script src="../../plugins/amcharts/gauge.js"></script>
        <script src="../../plugins/amcharts/serial.js"></script>
        <script src="../../plugins/amcharts/themes/light.js"></script>
        <script src="../../plugins/amcharts/pie.js"></script>
        <script src="../../js/graficos.php"></script>

    </body>

    </html>
<?php } ?>