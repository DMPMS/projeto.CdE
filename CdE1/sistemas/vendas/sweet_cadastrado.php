<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "../../necessariologar.php";
        </script>';
} else {
    if (!isset($_GET['id'])) {
        $pdo = Database::connect();
        $sql = "SELECT * FROM cde_usuario ORDER BY id DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        $idCliente = $result['id'];
    } else {
        $idCliente = $_GET['id'];
    }

    $pdo = Database::connect();
    $sql = "SELECT * FROM cde_usuario where id = $idCliente";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    ?>
    <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" type="image/png" href="../../img/ico.png">
            <title>Cliente Cadastrado!</title>
            <script>
                function Deslogar(){
                Swal.fire({
                title: 'Cliente Cadastrado!',
                text: '<?php echo $result['nome']; ?> cadastrado(a) com sucesso.',
                icon: 'success',
                showConfirmButton: false

                })
                }
            </script>
            <script type='text/JavaScript'>
                setTimeout(function () {
                window.location = 'info_cliente.php'; 
                }, 1500); 
            </script>
            <link href="../../js/sweet/sweetalert2.min.css" rel="stylesheet" type="text/css">
            <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
        </head>
        <body id="page-top" onload="Deslogar()" class="bg-gradient-primary">
            <script src="../../js/sb-admin-2.min.js"></script>
            <script src="../../js/sweet/sweetalert2.all.min.js"></script>
        </body>
    </html>
<?php } ?>


