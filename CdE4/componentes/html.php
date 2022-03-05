<?php
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
