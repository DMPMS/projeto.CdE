<?php
function redirecionarPara($pagina, $recarregarPagina)
{
    if ($recarregarPagina === true) {
        echo '
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href);
            }
        </script>';
    } else {
        echo '
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location = "' . $pagina . '");
            }
        </script>';
    }
}
