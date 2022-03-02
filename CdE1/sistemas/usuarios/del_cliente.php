<?php
//

include_once '../../database.php';
session_start();

if (@$_SESSION['id'] == '') {
    echo '<script>
            window.location = "../../necessariologar.php";
        </script>';
} else {
    $pdo = Database::connect();
    if ($_GET) {
        $idCliente = $_GET['id'];
        $sql = "SELECT * FROM cde_usuario WHERE id = $idCliente";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        if ($result != null) {
            $nome = $result['nome'];
            unlink("fotos/" . $result['foto']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM cde_usuario WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($idCliente));
            
            $sql2 = "DELETE FROM cde_venda_detalhe WHERE id_cliente = ?";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($idCliente));
            
            $sql3 = "DELETE FROM cde_venda WHERE id_cliente = ?";
            $q3 = $pdo->prepare($sql3);
            $q3->execute(array($idCliente));
            ?>
            <html lang="pt-br">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <meta name="description" content="">
                    <meta name="author" content="">
                    <title>Cliente Excluído!</title>
                    <script>
                        function Deslogar(){
                        Swal.fire({
                        title: 'Cliente Excluído! 🗑',
                        text: '<?php echo $nome ?> excluído(a) com sucesso.',
                        icon: 'success',
                        showConfirmButton: false
                        })
                        }
                    </script>
                    <script type='text/JavaScript'>
                        setTimeout(function () {
                        window.location = 'list_cliente.php'; 
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
                        text: 'O cliente não existe.',
                        icon: 'error',
                        showConfirmButton: false
                        })
                        }
                    </script>
                    <script type='text/JavaScript'>
                        setTimeout(function () {
                        window.location = 'list_cliente.php'; 
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
        <?php }
    } else { ?>
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
                    text: 'O cliente não existe.',
                    icon: 'error',
                    showConfirmButton: false
                    })
                    }
                </script>
                <script type='text/JavaScript'>
                    setTimeout(function () {
                    window.location = 'list_cliente.php'; 
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
