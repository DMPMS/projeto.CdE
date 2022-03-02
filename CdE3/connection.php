<?php
//Constantes da aplicação
define('GW_UPLOADPATH', 'images/');

//Constantes da conexão com o banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cde3');

//Conecta-se ao banco de dados
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//Verificando Conexão
if (mysqli_connect_errno()) {
    // printf("Falha na conexão: %s\n", mysqli_connect_error());
    exit();
}

//Mudando para UTF-8
if (!mysqli_set_charset($dbc, "utf8")) {
    //printf("Erro ao carregar os character utf8: %s\n", mysqli_error($dbc));
    exit();
} else {
    // printf("Caracteres atuais: %s\n", mysqli_character_set_name($dbc));
}