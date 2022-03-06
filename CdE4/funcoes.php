<?php
function nomeUsuario($idUsuario)
{
    $pdo = Database::connect();
    $sql = "SELECT nome FROM usuarios_usuarios WHERE id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['nome'];
}

function tipoUsuario($idUsuario)
{
    $pdo = Database::connect();
    $sql = "SELECT tipo FROM usuarios_usuarios WHERE id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['tipo'];
}