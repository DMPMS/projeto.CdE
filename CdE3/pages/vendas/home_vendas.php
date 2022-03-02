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
    $sqlAtualizacao = "SELECT * FROM atualizacao_atualizacoes WHERE tipo = 'Usuário' AND ativo = 0 ORDER BY id DESC";
    $sqlUsuario = "SELECT * FROM usuario_usuarios WHERE tipo = 'Cliente' AND ativo = 0 ORDER BY id DESC LIMIT 5";

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($data['MarcarComoLidas']) == 'MarcarComoLidas') {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Marcar
        $sql = "UPDATE atualizacao_atualizacoes SET ids_vizualizados = CONCAT(ids_vizualizados, ?) WHERE ids_vizualizados NOT LIKE '%.{$_SESSION['id']}.%' AND tipo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array(".{$_SESSION['id']}.", "Usuário"));
        Database::disconnect();

        $_SESSION['MarcadasComoLidas'] = True;
        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>';
    }

    $_SESSION['grafico_novas_vendas_Vendas'] = [QtdVendasCadastradasNoMes(date('Y-m')), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-1 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-2 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-3 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-4 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-5 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-6 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-7 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-8 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-9 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-10 months'))), QtdVendasCadastradasNoMes(date('Y-m', strtotime('-11 months')))];
    $_SESSION['grafico_novas_vendas_VendasCanceladas'] = [QtdVendasCanceladasCadastradasNoMes(date('Y-m')), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-1 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-2 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-3 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-4 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-5 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-6 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-7 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-8 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-9 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-10 months'))), QtdVendasCanceladasCadastradasNoMes(date('Y-m', strtotime('-11 months')))];
?>
    <html class="no-js" lang="en">

    <head>
        <title>Página Inicial - Usuários</title>
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
                        text: 'As novas atualizações de <b>Usuários</b> foram marcadas como lidas.',
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
                                        <a href="../../home.php"><i class="ik ik-home bg-orange"></i></a>
                                    </div>
                                    <div class="page-header-title">
                                        <i class="ik ik-shopping-cart bg-orange"></i>
                                    </div>
                                    <nav class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="../../home.php">Página Inicial</a>
                                            </li>
                                            <li class="breadcrumb-item active">Vendas</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-yellow shadow-lg">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="mb-5 text-white">Receita Diária</h6>
                                                <h3 class="mb-0 fw-700 text-white">R$ 1.783,00</h3>
                                            </div>
                                        </div>
                                        <p class="mb-0 text-white"><span class="label label-danger mr-10">-19%</span>Ontem</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-yellow shadow-lg">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="mb-5 text-white">Receita Semanal</h6>
                                                <h3 class="mb-0 fw-700 text-white">R$ 5.983,00</h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa fa-money-bill-alt text-red f-18"></i>
                                            </div>
                                        </div>
                                        <p class="mb-0 text-white"><span class="label label-danger mr-10">+9%</span>Semana Passada</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-yellow shadow-lg">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="mb-5 text-white">Receita Mensal</h6>
                                                <h3 class="mb-0 fw-700 text-white">R$ 17.081,00</h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa fa-money-bill-alt text-red f-18"></i>
                                            </div>
                                        </div>
                                        <p class="mb-0 text-white"><span class="label label-danger mr-10">-6%</span>Mês Passado</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-yellow shadow-lg">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="mb-5 text-white">Receita de 2021</h6>
                                                <h3 class="mb-0 fw-700 text-white">R$ 89.783,00</h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa fa-money-bill-alt text-red f-18"></i>
                                            </div>
                                        </div>
                                        <p class="mb-0 text-white"><span class="label label-danger mr-10">+32%</span>Ano Passado</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="../../home.php">
                                    <div class="widget bg-warning shadow-lg">
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
                                <a href="cad_venda_cliente.php">
                                    <div class="widget bg-warning shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Venda</h6>
                                                    <h2>Nova</h2>
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
                                <a href="list_venda.php">
                                    <div class="widget bg-warning shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Vendas</h6>
                                                    <h2><?php echo QtdVendas(); ?></h2>
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
                                <a href="list_venda_canceladas.php">
                                    <div class="widget bg-warning shadow-lg">
                                        <div class="widget-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h6>Vendas Canceladas</h6>
                                                    <h2><?php echo QtdVendasCanceladas(); ?></h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="ik ik-x-circle"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <!--Novos Clientes-->
                            <div class="col-lg-5 col-md-12">
                                <div class="card new-cust-card shadow-lg">
                                    <div class="card-header">
                                        <h3>Novas Vendas</h3>
                                    </div>
                                    <div class="card-block" style="max-height: 350px;">
                                        <?php if (QtdUsuarios() == 0) { ?>
                                            <a>
                                                <div class="align-middle mb-25">
                                                    <img src="../../img/usuarios/default-usuario.jpg" class="rounded-circle align-top mr-15" style="height: 40px; width: 40px;">
                                                    <div class="d-inline-block">
                                                        <h6>Nenhum Usuário Cadastrado</h6>
                                                        <p class="text-muted mb-0">Nenhum Usuário Cadastrado</p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php } ?>
                                        <?php foreach ($pdo->query($sqlUsuario) as $row) {
                                        ?>
                                            <a title="Dados" href="" data-toggle="modal" data-target="#Dados<?php echo $row['id']; ?>">
                                                <div class="align-middle mb-25">
                                                    <img src="../../img/usuarios/<?php echo $row['foto']; ?>" class="rounded-circle align-top mr-15" style="height: 40px; width: 40px;">
                                                    <div class="d-inline-block">
                                                        <h6><?php echo $row['nome'] ?></h6>
                                                        <p class="text-muted mb-0"><?php echo $row['tipo'] ?></p>
                                                        <span class="status text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--Modal de Dados-->
                            <?php foreach ($pdo->query($sqlUsuario) as $row) { ?>
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
                                                        <label>Compras <a href="cad_usuario.php"><i class="ik ik-arrow-right-circle text-primary"></i></a></label>
                                                        <input type="text" class="form-control" readonly="" value="1262">
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label>Lucro</label>
                                                        <input type="text" class="form-control" readonly="" value="R$ 12.000,00">
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
                            <!--/Novos Clientes-->
                            <!--Últimas Atualizações-->
                            <div class="col-lg-7 col-md-12">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        <h3>Últimas Atualizações</h3>
                                        <div class="card-header-right">
                                            <?php if (QtdAtualizacoesUsuariosNaoVizualidado() > 0) { ?>
                                                <a title="Marcar Como Lidas" href="" class="badge badge-danger" data-toggle="modal" data-target="#MarcarComoLidas">
                                                    <?php
                                                    echo QtdAtualizacoesUsuariosNaoVizualidado();
                                                    ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="card-body feeds-widget" style="overflow: auto; max-height: 350px;">
                                        <?php if (QtdAtualizacoesUsuarios() == 0) { ?>
                                            <div class="feed-item">
                                                <a>
                                                    <div class="feeds-left"><i class="ik ik-x-circle text-primary"></i></div>
                                                    <div class="feeds-body">
                                                        <h4 class="title text-primary">Nenhuma Atualização</h4>
                                                        <small>Ainda não há nenhuma atualização disponível.</small>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php } else { ?>
                                            <?php
                                            foreach ($pdo->query($sqlAtualizacao) as $row) {

                                                if (str_contains($row['ids_vizualizados'], ".{$_SESSION['id']}.")) {
                                                    $cor = "primary";
                                                } else {
                                                    $cor = "danger";
                                                }

                                                if ($row['acao'] == "Cadastrar-Cliente") {
                                            ?>
                                                    <div class="feed-item">
                                                        <a>
                                                            <div class="feeds-left"><i class="ik ik-plus-circle text-<?php echo $cor; ?>"></i></div>
                                                            <div class="feeds-body">
                                                                <h4 class="title text-<?php echo $cor; ?>">Novo(a) Cliente <small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                                <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> cadastrou <strong><?php echo NomeUsuario($row['id_usuario']); ?></strong>.</small>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } else if ($row['acao'] == "Cadastrar-Administrador") { ?>
                                                    <div class="feed-item">
                                                        <a>
                                                            <div class="feeds-left"><i class="ik ik-plus-circle text-<?php echo $cor; ?>"></i></div>
                                                            <div class="feeds-body">
                                                                <h4 class="title text-<?php echo $cor; ?>">Novo(a) Administrador(a) <small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                                <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> cadastrou <strong><?php echo NomeUsuario($row['id_usuario']); ?></strong>.</small>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } else if ($row['acao'] == "Editar-Cliente") { ?>
                                                    <div class="feed-item">
                                                        <a>
                                                            <div class="feeds-left"><i class="ik ik-edit-2 text-<?php echo $cor; ?>"></i></div>
                                                            <div class="feeds-body">
                                                                <h4 class="title text-<?php echo $cor; ?>">Cliente Editado(a)<small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                                <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> editou os dados de <strong><?php echo NomeUsuario($row['id_usuario']); ?></strong>.</small>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } else if ($row['acao'] == "Editar-Administrador") { ?>
                                                    <div class="feed-item">
                                                        <a>
                                                            <div class="feeds-left"><i class="ik ik-edit-2 text-<?php echo $cor; ?>"></i></div>
                                                            <div class="feeds-body">
                                                                <h4 class="title text-<?php echo $cor; ?>">Administrador(a) Editado(a)<small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                                <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> editou os dados de <strong><?php echo NomeUsuario($row['id_usuario']); ?></strong>.</small>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } else if ($row['acao'] == "Excluir-Cliente") { ?>
                                                    <div class="feed-item">
                                                        <a>
                                                            <div class="feeds-left"><i class="ik ik-trash-2 text-<?php echo $cor; ?>"></i></div>
                                                            <div class="feeds-body">
                                                                <h4 class="title text-<?php echo $cor; ?>">Cliente Excluído(a)<small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                                <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> excluiu <strong><?php echo NomeUsuario($row['id_usuario']); ?></strong>.</small>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } else if ($row['acao'] == "Excluir-Administrador") { ?>
                                                    <div class="feed-item">
                                                        <a>
                                                            <div class="feeds-left"><i class="ik ik-trash-2 text-<?php echo $cor; ?>"></i></div>
                                                            <div class="feeds-body">
                                                                <h4 class="title text-<?php echo $cor; ?>">Administrador(a) Excluído(a)<small class="float-right text-muted"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?></small></h4>
                                                                <small><strong><?php echo NomeUsuario($row['id_responsavel']); ?></strong> excluiu <strong><?php echo NomeUsuario($row['id_usuario']); ?></strong>.</small>
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
                                                Gostaria de marcar as <b><?php echo QtdAtualizacoesUsuariosNaoVizualidado(); ?></b> novas atualizações como lidas?
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
                                        <h3>Vendas Realizadas Por Mês</h3>
                                    </div>
                                    <div class="card-block text-center">
                                        <div id="grafico_novas_vendas" class="chart-shadow" style="height:400px"></div>
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