<!doctype html>
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
            $_SESSION['Bem-vindo'] = True;
            echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location = "home.php");
                }
            </script>';
        }
    } else {
        $_SESSION['Negado'] = True;
        echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>';
    }
}
Database::disconnect();
?>
<html class="no-js" lang="en">
    <head>
        <title>CdE3 - Entrar</title>
        <!--Ícone-->
        <link rel="icon" href="ico.png" type="image/x-icon" />
        <!--Fonte-->
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        <!--Bootstrap-->
        <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
        <!--Ik Ícones-->
        <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
        <!--Pra Notificação-->
        <link rel="stylesheet" href="plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
        <!--Theme CSS-->
        <link rel="stylesheet" href="dist/css/theme.min.css">
        <!--Notificação Acesso Negado-->
        <?php if (isset($_SESSION['Negado'])) { ?>
            <script>
                window.onload = function () {
                    $.toast({
                        text: 'Acesso Negado.',
                        icon: 'error',
                        hideAfter: 5000,
                        loader: false,
                        position: 'top-right'
                    })
                }
            </script>
            <?php
            unset($_SESSION['Negado']);
        }
        ?>
        <?php if (isset($_SESSION['Entrar'])) { ?>
            <script>
                window.onload = function () {
                    $.toast({
                        text: 'Entre com suas credenciais.',
                        icon: 'warning',
                        hideAfter: 5000,
                        loader: false,
                        position: 'top-right'
                    })
                }
            </script>
            <?php
            unset($_SESSION['Entrar']);
        }
        ?>
    </head>
    <body style="background-color: #333e52;">
        <div class="auth-wrapper">
            <!--Principal-->
            <div class="container-fluid">
                <div class="row flex-row mt-3">
                    <div class="col-lg-12 col-md-12 p-0">
                        <div class="authentication-form mx-auto col-sm-3">
                            <div class="card col-sm-12 p-3 shadow-lg">
                                <div class="text-center">
                                    <h1><img src="ico.png" width=80 height=80> <b>CdE3</b></h1>
                                </div>
                                <h3><b>Entrar</b></h3>
                                <p>Entre com suas credenciais</p>
                                <form method="POST">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ik ik-user"></i></span>
                                        </div>
                                        <input name="email" type="text" class="form-control" placeholder="E-mail" required="">
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ik ik-lock"></i></span>
                                        </div>
                                        <input name="senha" type="password" class="form-control" placeholder="Senha" required="">
                                    </div>
                                    <div class="form-group">
                                        <button name="entrar" type="submit" class="btn btn-dark btn-block" value="entrar">Entrar</button>
                                    </div>
                                    <div class="row">
                                        <div class="col text-left">
                                            <a href="#" class="text-facebook">Esqueceu a senha?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Principal-->
        </div>
        <!--jQuery-->
        <script src="src/js/vendor/jquery-3.3.1.min.js"></script>
        <!--Pra Notificação-->
        <script src="plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    </body>
</html>
