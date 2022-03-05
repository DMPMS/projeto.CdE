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

function notificacaoNaoAutorizado()
{
    if (isset($_SESSION['NaoAutorizado'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "Credenciais não autorizadas.",
                    icon: "danger",
                    hideAfter: 5000,
                    loader: false,
                    position: "top-right"
                })
            }
        </script>';

        unset($_SESSION['NaoAutorizado']);
    }
}

function notificacaoBemVindo($nome)
{
    if (isset($_SESSION['BemVindo'])) {
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

        unset($_SESSION['BemVindo']);
    }
}
