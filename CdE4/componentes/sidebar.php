<?php
if (!logado()) {
    redirecionarPara("../index.php", false);
} else { ?>
    <div class="app-sidebar colored">
        <!--Sidebar-Header-->
        <?php sidebarHeader("dist/img/icone.png", "CdE4"); ?>
        <!--/Sidebar-Header-->
        <!--Sidebar-Content-->
        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">
                    <!--Sidebar Nav-Level-->
                    <?php sidebarNavLevel(); ?>
                    <!--/Sidebar Nav-Level-->
                    <?php sidebarNavItem("home.php", "home", "Página Inicial"); ?>
                    <?php sidebarNavItemComSubItem("users", "Usuários", [["modulos/usuarios/usuarios.home.php", "Início"], ["modulos/usuarios/usuarios.novoUsuario.php", "Novo Usuário"], ["modulos/usuarios/usuarios.clientes.php", "Clientes"], ["modulos/usuarios/usuarios.administradores.php", "Administradores"]]); ?>
                    <?php sidebarNavItemComSubItem("package", "Produtos", [["modulos/produtos/produtos.home.php", "Início"], ["modulos/produtos/produtos.novoProduto.php", "Novo Produto"], ["modulos/produtos/produtos.produtos.php", "Produtos"], ["modulos/produtos/produtos.novoTipo.php", "Novo Tipo"], ["modulos/produtos/produtos.tipos.php", "Tipos"]]); ?>
                    <?php sidebarNavItemComSubItem("shopping-cart", "Vendas", [["modulos/vendas/vendas.home.php", "Início"], ["modulos/vendas/vendas.novaVenda.php", "Nova Venda"], ["modulos/vendas/vendas.vendas.php", "Vendas"], ["modulos/vendas/vendas.vendasCanceladas.php", "Vendas Canceladas"]]); ?>
                    <?php sidebarNavItemComSubItem("clipboard", "Tarefas", [["modulos/tarefas/tarefas.home.php", "Início"], ["modulos/tarefas/tarefas.novaTarefa.php", "Nova Tarefa"], ["modulos/tarefas/tarefas.tarefasPendentes.php", "Tarefas Pendentes"], ["modulos/tarefas/tarefas.tarefasConcluidas.php", "Tarefas Concluídas"], ["modulos/tarefas/tarefas.tarefasEncerradas.php", "Tarefas Encerradas"]]); ?>
                </nav>
            </div>
        </div>
        <!--/Sidebar-Content-->
    </div>
<?php } ?>