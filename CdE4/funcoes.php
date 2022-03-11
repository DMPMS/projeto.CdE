<?php

function horarioAtual()
{
    date_default_timezone_set('America/Fortaleza');
    return date('Y-m-d H:i:s');
}

function nomeUsuario($idUsuario)
{
    $pdo = Database::connect();
    $sql = "SELECT nome FROM usuarios_usuarios WHERE id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    return $result['nome'];
}

function tipoUsuario($idUsuario)
{
    $pdo = Database::connect();
    $sql = "SELECT tipo FROM usuarios_usuarios WHERE id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    return $result['tipo'];
}

function qtdUsuarios($tipo = "'Administrador','Cliente'")
{
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM usuarios_usuarios WHERE tipo IN($tipo) AND ativo = 0";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    return $result['total'];
}

function formInputSelect2Usuarios()
{
    if (tipoUsuario($_SESSION['id']) == "Administrador Geral") {
        $opcoesEDisabled = [["Cliente", "Administrador"], false];
    } else if (tipoUsuario($_SESSION['id']) == "Administrador") {
        $opcoesEDisabled = [["Cliente"], true];
    }

    return $opcoesEDisabled;
}

function marcarAtualizacoesComoLidas($tabela)
{
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE " . $tabela . " SET idsQueVizualizaram = CONCAT(idsQueVizualizaram, ?) WHERE idsQueVizualizaram NOT LIKE '%." . $_SESSION['id'] . ".%' AND tipo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array(".{$_SESSION['id']}.", "Usuário"));
    Database::disconnect();

    $_SESSION['MarcadasComoLidas'] = True;
    redirecionarPara("", true);
}

function NovoUsuario($data)
{
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO usuarios_usuarios (nome,email,senha,tipo,contato,cpf,endereco,idResponsavel,dataDeCadastro) values(?,?,?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);

    $ultimoIdUsuario = ultimoIdUsuario() + 1;
    $data['email'] = strtolower($data['email']);

    if ($_FILES['foto']['name'] != '') {
        $novo_nome = $ultimoIdUsuario . ".png";
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../dist/img/usuarios/" . $novo_nome);
    } else {
        $novo_nome = $ultimoIdUsuario . ".png";
        copy("../../dist/img/default-usuario.jpg", "../../dist/img/usuarios/" . $novo_nome);
    }

    if (tipoUsuario($_SESSION['id']) == "Administrador") {
        $data['tipo'] = 'Cliente';
        $data['senha'] = '';
    }

    if ($data['tipo'] == "Cliente") {
        $data['senha'] = '';
    }

    $q->execute(array($data['nome'], $data['email'], $data['senha'], $data['tipo'], $data['contato'],  $data['cpf'], $data['endereco'], $_SESSION['id'], horarioAtual()));

    novaAtualizacaoUsuario(["Novo " . $data['tipo'], $ultimoIdUsuario, $_SESSION['id'], "." . $_SESSION['id'] . ".", horarioAtual()]);

    if ($data['tipo'] == "Cliente") {
        $_SESSION['UsuarioCadastrado'] = ultimoIdUsuario();;
        redirecionarPara("usuarios.clientes.php", false);
    } else {
        $_SESSION['UsuarioCadastrado'] = ultimoIdUsuario();
        redirecionarPara("usuarios.administradores.php", false);
    }

    Database::disconnect();
}

function ExcluirUsuario($data)
{
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE usuarios_usuarios SET ativo = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array(1, $data['id']));

    novaAtualizacaoUsuario(["Excluir " . tipoUsuario($data['id']), $data['id'],  $_SESSION['id'], "." . $_SESSION['id'] . ".", horarioAtual()]);
    Database::disconnect();

    $_SESSION['UsuarioExcluido'] = $data['id'];
    redirecionarPara("", true);
}

function novaAtualizacaoUsuario($dados)
{
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO usuarios_atualizacoes (tipo,idUsuario,idResponsavel,idsQueVizualizaram,dataDeCadastro) values(?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($dados[0], $dados[1], $dados[2], $dados[3], $dados[4]));
    Database::disconnect();
}

function ultimoIdUsuario()
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM usuarios_usuarios ORDER BY id DESC LIMIT 1";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    return $result['id'];
}
