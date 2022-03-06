<?php

function fonte(){
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
            <div class="col-lg-'.$pageHeaderTittle[0].'">';
    foreach ($pageHeaderTittle[1] as $a){
        echo '
                <div class="page-header-title">
                    <a href="'.$a[0].'"><i class="ik ik-'.$a[1].' bg-'.$a[2].'"></i></a>
                </div>';
    }
    echo '
                <div class="page-header-title">
                    <i class="ik ik-'.$pageHeaderTittle[2][0].' bg-'.$pageHeaderTittle[2][1].'"></i>
                </div>
            </div>';
    echo '
            <div class="col-lg-'.$breadcrumbContainer[0].'">
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">';
    foreach ($breadcrumbContainer[1] as $a){
        echo '
                        <li class="breadcrumb-item">
                            <a href="'.$a[0].'">'.$a[1].'</a>
                        </li>';
    }
    echo '
                        <li class="breadcrumb-item active">'.$breadcrumbContainer[2].'</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>';
}