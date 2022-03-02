<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <i class="fas fa-box"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Controle de Estoque</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Página Inicial -->
    <li class="nav-item active">
        <a class="nav-link" href="../../home.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Página Inicial</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios" aria-expanded="true" aria-controls="collapseUsuarios">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuários</span>
        </a>
        <div id="collapseUsuarios" class="collapse" aria-labelledby="headingUsuarios" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?><a class="collapse-item" href="../usuarios/cad_cliente.php">Novo Usuário</a><?php } ?>
                <a class="collapse-item" href="../usuarios/list_cliente.php">Lista de Clientes</a>
                <a class="collapse-item" href="../usuarios/list_administradores.php">Lista de Administradores</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProdutos" aria-expanded="true" aria-controls="collapseProdutos">
            <i class="fas fa-fw fa-box-open"></i>
            <span>Produtos</span>
        </a>
        <div id="collapseProdutos" class="collapse" aria-labelledby="headingProdutos" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?><a class="collapse-item" href="../produtos/cad_produto.php">Novo Produto</a><?php } ?>
                <a class="collapse-item" href="../produtos/list_produto.php">Lista de Produtos</a>
                <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?><a class="collapse-item" href="../produtos/cad_tipo.php">Novo Tipo</a><?php } ?>
                <a class="collapse-item" href="../produtos/list_tipo.php">Lista de Tipos</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVendas" aria-expanded="true" aria-controls="collapseVendas">
            <i class="fas fa-fw fa-comment-dollar"></i>
            <span>Vendas</span>
        </a>
        <div id="collapseVendas" class="collapse" aria-labelledby="headingVendas" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="../vendas/cad_venda_cliente.php">Nova Venda</a>
                <a class="collapse-item" href="../vendas/list_venda.php">Lista de Vendas</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTarefas" aria-expanded="true" aria-controls="collapseTarefas">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span><?php if ($_SESSION['tipo'] != "Administrador Geral") { ?>Minhas <?php }?>Tarefas</span>
        </a>
        <div id="collapseTarefas" class="collapse" aria-labelledby="headingTarefas" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if ($_SESSION['tipo'] == "Administrador Geral") { ?><a class="collapse-item" href="../tarefas/cad_tarefa.php">Nova Tarefa</a><?php } ?>
                <a class="collapse-item" href="../tarefas/list_tarefa_pendente.php">Tarefas Pendentes</a>
                <a class="collapse-item" href="../tarefas/list_tarefa_concluida.php">Tarefas Concluídas</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
