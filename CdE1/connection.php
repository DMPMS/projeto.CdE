<?php
//Define as constantes da aplicação
define('GW_UPLOADPATH', 'images/');

//Define as constantes da conexão com o banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cde');

//Conecta-se ao banco de dados
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

/* check connection */
if (mysqli_connect_errno()) {
   // printf("Falha na conexão: %s\n", mysqli_connect_error());
    exit();
}

//printf("Caracteres carregados: %s\n", mysqli_character_set_name($dbc));

/* change character set to utf8 */
if (!mysqli_set_charset($dbc, "utf8")) {
    //printf("Erro ao carregar os character utf8: %s\n", mysqli_error($dbc));
    exit();
} else {
   // printf("Caracteres atuais: %s\n", mysqli_character_set_name($dbc));
    
}




//teste de listagem de dados
//echo "<h1>Listar</h1>";
//$query = "SELECT * FROM usuarios";
//$data = mysqli_query($dbc, $query);
//echo '<table border="1">';
//echo '<tr><th>Código</th><th>Nome</th><th>Email</th><th colspan=2>Ações</th></tr>';
//while($linha = mysqli_fetch_array($data)):
//    extract($linha);
//    echo '<tr><td>'.$id.'</td><td>'.$nome.'</td><td>'.$email.'</td>'.'<td><a href="editar/usuario.php?id='.$id.'">Editar</a></td><td><a href="#">Excluir</a></td></tr>';
//endwhile;
//echo '</table>';
