<?php
session_start();
echo '<meta charset="utf-8">';
include_once 'database.php';
$pdo = Database::connect();
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($data);
$email = $data['email'];
$senha = $data['senha'];

$sql = "SELECT * FROM cde_usuario WHERE email = :email";
$records = $pdo->prepare($sql);
$records->bindParam(':email', $email);
$records->execute();

$result = $records->fetch(PDO::FETCH_ASSOC);

$contar = is_array($result) ? count($result) : 0;


if ($contar > 0 && ($senha == $result['senha'])) {
    $_SESSION['id'] = $result['id'];
    $_SESSION['nome'] = $result['nome'];
    $_SESSION['foto'] = $result['foto'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['tipo'] = $result['tipo'];

    if ($_SESSION['tipo'] != "Cliente") {
        echo '<script>
             window.location = "home.php";
        </script>';
    }
} else {
    ?>
    <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Dados Incorretos!</title>
            <script>
                function Deslogar(){
                Swal.fire({
                title: 'Dados Incorretos! 😕',
                text: 'O e-mail ou a senha inserida estão incorretos. Volte para a tela de login e tente novamente.',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Tentar Novamente',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                window.location = "index.php";
                }

                })
                }
            </script>
            <script type='text/JavaScript'>
                setTimeout(function () {
                window.location = 'index.php'; 
                }, 5000); 
            </script>
            <link href="js/sweet/sweetalert2.min.css" rel="stylesheet" type="text/css">
            <link href="css/sb-admin-2.min.css" rel="stylesheet">
        </head>
        <body id="page-top" onload="Deslogar()" class="bg-gradient-primary">
            <script src="js/sb-admin-2.min.js"></script>
            <script src="js/sweet/sweetalert2.all.min.js"></script>
        </body>
    </html>
    <?php
}
Database::disconnect();


