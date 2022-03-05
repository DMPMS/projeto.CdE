<?php
function notificacaoEntrar()
{
    if (isset($_SESSION['Entrar'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "Entre com suas credenciais.",
                    icon: "warning",
                    hideAfter: 5000,
                    loader: false,
                    position: "top-right"
                })
            }
        </script>';

        unset($_SESSION['Entrar']);
    }
}

function notificacaoBemVindo($nome)
{
    if (isset($_SESSION['Bem-vindo'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "Bem-vindo(a) novamente, <b>' . $nome . '</b>.",
                    icon: "info",
                    hideAfter: 5000,
                    loader: false,
                    position: "top-right"
                })
            }
        </script>';

        unset($_SESSION['Bem-vindo']);
    }
}
