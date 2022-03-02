<?php
session_start();
require_once './funcoes.php';
include_once './database.php';

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "necessariologar.php";
        </script>';
} else {
    $idUsuario = $_SESSION['id'];
    $pdo = Database::connect();
    $sql = "SELECT * FROM cde_usuario where id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    

    Database::disconnect();
    ?>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" type="image/png" href="img/ico.png">
            <title>Página Inicial</title>
            <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="css/sb-admin-2.min.css" rel="stylesheet">
        </head>
        <body id="page-top">
            <div id="wrapper">
                <?php include './menu.php'; ?> 
                
            </div>
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        </body>
    </html>
<?php } ?>