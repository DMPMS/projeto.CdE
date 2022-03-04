<!DOCTYPE html>
<?php
session_start();

require_once("database.php");
$pdo = Database::connect();

include_once("funcoes.php");

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (isset($data['entrar']) == "Entrar") {
  logar($data['email'], $data['senha']);
}

?>
<html>

<head>
  <title>CdE4 - Entrar</title>
  <link rel="icon" href="dist/img/icone.png" type="image/x-icon" />
  <link rel="stylesheet" href="dist/css/style.css">

  <!--jQuery Toast-->
  <link rel="stylesheet" href="plugins/jquery-toast/css/jquery.toast.min.css">

  <?php notificacaoEntrar(); ?>
</head>

<body>
  <div class="wrapper">
    <div class="title">CdE4 - Entrar</div>
    <form method="POST">
      <div class="field">
        <input name="email" type="text" required="">
        <label>E-mail</label>
      </div>
      <div class="field">
        <input name="senha" type="password" required="">
        <label>Senha</label>
      </div>
      <br>
      <div class="field">
        <input name="entrar" type="submit" value="Entrar">
      </div>
    </form>
  </div>
  <!--jQuery-->
  <script src="plugins/jquery/js/jquery-3.3.1.min.js"></script>
  <!--jQuery Toast-->
  <script src="plugins/jquery-toast/js/jquery.toast.min.js"></script>
</body>

</html>