<?php
function redirecionarPara($pagina)
{
    echo '
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location = "' . $pagina . '");
        }
    </script>';
}
