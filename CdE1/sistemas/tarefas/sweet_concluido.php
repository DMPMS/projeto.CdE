<?php
session_start();
require_once '../../funcoes.php';
include_once '../../database.php';

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "../../necessariologar.php";
        </script>';
} else {
    $pdo = Database::connect();
    if ($_GET) {
        $idTarefa = $_GET['id'];
        $sql = "SELECT * FROM cde_tarefa WHERE id = $idTarefa AND status = 'Pendente'";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        if ($result != null) {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE cde_tarefa SET status = ?,id_responsavel_conclusao = ?,nome_responsavel_conclusao = ?,data_conclusao = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array("Concluída", $_SESSION['id'], $_SESSION['nome'], date('Y-m-d H:i:s'), $idTarefa));

            //notificação de tarefa concluída
            $sql = "INSERT INTO cde_notificacao (tipo,id_registro,visualizado,criadoem,nome,id_responsavel,nome_responsavel,tipo_responsavel) values(?,?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array("Tarefa Concluída", $idTarefa, "." . $_SESSION['id'] . ".", date('Y-m-d H:i:s'), $result['nome'], $_SESSION['id'], $_SESSION['nome'], $_SESSION['tipo']));
            ?>
            <html lang="pt-br">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <meta name="description" content="">
                    <meta name="author" content="">
                    <link rel="icon" type="image/png" href="../../img/ico.png">
                    <title>Tarefa Concluída!</title>
                    <script>
                        function Deslogar(){
                        Swal.fire({
                        title: 'Tarefa Concluída!',
                        text: 'Tarefa <?php echo $result['nome']; ?> concluída com sucesso.',
                        icon: 'success',
                        showConfirmButton: false
                        })
                        }
                    </script>
                    <script type='text/JavaScript'>
                        setTimeout(function () {
                        window.location = "info_tarefa.php?id=<?php echo $result['id']; ?>"; 
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
                    <title>Erro ao Concluir!</title>
                    <script>
                        function Deslogar(){
                        Swal.fire({
                        title: 'Erro ao Concluir!',
                        text: 'A tarefa não existe ou já foi concluída.',
                        icon: 'error',
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
                <title>Erro ao Concluir!</title>
                <script>
                    function Deslogar(){
                    Swal.fire({
                    title: 'Erro ao Concluir!',
                    text: 'A tarefa não existe ou já foi concluída.',
                    icon: 'error',
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
        <?php
    }
    Database::disconnect();
} 

