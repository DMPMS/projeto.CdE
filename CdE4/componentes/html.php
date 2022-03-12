<?php

function fonte()
{
    echo 'https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800';
}

function botaoNavegacao1($tituloPequeno, $tituloGrande, $cor, $icone, $caminho)
{
    echo '
    <div class="col-lg-3 col-md-6 col-sm-12">
        <a href="' . $caminho . '">
            <div class="widget bg-' . $cor . ' shadow-lg">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>' . $tituloPequeno . '</h6>
                            <h2>' . $tituloGrande . '</h2>
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

function sidebarHeader($caminhoIcone, $spanTitulo)
{
    echo '
    <div class="sidebar-header">
        <a class="header-brand" href="home.php">
            <div class="logo-img">
                <img src="' . $caminhoIcone . '" class="header-brand-img" alt="lavalite" style="height: 30px; width: 30px;">
            </div>
            <span class="text">' . $spanTitulo . '</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>';
}

function sidebarNavLevel($caminhoFoto)
{
    echo '
    <div class="nav-lavel text-center p-3">
        <div class="mb-2">
            <img src="' . $caminhoFoto . $_SESSION['id'] . '.jpg" class="header-brand-img rounded-circle" alt="lavalite" style="height: 80px; width: 80px;">
        </div>
        <div class="">
            <strong class="text-white">' . nomeUsuario($_SESSION['id']) . '</strong>
        </div>
        <div class="">
            <strong class="text-primary">' . tipoUsuario($_SESSION['id']) . '</strong>
        </div>
    </div>';
}

function sidebarNavItem($caminho, $icone, $spanTitulo)
{
    echo '
    <div class="nav-item">
        <a href="' . $caminho . '"><i class="ik ik-' . $icone . '"></i><span>' . $spanTitulo . '</span></a>
    </div>';
}

function sidebarNavItemComSubItem($icone, $spanTitulo, $subItens)
{
    echo '
    <div class="nav-item has-sub">
        <a href="javascript:void(0)"><i class="ik ik-' . $icone . '"></i><span>' . $spanTitulo . '</span></a>
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

function headerOpcoes($caminhoFoto)
{
    echo '
    <div class="top-menu d-flex align-items-center">
        <div class="dropdown">
            <a href="#" data-toggle="dropdown"><img class="avatar" src="' . $caminhoFoto . $_SESSION['id'] . '.jpg"></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i> Perfil</a>
                <a class="dropdown-item" href="profile.html"><i class="ik ik-clipboard dropdown-icon"></i> Tarefas</a>
                <button class="dropdown-item text-red" data-toggle="modal" data-target="#Sair"><i class="ik ik-power dropdown-icon text-red"></i> Sair</button>
            </div>
        </div>
    </div>';
}

function formPicture($div, $img, $input)
{
    // $div: [$divColLg];
    // $img: [$imgSrc, $imgId];
    // $input: [$inputName, $inputId]; 

    echo '
    <div class="form-group col-lg-' . $div[0] . '">
        <div class="picture-container">
            <div class="picture">
                <img src="' . $img[0] . '" id="' . $img[1] . '" class="picture-src rounded-circle" />
                <input name="' . $input[0] . '" id="' . $input[1] . '" type="file" accept="image/*">
            </div>
            <h6>Escolher Imagem</h6>
        </div>
    </div>';
}

function formInput($div, $label, $labelSpan, $input)
{
    // $div: [$divId, $divColLg, $divStyle];
    // $label: [$labelTitulo];
    // $labelSpan: [$labelSpanAsteriscoExiste, $labelSpanAsteriscoId, $labelSpanAsteriscoStyle];
    // $input: [$inputName, $inputId, $inputType, $inputPlaceholder, $inputValue, $inputRequired, $inputDisabled, $inputReadOnly]; 

    if ($div[0] == '') {
        $divId = '';
    } else {
        $divId = 'id="' . $div[0] . '"';
    }

    if ($div[2] == '') {
        $divStyle = '';
    } else {
        $divStyle = 'style="' . $div[2] . '"';
    }

    if ($labelSpan[0] === true) {
        if ($labelSpan[1] == '') {
            $labelSpanAsteriscoId = '';
        } else {
            $labelSpanAsteriscoId = 'id="' . $labelSpan[1] . '"';
        }

        if ($labelSpan[2] == '') {
            $labelSpanAsteriscoStyle = '';
        } else {
            $labelSpanAsteriscoStyle = 'style="' . $labelSpan[2] . '"';
        }

        $span = '<span ' . $labelSpanAsteriscoId . ' class="text-danger" ' . $labelSpanAsteriscoStyle . '>*</span>';
    } else if ($labelSpan[0] === false) {
        $span = '';
    }

    if ($input[0] == '') {
        $inputName = '';
    } else {
        $inputName = 'name="' . $input[0] . '"';
    }

    if ($input[1] == '') {
        $inputId = '';
    } else {
        $inputId = 'id="' . $input[1] . '"';
    }

    if ($input[2] == '') {
        $inputType = '';
    } else {
        $inputType = 'type="' . $input[2] . '"';
    }

    if ($input[3] == '') {
        $inputPlaceholder = '';
    } else {
        $inputPlaceholder = 'placeholder="' . $input[3] . '"';
    }

    if ($input[4] == '') {
        $inputValue = '';
    } else {
        $inputValue = 'value="' . $input[4] . '"';
    }

    if ($input[5] === false) {
        $inputRequired = '';
    } else if ($input[5] === true) {
        $inputRequired = 'required=""';
    }

    if ($input[6] === false) {
        $inputDisabled = '';
    } else if ($input[6] === true) {
        $inputDisabled = 'disabled=""';
    }

    if ($input[7] === false) {
        $inputReadOnly = '';
    } else if ($input[7] === true) {
        $inputReadOnly = 'readonly=""';
    }

    echo '
    <div ' . $divId . ' class="form-group col-lg-' . $div[1] . '" ' . $divStyle . '>
        <label>' . $label[0] . ' ' . $span . '</label>
        <input ' . $inputName . ' ' . $inputId . ' ' . $inputType . ' class="form-control" ' . $inputPlaceholder . ' ' . $inputValue . ' ' . $inputRequired . ' ' . $inputDisabled . ' ' . $inputReadOnly . '>
    </div>
    ';
}

function formInputSelect2($div, $label, $labelSpan, $select)
{
    // $div: [$divId, $divColLg, $divStyle];
    // $label: [$labelTitulo];
    // $labelSpan: [$labelSpanAsteriscoExiste, $labelSpanAsteriscoId, $labelSpanAsteriscoStyle];
    // $select: [$selectName, $selectId, $selectRequired, [$selectOptions, $selectDisabled]
    // OBS: $selectOptions é uma lista.

    if ($div[0] == '') {
        $divId = '';
    } else {
        $divId = 'id="' . $div[0] . '"';
    }

    if ($div[2] == '') {
        $divStyle = '';
    } else {
        $divStyle = 'style="' . $div[2] . '"';
    }

    if ($labelSpan[0] === true) {
        if ($labelSpan[1] == '') {
            $labelSpanAsteriscoId = '';
        } else {
            $labelSpanAsteriscoId = 'id="' . $labelSpan[1] . '"';
        }

        if ($labelSpan[2] == '') {
            $labelSpanAsteriscoStyle = '';
        } else {
            $labelSpanAsteriscoStyle = 'style="' . $labelSpan[2] . '"';
        }

        $span = '<span ' . $labelSpanAsteriscoId . ' class="text-danger" ' . $labelSpanAsteriscoStyle . '>*</span>';
    } else if ($labelSpan[0] === false) {
        $span = '';
    }

    if ($select[0] == '') {
        $selectName = '';
    } else {
        $selectName = 'name="' . $select[0] . '"';
    }

    if ($select[1] == '') {
        $selectId = '';
    } else {
        $selectId = 'id="' . $select[1] . '"';
    }

    if ($select[2] === false) {
        $selectRequired = '';
    } else if ($select[2] === true) {
        $selectRequired = 'required=""';
    }

    if ($select[3][1] === false) {
        $selectDisabled = '';
    } else if ($select[3][1] === true) {
        $selectDisabled = 'disabled=""';
    }

    echo '
    <div ' . $divId . ' class="form-group col-lg-' . $div[1] . '" ' . $divStyle . '>
        <label>' . $label[0] . ' ' . $span . '</label>
        <select ' . $selectName . ' ' . $selectId . ' class="form-control" ' . $selectRequired . ' ' . $selectDisabled . '>';
    foreach ($select[3][0] as $opcao) {
        echo '
            <option value="' . $opcao . '">' . $opcao . '</option>';
    }
    echo '
        </select>
    </div>';
}

function dataTableTds($tabela, $row)
{
    if ($tabela == "Clientes") {
        if (tipoUsuario($_SESSION['id']) == "Administrador Geral") {
            $acoes = '
        <td class="text-center">
            <button title="Dados" type="button" class="btn btn-icon btn-primary mr-1" data-toggle="modal" data-target="#Dados' . $row['id'] . '"><i class="ik ik-eye"></i></button>
            <a title="Editar" href="usuarios.editarUsuario.php?id=' . $row['id'] . '" class="btn btn-icon btn-warning mr-1"><i class="ik ik-edit-2"></i></a>
            <button title="Excluir" type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#Excluir' . $row['id'] . '"><i class="ik ik-trash-2"></i></button>
        </td>';
        } else {
            $acoes = '
        <td class="text-center">
            <button title="Dados" type="button" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#Dados' . $row['id'] . '"><i class="ik ik-eye"></i></button>
        </td>';
        }

        $conteudo = [
            '<td><img src="../../dist/img/usuarios/' . $row['id'] . '.png" class="table-user-thumb"> ' . $row['nome'] . '</td>',
            '<td>' . $row['email'] . '</td>',
            '<td>19</td>',
            '<td style="vertical-align:middle">R$ 3000,00</td>',
            $acoes
        ];
    } else if ($tabela == "Administradores") {
        if (tipoUsuario($_SESSION['id']) == "Administrador Geral") {
            $acoes = '
        <td class="text-center">
            <button title="Dados" type="button" class="btn btn-icon btn-primary mr-1" data-toggle="modal" data-target="#Dados' . $row['id'] . '"><i class="ik ik-eye"></i></button>
            <a title="Editar" href="usuarios.editarUsuario.php?id=' . $row['id'] . '" class="btn btn-icon btn-warning mr-1"><i class="ik ik-edit-2"></i></a>
            <button title="Excluir" type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#Excluir' . $row['id'] . '"><i class="ik ik-trash-2"></i></button>
        </td>';
        } else {
            $acoes = '
        <td class="text-center">
            <button title="Dados" type="button" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#Dados' . $row['id'] . '"><i class="ik ik-eye"></i></button>
        </td>';
        }

        $conteudo = [
            '<td><img src="../../dist/img/usuarios/' . $row['id'] . '.png" class="table-user-thumb"> ' . $row['nome'] . '</td>',
            '<td>' . $row['email'] . '</td>',
            '<td>19</td>',
            '<td style="vertical-align:middle">R$ 3000,00</td>',
            $acoes
        ];
    }

    return $conteudo;
}

function dataTable($tableId, $tabela, $ths, $pdo, $sql)
{
    echo '
    <table id="' . $tableId . '" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>';
    foreach ($ths as $th) {
        echo '
                <th>' . $th . '</th>';
    }
    echo '     
            </tr>
        </thead>
        <tbody>';
    foreach ($pdo->query($sql) as $row) {
        echo '
            <tr>';
        foreach (dataTableTds($tabela, $row) as $td) {
            echo $td;
        }
        echo '
            </tr>';
    }
    echo '
        </tbody>
        <tfoot>
            <tr>';
    foreach ($ths as $th) {
        echo '
                <th>' . $th . '</th>';
    }
    echo '     
            </tr>
        </tfoot>
    </table>';
}
function fotoDoModal($div, $img)
{
    echo '
    <div class="form-group col-lg-' . $div[0] . ' text-center">
        <img src="' . $img[0] . '" class="rounded-circle" width="120px" height="120px">
    </div>';
}

