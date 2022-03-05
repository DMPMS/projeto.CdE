<?php
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
