<?php
include_once '../../database.php';
session_start();

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "../../necessariologar.php";
        </script>';
} else if ($_SESSION['tipo'] != "Administrador Geral") {
    echo '<script>
            window.location = "../../indisponivel.php";
        </script>';
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_GET) {
        $num_venda = $_GET['num_venda'];
        $sql = "SELECT * FROM cde_venda_detalhe WHERE num_venda = $num_venda";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        if ($result != null) {
            $nome_cliente = $result['nome_cliente'];
            $num_venda = $result['num_venda'];
            $valor = $result['valor'];

            $sql = "DELETE FROM cde_venda WHERE num_venda = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($num_venda));

            $sql2 = "DELETE FROM cde_venda_detalhe WHERE num_venda = ?";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($num_venda));
            ?>
            <html lang="pt-br">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <meta name="description" content="">
                    <meta name="author" content="">
                    <link rel="icon" type="image/png" href="../../img/ico.png">
                    <title>Venda <?php echo $num_venda; ?> Excluída!</title>
                    <script>
                        function Deslogar(){
                        Swal.fire({
                        title: 'Venda <?php echo $num_venda; ?> Excluída! 🗑',
                        text: 'A venda no valor de R$ <?php echo number_format($valor, 2, ',', '.'); ?> para <?php echo $nome_cliente; ?> foi excluída com sucesso.',
                        icon: 'success',
                        showConfirmButton: false
                        })
                        }
                    </script>
                    <script type='text/JavaScript'>
                        setTimeout(function () {
                        window.location = history.back(); 
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
        <?php } else { ?>
            <html lang="pt-br">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <meta name="description" content="">
                    <meta name="author" content="">
                    <title>Erro ao Excluir!</title>
                    <script>
                        function Deslogar(){
                        Swal.fire({
                        title: 'Erro ao Excluir! 🗑',
                        text: 'A venda não existe.',
                        icon: 'error',
                        showConfirmButton: false
                        })
                        }
                    </script>
                    <script type='text/JavaScript'>
                        setTimeout(function () {
                        window.location = history.back();"; 
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
            <?php
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
                <title>Erro ao Excluir!</title>
                <script>
                    function Deslogar(){
                    Swal.fire({
                    title: 'Erro ao Excluir! 🗑',
                    text: 'A venda não existe.',
                    icon: 'error',
                    showConfirmButton: false
                    })
                    }
                </script>
                <script type='text/JavaScript'>
                    setTimeout(function () {
                    window.location = "history.back();"; 
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
        <?php
    }
    Database::disconnect();
}
