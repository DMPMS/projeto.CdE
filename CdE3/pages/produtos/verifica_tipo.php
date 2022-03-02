<?php

session_start();
if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "../../index.php"; </script>';
} else if (isset($_POST['nome'])) {
    include_once '../../database.php';

    $nome = $_POST['nome'];

    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM produto_tipos WHERE nome = '{$nome}'";

    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0 && $nome != "") {
        echo json_encode(array('nome' => "Existe"));
    } else {
        echo json_encode(array('nome' => "Não Existe"));
    }
}
?>