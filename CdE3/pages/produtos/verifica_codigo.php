<?php

session_start();
if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "../../index.php"; </script>';
} else if (isset($_POST['codigo'])) {
    include_once '../../database.php';

    $codigo = $_POST['codigo'];

    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM produto_produtos WHERE codigo = '{$codigo}'";

    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0 && $codigo != "") {
        echo json_encode(array('codigo' => "Existe"));
    } else {
        echo json_encode(array('codigo' => "Não Existe"));
    }
}
?>