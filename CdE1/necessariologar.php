<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Realize o Login!</title>
        <script>
            function Deslogar(){
            Swal.fire({
            title: 'Realize o Login! 🔐',
            text: 'Para acessar o sistema é necessário efetuar o login.',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Efetuar Login',
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


