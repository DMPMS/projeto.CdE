<?php

function fonte()
{
    echo 'https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800';
}

function botaoNavegacao1($titulo, $subTitulo, $cor, $icone, $caminho)
{
    echo '
    <div class="col-lg-3 col-md-6 col-sm-12">
        <a href="' . $caminho . '">
            <div class="widget bg-' . $cor . ' shadow-lg">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>' . $titulo . '</h6>
                            <h2>' . $subTitulo . '</h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-' . $icone . '"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>';
}

function pageHeader($pageHeaderTittle, $breadcrumbContainer)
{
    echo '
    <div class="page-header">
        <div class="row">
            <div class="col-lg-' . $pageHeaderTittle[0] . '">';
    foreach ($pageHeaderTittle[1] as $a) {
        echo '
                <div class="page-header-title">
                    <a href="' . $a[0] . '"><i class="ik ik-' . $a[1] . ' bg-' . $a[2] . '"></i></a>
                </div>';
    }
    echo '
                <div class="page-header-title">
                    <i class="ik ik-' . $pageHeaderTittle[2][0] . ' bg-' . $pageHeaderTittle[2][1] . '"></i>
                </div>
            </div>';
    echo '
            <div class="col-lg-' . $breadcrumbContainer[0] . '">
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">';
    foreach ($breadcrumbContainer[1] as $a) {
        echo '
                        <li class="breadcrumb-item">
                            <a href="' . $a[0] . '">' . $a[1] . '</a>
                        </li>';
    }
    echo '
                        <li class="breadcrumb-item active">' . $breadcrumbContainer[2] . '</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>';
}

function sidebarHeader($caminhoIcone, $titulo)
{
    echo '
    <div class="sidebar-header">
        <a class="header-brand" href="home.php">
            <div class="logo-img">
                <img src="' . $caminhoIcone . '" class="header-brand-img" alt="lavalite" style="height: 30px; width: 30px;">
            </div>
            <span class="text">' . $titulo . '</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>';
}

function sidebarNavLevel()
{
    echo '
    <div class="nav-lavel text-center p-3">
        <div class="mb-2">
            <img src="dist/img/usuarios/' . $_SESSION['id'] . '.jpg" class="header-brand-img rounded-circle" alt="lavalite" style="height: 80px; width: 80px;">
        </div>
        <div class="">
            <strong class="text-white">' . nomeUsuario($_SESSION['id']) . '</strong>
        </div>
        <div class="">
            <strong class="text-primary">' . tipoUsuario($_SESSION['id']) . '</strong>
        </div>
    </div>';
}

function sidebarNavItem($caminho, $icone, $nome)
{
    echo '
    <div class="nav-item">
        <a href="' . $caminho . '"><i class="ik ik-' . $icone . '"></i><span>' . $nome . '</span></a>
    </div>';
}

function sidebarNavItemComSubItem($icone, $nome, $subItens)
{
    echo '
    <div class="nav-item has-sub">
        <a href="javascript:void(0)"><i class="ik ik-' . $icone . '"></i><span>' . $nome . '</span></a>
        <div class="submenu-content">';
    foreach ($subItens as $item) {
        echo '
            <a href="' . $item[0] . '" class="menu-item">' . $item[1] . '</a>
        ';
    }
    echo '
        </div>
    </div>';
}

function headerSearch()
{
    echo '
    <div class="top-menu d-flex align-items-center">
        <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
        <div class="header-search">
            <div class="input-group">
                <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                <input type="text" class="form-control">
                <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
            </div>
        </div>
    </div>';
}

function headerOpcoes()
{
    echo '
    <div class="top-menu d-flex align-items-center">
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="dist/img/usuarios/' . $_SESSION['id'] . '.jpg" alt=""></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i> Perfil</a>
                <a class="dropdown-item" href="profile.html"><i class="ik ik-clipboard dropdown-icon"></i> Tarefas</a>
                <button class="dropdown-item text-red" data-toggle="modal" data-target="#Sair"><i class="ik ik-power dropdown-icon text-red"></i> Sair</button>
            </div>
        </div>
    </div>';
}
