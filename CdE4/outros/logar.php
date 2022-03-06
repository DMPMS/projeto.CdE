<?php
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
