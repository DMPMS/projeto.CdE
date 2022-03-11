<?php
if (!logado()) {
    redirecionarPara("../index.php", false);
} else { ?>
    <div class="app-sidebar colored">
        <!--Sidebar-Header-->
        <?php sidebarHeader("../../dist/img/icone.png", "CdE4"); ?>
        <!--/Sidebar-Header-->
        <!--Sidebar-Content-->
        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">
                    <!--Sidebar Nav-Level-->
                    <?php sidebarNavLevel("../../dist/img/usuarios/"); ?>
                    <!--/Sidebar Nav-Level-->
                    <?php sidebarNavItem("../../home.php", "home", "Página Inicial"); ?>
                    <?php sidebarNavItemComSubItem("users", "Usuários", [["usuarios.home.php", "Início"], ["usuarios.novoUsuario.php", "Novo Usuário"], ["usuarios.clientes.php", "Clientes"], ["usuarios.administradores.php", "Administradores"]]); ?>
                    <?php sidebarNavItemComSubItem("package", "Produtos", [["produtos/produtos.home.php", "Início"], ["produtos/produtos.novoProduto.php", "Novo Produto"], ["produtos/produtos.produtos.php", "Produtos"], ["produtos/produtos.novoTipo.php", "Novo Tipo"], ["produtos/produtos.tipos.php", "Tipos"]]); ?>
                    <?php sidebarNavItemComSubItem("shopping-cart", "Vendas", [["vendas/vendas.home.php", "Início"], ["vendas/vendas.novaVenda.php", "Nova Venda"], ["vendas/vendas.vendas.php", "Vendas"], ["vendas/vendas.vendasCanceladas.php", "Vendas Canceladas"]]); ?>
                    <?php sidebarNavItemComSubItem("clipboard", "Tarefas", [["tarefas/tarefas.home.php", "Início"], ["tarefas/tarefas.novaTarefa.php", "Nova Tarefa"], ["tarefas/tarefas.tarefasPendentes.php", "Tarefas Pendentes"], ["tarefas/tarefas.tarefasConcluidas.php", "Tarefas Concluídas"], ["tarefas/tarefas.tarefasEncerradas.php", "Tarefas Encerradas"]]); ?>
                </nav>
            </div>
        </div>
        <!--/Sidebar-Content-->
    </div>
<?php } ?>