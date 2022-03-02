<div class="col-sm-2 col-xs-6 sidebar pl-0">
    <div class="inner-sidebar mr-3">
        <div class="avatar text-center">
            <img src="assets/img/usuarios/<?php echo $_SESSION['foto']; ?>" alt="" class="rounded-circle" />
            <p><strong><?php echo $_SESSION['nome']; ?></strong></p>
            <span class="text-primary small"><strong><?php echo $_SESSION['tipo']; ?></strong></span>
        </div>
        <div class="sidebar-menu-container">
            <ul class="sidebar-menu mt-4 mb-4">
                <li class="parent">
                    <a href="home.php" class=""><i class="fa fa-dashboard mr-3"> </i>
                        <span class="none">Página Inicial</span>
                    </a>
                </li>
                <li class="parent">
                    <a href="pages/usuarios/home_usuarios.php" class=""><i class="fa fa-users mr-3"> </i>
                        <span class="none">Usuários</span>
                    </a>
                </li>
                <li class="parent">
                    <a href="home.php" class=""><i class="fa fa-archive mr-3"> </i>
                        <span class="none">Produtos</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>