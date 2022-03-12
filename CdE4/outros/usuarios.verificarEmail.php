<?php
session_start();

require_once("../database.php");
$pdo = Database::connect();

require_once("outrasFuncoes.php");

if (!logado()) {
    redirecionarPara("../index.php", false);
} else {
    if (isset($_POST['email'])) {
        $email = strtolower($_POST['email']);
        $sql = "SELECT COUNT(*) as total FROM usuarios_usuarios WHERE email = '{$email}'";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] > 0 && $email != "") {
            echo json_encode(array('email' => true));
        } else {
            echo json_encode(array('email' => false));
        }
    }
}
