<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="img/ico.png">
        <title>Página Indisponível!</title>
        <script>
            function Deslogar(){
            Swal.fire({
            title: 'Página Indisponível!',
            text: 'Você não tem permissão para acessar esta página.',
            icon: 'warning',
            showConfirmButton: false
            })
            }
        </script>
        <script type='text/JavaScript'>
            setTimeout(function () {
            window.location = history.back(); 
            }, 2500); 
        </script>
        <link href="js/sweet/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <body id="page-top" onload="Deslogar()" class="bg-gradient-primary">
        <script src="js/sb-admin-2.min.js"></script>
        <script src="js/sweet/sweetalert2.all.min.js"></script>
    </body>
</html>


