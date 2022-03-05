<?php
function sair($caminho)
{
    echo '
    <script>
        function Sair() {
            window.location = "' . $caminho . '";
        }
    </script>';
}
