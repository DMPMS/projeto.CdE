<?php
function logado()
{
    if (isset($_SESSION['id']) == '') {
        $_SESSION['Entrar'] = True;
        return false;
    } else {
        return true;
    }
}

function logar($email, $senha)
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM usuarios_usuarios WHERE email = :email";
    $records = $pdo->prepare($sql);
    $records->bindParam(':email', $email);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    $contar = is_array($result) ? count($result) : 0;

    if ($contar > 0 && ($senha == $result['senha']) && $result['ativo'] == 0) {
        $_SESSION['id'] = $result['id'];
        $_SESSION['nome'] = $result['nome'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['tipo'] = $result['tipo'];

        if ($_SESSION['tipo'] == "Administrador Geral") {
            $_SESSION['Bem-vindo'] = True;
            redirecionarPara("home.php");
        }
    } else {
        redirecionarPara("index.php");
    }
}

function redirecionarPara($pagina)
{
    echo '<script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location = "' . $pagina . '");
            }
        </script>';
}

function notificacaoBemVindo($nome)
{
    if (isset($_SESSION['Bem-vindo'])) {
        echo "<!--Notificação Bem vindo-->
                <script>
                    window.onload = function() {
                        $.toast({
                            text: 'Bem-vindo(a) novamente, <b>" . $nome . "</b>.',
                            icon: 'info',
                            hideAfter: 5000,
                            loader: false,
                            position: 'top-right'
                        })
                    }
                </script>";

        unset($_SESSION['Bem-vindo']);
    }
}

function notificacaoEntrar()
{
    if (isset($_SESSION['Entrar'])) {
        echo "<!--Notificação Entrar-->
                <script>
                    window.onload = function() {
                        $.toast({
                            text: 'Entre com suas credenciais.',
                            icon: 'warning',
                            hideAfter: 5000,
                            loader: false,
                            position: 'top-right'
                        })
                    }
                </script>";

        unset($_SESSION['Entrar']);
    }
}
