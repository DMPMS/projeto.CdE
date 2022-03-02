<?php

require 'connection.php';
date_default_timezone_set('America/Fortaleza');

function QtdUsuarios() {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE tipo IN('Administrador','Cliente') AND ativo = 0";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdAdministradores() {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE tipo IN('Administrador') AND ativo = 0";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdClientes() {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE tipo IN('Cliente') AND ativo = 0";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function UltimoIdUsuario() {
    $pdo = Database::connect();
    $sql = "SELECT * FROM usuario_usuarios ORDER BY id DESC LIMIT 1";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
}
?>
<style type="text/css"> 
    a.semsublinhar:link 
    { 
        text-decoration:none; 
    } 
</style>
<style type="text/css"> 
    button.semborda:focus {
        outline: 0;
        -webkit-box-shadow: none;
    }
</style>