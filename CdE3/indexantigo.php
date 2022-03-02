<!DOCTYPE html>
<?php
session_start();
include_once 'database.php';
$pdo = Database::connect();

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (isset($data['entrar']) == "entrar") {
    $email = $data['email'];
    $senha = $data['senha'];

    $sql = "SELECT * FROM usuario_usuarios WHERE email = :email";

    $records = $pdo->prepare($sql);
    $records->bindParam(':email', $email);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    $contar = is_array($result) ? count($result) : 0;

    if ($contar > 0 && ($senha == $result['senha']) && $result['ativo'] == 0) {
        $_SESSION['id'] = $result['id'];
        $_SESSION['nome'] = $result['nome'];
        $_SESSION['foto'] = $result['foto'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['tipo'] = $result['tipo'];

        if ($_SESSION['tipo'] == "Administrador Geral" OR $_SESSION['tipo'] == "Administrador") {
            echo '<script> window.location = "home.php"; </script>';
        }
    } else {
        $incorreto = true;
    }
}
Database::disconnect();
?>

<html lang="en">
    <head>
        <!--Meta-->
        <meta charset="utf-8">
        <meta name="description" content="" >
        <meta name="author" content="">
        <meta name="keywords" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Meta Responsiva-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--Ícone-->
        <link rel="icon" type="image/png" href="ico.png">
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="plugins/login/bootstrap.min.css">
        <!--Custom style.css-->
        <link rel="stylesheet" href="plugins/login/style.css">
        <!--Font Awesome-->
        <link rel="stylesheet" href="plugins/login/fontawesome-all.min.css">
        <link rel="stylesheet" href="plugins/login/fontawesome.css">
        <!--Ícones-->
        <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
        <!--Pra Notificação-->
        <link rel="stylesheet" href="plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
        <title>CdE3 - Entrar</title>
        <!--Notificação Negado-->
        <?php if (isset($incorreto)) { ?>
            <script>
                window.onload = function () {
                    $.toast({
                        heading: 'Erro',
                        text: 'Acesso Negado',
                        icon: 'error',
                        loader: false,
                        position: 'top-right'
                    })
                }
            </script>
        <?php } ?>
    </head>
    <body style="background-color: blue">
        <div class="container-fluid login-wrapper">
            <div class="login-box">
                <div class="row justify-content-center">
                    <div class="col-sm-6 login-box-form">
                        <h1 class="text-center mb-4"><img src="ico.png" width=80 height=80> CdE3</h1>
                        <h3>Entrar</h3>
                        <small class="bc-description">Entre com suas credenciais</small>
                        <form class="mt-2" method="POST">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ik ik-user"></i></span>
                                </div>
                                <input name="email" type="email" class="form-control" placeholder="E-mail" required="" value="<?php
                                if (isset($data)) {
                                    echo $data['email'];
                                }
                                ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ik ik-lock"></i></span>
                                </div>
                                <input name="senha" type="password" class="form-control"  placeholder="Senha" required="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-theme btn-block p-2 mb-1" name="entrar" value="entrar">Entrar</button>
                                <a href="#">
                                    <small class="text-theme"><strong>Esqueceu a senha?</strong></small>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
        <!--jQuery-->
        <script src="src/js/vendor/jquery-3.3.1.min.js"></script>
        <!--Pra Notificação-->
        <script src="plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    </body>
</html>