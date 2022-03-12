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
    $sql = "SELECT * FROM usuarios_usuarios WHERE email = :email and tipo IN('Administrador Geral', 'Administrador') and ativo = 0";
    $records = $pdo->prepare($sql);
    $records->bindParam(':email', $email);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    $contar = is_array($result) ? count($result) : 0;

    if ($contar > 0 && $senha == $result['senha']) {
        $_SESSION['id'] = $result['id'];

        $_SESSION['BemVindo'] = True;
        redirecionarPara("home.php", false);
    } else {
        $_SESSION['NaoAutorizado'] = True;
        redirecionarPara("", true);
    }
}

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

function tipoUsuario($idUsuario)
{
    $pdo = Database::connect();
    $sql = "SELECT tipo FROM usuarios_usuarios WHERE id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    return $result['tipo'];
}

function getIdInvalido($id)
{
    if (!isset($id) || $id == '') {
        $_SESSION['indisponivel'] = True;
        return true;
    } else if (registroIndisponivel(selecionarUsuario($id))) {
        $_SESSION['indisponivel'] = True;
        return true;
    } else {
        return false;
    }
}

function registroIndisponivel($result)
{
    if ((is_array($result) ? count($result) : 0) == 0 || $result['ativo'] == 1) {
        $_SESSION['indisponivel'] = True;
        return true;
    } else {
        return false;
    }
}

function selecionarUsuario($idUsuario)
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM usuarios_usuarios WHERE id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    return $result;
}