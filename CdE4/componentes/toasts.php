<?php
function toastEntrar()
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

function toastNaoAutorizado()
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

function toastBemVindo()
{
    if (isset($_SESSION['BemVindo'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "Bem-vindo(a) novamente, <b>' . nomeUsuario($_SESSION['id']) . '</b>.",
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

function toastMarcadasComoLidas($modulo)
{
    if (isset($_SESSION['MarcadasComoLidas'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "As novas atualizações de <b>' . $modulo . '</b> foram marcadas como lidas.",
                    icon: "success",
                    hideAfter: 5000,
                    loader: false,
                    position: "top-right"
                })
            }
        </script>';

        unset($_SESSION['MarcadasComoLidas']);
    }
}

function toastUsuarioExcluido()
{
    if (isset($_SESSION['UsuarioExcluido'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "' . tipoUsuario($_SESSION['UsuarioExcluido']) . ' excluído(a).",
                    icon: "success",
                    hideAfter: 5000,
                    loader: false,
                    position: "top-right"
                })
            }
        </script>';

        unset($_SESSION['UsuarioExcluido']);
    }
}

function toastUsuarioCadastrado()
{
    if (isset($_SESSION['UsuarioCadastrado'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "' . tipoUsuario($_SESSION['UsuarioCadastrado']) . ' cadastrado(a).",
                    icon: "success",
                    hideAfter: 5000,
                    loader: false,
                    position: "top-right"
                })
            }
        </script>';

        unset($_SESSION['UsuarioCadastrado']);
    }
}

function toastEditado()
{
    if (isset($_SESSION['Editado'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "Dados alterados com sucesso.",
                    icon: "success",
                    hideAfter: 5000,
                    loader: false,
                    position: "top-right"
                })
            }
        </script>';

        unset($_SESSION['Editado']);
    }
}

function toastNaoEditado()
{
    if (isset($_SESSION['NaoEditado'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "Nenhum dado foi alterado.",
                    icon: "warning",
                    hideAfter: 5000,
                    loader: false,
                    position: "top-right"
                })
            }
        </script>';

        unset($_SESSION['NaoEditado']);
    }
}

function toastIndisponivel()
{
    if (isset($_SESSION['Indisponivel'])) {
        echo '
        <script>
            window.onload = function() {
                $.toast({
                    text: "Página indisponível.",
                    icon: "warning",
                    hideAfter: 5000,
                    loader: false,
                    position: "top-right"
                })
            }
        </script>';

        unset($_SESSION['Indisponivel']);
    }
}