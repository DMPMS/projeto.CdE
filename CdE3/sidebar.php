<?php
if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "index.php"; </script>';
} else { ?>
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="home.php">
                <div class="logo-img">
                    <img src="ico.png" class="header-brand-img" alt="lavalite" style="height: 30px; width: 30px;">
                </div>
                <span class="text">CdE3</span>
            </a>
            <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
            <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
        </div>
        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">
                    <div class="nav-lavel text-center p-3">
                        <div class="mb-2">
                            <img src="img/usuarios/<?php echo $_SESSION['foto']; ?>" class="header-brand-img rounded-circle" alt="lavalite" style="height: 80px; width: 80px;">
                        </div>
                        <div class="">
                            <strong class="text-white"><?php echo $_SESSION['nome']; ?></strong>
                        </div>
                        <div class="">
                            <strong class="text-primary"><?php echo $_SESSION['tipo']; ?></strong>
                        </div>
                    </div>
                    <div class="nav-item">
                        <a href="home.php"><i class="ik ik-home"></i><span>Página Inicial</span></a>
                    </div>
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Usuários</span>
                            <?php if (QtdAtualizacoesUsuariosNaoVizualidado() > 0) { ?>
                                <span title="Há Novas Atualizações" class="badge badge-danger">
                                    <?php
                                    echo QtdAtualizacoesUsuariosNaoVizualidado();
                                    ?>
                                </span>
                            <?php } ?>
                        </a>
                        <div class="submenu-content">
                            <a href="pages/usuarios/home_usuarios.php" class="menu-item">Início</a>
                            <a href="pages/usuarios/cad_usuario.php" class="menu-item">Novo</a>
                            <a href="pages/usuarios/list_cliente.php" class="menu-item">Clientes</a>
                            <a href="pages/usuarios/list_administrador.php" class="menu-item">Administradores</a>
                        </div>
                    </div>
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-package"></i><span>Produtos</span>
                            <?php if (QtdAtualizacoesProdutosNaoVizualidado() > 0) { ?>
                                <span title="Há Novas Atualizações" class="badge badge-danger">
                                    <?php
                                    echo QtdAtualizacoesProdutosNaoVizualidado();
                                    ?>
                                </span>
                            <?php } ?>
                        </a>
                        <div class="submenu-content">
                            <a href="pages/produtos/home_produtos.php" class="menu-item">Início</a>
                            <a href="pages/produtos/cad_produto.php" class="menu-item">Novo Produto</a>
                            <a href="pages/produtos/list_produto.php" class="menu-item">Produtos</a>
                            <a href="pages/produtos/cad_tipo.php" class="menu-item">Novo Tipo</a>
                            <a href="pages/produtos/list_tipo.php" class="menu-item">Tipos</a>
                        </div>
                    </div>
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-shopping-cart"></i><span>Vendas</span></a>
                        <div class="submenu-content">
                            <a href="pages/vendas/home_vendas.php" class="menu-item">Início</a>
                            <a href="pages/vendas/cad_venda.php" class="menu-item">Nova Venda</a>
                            <a href="pages/vendas/list_venda.php" class="menu-item">Vendas</a>
                            <a href="pages/vendas/cad_tipo.php" class="menu-item">Vendas Canceladas</a>
                        </div>
                    </div>
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-clipboard"></i><span>Tarefas</span></a>
                        <div class="submenu-content">
                            <a href="pages/widgets.html" class="menu-item">Nova</a>
                            <a href="pages/widget-statistic.html" class="menu-item">Pendentes</a>
                            <a href="pages/widget-data.html" class="menu-item">Concluídas</a>
                            <a href="pages/widget-data.html" class="menu-item">Encerradas</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
<?php } ?>