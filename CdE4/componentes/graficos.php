<?php

function graficoLineChart($divColLg, $divColXl, $divId)
{
    echo '
    <div class="col-lg-' . $divColLg . ' col-xl-' . $divColXl . '">
        <div class="card shadow-lg">
            <div class="card-header">
                <h3>Usuários Cadastrados Por Mês</h3>
            </div>
            <div class="card-block text-center">
                <div id="' . $divId . '" class="chart-shadow" style="height:400px"></div>
            </div>
        </div>
    </div>';
}
