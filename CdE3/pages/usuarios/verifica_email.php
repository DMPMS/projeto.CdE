<?php

session_start();
if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "../../index.php"; </script>';
} else if (isset($_POST['email'])) {
    include_once '../../database.php';

    $email = strtolower($_POST['email']);

    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE email = '{$email}'";

    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0 && $email != "") {
        echo json_encode(array('email' => "Existe"));
    } else {
        echo json_encode(array('email' => "Não Existe"));
    }
}
?>