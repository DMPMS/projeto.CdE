<?php
require 'connection.php';
date_default_timezone_set('America/Fortaleza');

$dia = date('d/m/Y');
$semana = date('\S:W\.');
$mes = date('m/Y');
$ano = date('Y');

$DataVenda = date('\S:W\. d/m/Y \à\s H:i');


$ConsUsuario = ler("cde_usuario", "ORDER BY nome ASC");
$ConsTipoPoduto = ler("cde_produto_tipo", "ORDER BY nome ASC");

function MesAtual() {
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    echo strftime('%B', strtotime('today'));
}

function AnoAtual() {
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    echo strftime('%Y', strtotime('today'));
}

function NomeUsuario($idUsuario) {
    $pdo = Database::connect();
    $sql = "SELECT nome FROM cde_usuario WHERE id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['nome'];
}

function NomeCliente($idCliente) {
    $pdo = Database::connect();
    $sql = "SELECT nome FROM cde_usuario WHERE id = $idCliente";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    if ($result == null) {
        return "Usuário Removido";
    } else {
        return $result['nome'];
    }
}

function NomeProduto($idProduto) {
    $pdo = Database::connect();
    $sql = "SELECT nome FROM cde_produto WHERE id = $idProduto";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['nome'];
}

function FotoUsuario($idUsuario) {
    $pdo = Database::connect();
    $sql = "SELECT foto FROM cde_usuario WHERE id = $idUsuario";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['foto'];
}

function QtdCompras($idCliente) {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM cde_venda_detalhe WHERE id_cliente = $idCliente";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

function QtdVendidaProduto($idProduto) {
    $pdo = Database::connect();
    $sql = "SELECT SUM(qtd_produto) as total FROM cde_venda WHERE id_produto = $idProduto";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        return $result['total'];
    } else {
        return 0;
    }
}

function QtdVendasProduto($idProduto) {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM cde_venda WHERE id_produto = $idProduto";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

function ReceitaCliente($idCliente) {
    $pdo = Database::connect();
    $sql = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE id_cliente = $idCliente";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        return $result['total'];
    } else {
        return 0;
    }
}

function ReceitaProduto($idProduto) {
    $pdo = Database::connect();
    $sql = "SELECT * FROM cde_venda WHERE id_produto = $idProduto";

    $total = 0;
    foreach ($pdo->query($sql) as $row) {
        $total += $row['preco_produto'] * $row['qtd_produto'];
    }

    if ($total > 0) {
        return $total;
    } else {
        return 0;
    }
}

function ReceitaDiaria() {
    $dia = date('d/m/Y');
    $pdo = Database::connect();
    $sql = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$dia%'";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        return $result['total'];
    } else {
        return 0;
    }
}

function ReceitaSemanal() {
    $semana = date('\S:W\.');
    $ano = date('Y');

    $pdo = Database::connect();
    $sql = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$semana%' AND criadoem LIKE '%$ano%'";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        return $result['total'];
    } else {
        return 0;
    }
}

function ReceitaMensal() {
    $mes = date('m/Y');
    $pdo = Database::connect();
    $sql = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$mes%'";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        return $result['total'];
    } else {
        return 0;
    }
}

function ReceitaAnual() {
    $ano = date('Y');
    $pdo = Database::connect();
    $sql = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$ano%'";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        return $result['total'];
    } else {
        return 0;
    }
}

function GraficoAnual() {
    $jan = "01/" . date('Y');
    $fev = "02/" . date('Y');
    $mar = "03/" . date('Y');
    $abr = "04/" . date('Y');
    $mai = "05/" . date('Y');
    $jun = "06/" . date('Y');
    $jul = "07/" . date('Y');
    $ago = "08/" . date('Y');
    $set = "09/" . date('Y');
    $out = "10/" . date('Y');
    $nov = "11/" . date('Y');
    $dez = "12/" . date('Y');

    $pdo = Database::connect();

    $jan = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$jan%'";
    $recordsjan = $pdo->prepare($jan);
    $recordsjan->execute();
    $resultjan = $recordsjan->fetch(PDO::FETCH_ASSOC);

    $fev = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$fev%'";
    $recordsfev = $pdo->prepare($fev);
    $recordsfev->execute();
    $resultfev = $recordsfev->fetch(PDO::FETCH_ASSOC);

    $mar = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$mar%'";
    $recordsmar = $pdo->prepare($mar);
    $recordsmar->execute();
    $resultmar = $recordsmar->fetch(PDO::FETCH_ASSOC);

    $abr = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$abr%'";
    $recordsabr = $pdo->prepare($abr);
    $recordsabr->execute();
    $resultabr = $recordsabr->fetch(PDO::FETCH_ASSOC);

    $mai = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$mai%'";
    $recordsmai = $pdo->prepare($mai);
    $recordsmai->execute();
    $resultmai = $recordsmai->fetch(PDO::FETCH_ASSOC);

    $jun = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$jun%'";
    $recordsjun = $pdo->prepare($jun);
    $recordsjun->execute();
    $resultjun = $recordsjun->fetch(PDO::FETCH_ASSOC);

    $jul = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$jul%'";
    $recordsjul = $pdo->prepare($jul);
    $recordsjul->execute();
    $resultjul = $recordsjul->fetch(PDO::FETCH_ASSOC);

    $ago = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$ago%'";
    $recordsago = $pdo->prepare($ago);
    $recordsago->execute();
    $resultago = $recordsago->fetch(PDO::FETCH_ASSOC);

    $set = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$set%'";
    $recordsset = $pdo->prepare($set);
    $recordsset->execute();
    $resultset = $recordsset->fetch(PDO::FETCH_ASSOC);

    $out = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$out%'";
    $recordsout = $pdo->prepare($out);
    $recordsout->execute();
    $resultout = $recordsout->fetch(PDO::FETCH_ASSOC);

    $nov = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$nov%'";
    $recordsnov = $pdo->prepare($nov);
    $recordsnov->execute();
    $resultnov = $recordsnov->fetch(PDO::FETCH_ASSOC);

    $dez = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$dez%'";
    $recordsdez = $pdo->prepare($dez);
    $recordsdez->execute();
    $resultdez = $recordsdez->fetch(PDO::FETCH_ASSOC);

    return $resultjan['total'] . "," . $resultfev['total'] . "," . $resultmar['total'] . "," . $resultabr['total'] . "," . $resultmai['total'] . "," . $resultjun['total'] . "," .
            $resultjul['total'] . "," . $resultago['total'] . "," . $resultset['total'] . "," . $resultout['total'] . "," . $resultnov['total'] . "," . $resultdez['total'];
}

function ReceitaTotal() {
    $pdo = Database::connect();
    $sql = "SELECT SUM(valor) as total FROM cde_venda_detalhe";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        return $result['total'];
    } else {
        return 0;
    }
}

function NumProximaVenda() {
    $pdo = Database::connect();
    $sql = "SELECT num_venda FROM cde_venda_detalhe ORDER BY num_venda DESC LIMIT 1";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['num_venda'];
}

function NumUltimoProduto() {
    $pdo = Database::connect();
    $sql = "SELECT id FROM cde_produto ORDER BY id DESC LIMIT 1";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
}

function NumUltimaTarefa() {
    $pdo = Database::connect();
    $sql = "SELECT id FROM cde_tarefa ORDER BY id DESC LIMIT 1";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
}

function NumUltimoUsuario() {
    $pdo = Database::connect();
    $sql = "SELECT id FROM cde_usuario ORDER BY id DESC LIMIT 1";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
}

function QtdClientes() {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM cde_usuario WHERE tipo = 'Cliente'";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdUsuarios() {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM cde_usuario WHERE tipo NOT IN('Administrador Geral')";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdAdministradores() {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM cde_usuario WHERE tipo = 'Administrador'";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdProdutos() {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM cde_produto";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdVendas() {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM cde_venda_detalhe";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdTarefas() {
    $pdo = Database::connect();
    if ($_SESSION['tipo'] == "Administrador Geral") {
        $sql = "SELECT COUNT(*) as total FROM cde_tarefa";
    } else {
        $sql = "SELECT COUNT(*) as total FROM cde_tarefa WHERE id_responsavel IN(0," . $_SESSION['id'] . ")";
    }
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdTarefasPendentes() {
    $pdo = Database::connect();
    if ($_SESSION['tipo'] == "Administrador Geral") {
        $sql = "SELECT COUNT(*) as total FROM cde_tarefa WHERE status = 'Pendente'";
    } else {
        $sql = "SELECT COUNT(*) as total FROM cde_tarefa WHERE status = 'Pendente' AND id_responsavel IN(0," . $_SESSION['id'] . ")";
    }
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdTarefasConcluidas() {
    $pdo = Database::connect();
    if ($_SESSION['tipo'] == "Administrador Geral") {
        $sql = "SELECT COUNT(*) as total FROM cde_tarefa WHERE status = 'Concluída'";
    } else {
        $sql = "SELECT COUNT(*) as total FROM cde_tarefa WHERE status = 'Concluída' AND id_responsavel IN(0," . $_SESSION['id'] . ")";
    }
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function PorcentagemTarefas() {
    $pdo = Database::connect();
    if ($_SESSION['tipo'] == "Administrador Geral") {
        $sql = "SELECT COUNT(*) as total FROM cde_tarefa";
    } else {
        $sql = "SELECT COUNT(*) as total FROM cde_tarefa WHERE id_responsavel IN(0," . $_SESSION['id'] . ")";
    }
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    if ($_SESSION['tipo'] == "Administrador Geral") {
        $sqlConcluidas = "SELECT COUNT(*) as total FROM cde_tarefa WHERE status = 'Concluída'";
    } else {
        $sqlConcluidas = "SELECT COUNT(*) as total FROM cde_tarefa WHERE status = 'Concluída' AND id_responsavel IN(0," . $_SESSION['id'] . ")";
    }
    $recordsConcluidas = $pdo->prepare($sqlConcluidas);
    $recordsConcluidas->execute();
    $resultConcluidas = $recordsConcluidas->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] == 0) {
        return 0;
    } else {
        return ($resultConcluidas['total'] / $result['total']) * 100;
    }
}

function QtdVendasMensal() {
    $mes = date('m/Y');
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$mes%'";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdVendasAnual() {
    $ano = date('Y');
    $pdo = Database::connect();
    $sql = "SELECT SUM(valor) as total FROM cde_venda_detalhe WHERE criadoem LIKE '%$ano%'";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function QtdTipos() {
    $pdo = Database::connect();
    $sql = "SELECT COUNT(*) as total FROM cde_produto_tipo";
    $records = $pdo->prepare($sql);
    $records->execute();
    $result = $records->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

//função conexão
function conectar() {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link):
        mysqli_set_charset($link, "utf8");
        return $link;
    else:
        return 'Erro ao conectar: ' . mysqli_connect_error($link);
    endif;
}

function cadastrar($tabela, array $dados) {
    $con = conectar();
    $campos = implode(", ", array_keys($dados));
    $valores = "'" . implode("', '", array_values($dados)) . "'";
    $query = "INSERT INTO {$tabela}({$campos})VALUES({$valores})";

    $cadastrar = mysqli_query($con, $query);

    if ($cadastrar):
        return mysqli_insert_id($con);
    else:
        return mysqli_error($con);
    endif;
}

function ler($tabela, $condicao = null) {
    $con = conectar();
    $query = "SELECT * FROM {$tabela} {$condicao}";
    $ler = mysqli_query($con, $query);
    if ($ler):
        return $ler;
    else:
        echo 'Erro ao ler: ' . mysqli_error($con);
    endif;
}

function atualizar($tabela, array $dados, $where) {
    $con = conectar();
    foreach ($dados as $campo => $valor):
        $campos[] = "$campo = '$valor'";
    endforeach;
    $campos = implode(", ", $campos);
    $query = "UPDATE {$tabela} SET $campos WHERE {$where}";
    $atualizar = mysqli_query($con, $query);

    if ($atualizar):
        return mysqli_affected_rows($con);
    else:
        echo 'Erro ao atualizar: ' . mysqli_error($con);
    endif;
}

function delete($tabela, $where) {
    $con = conectar();
    $query = "DELETE FROM {$tabela} WHERE {$where}";
    $delete = mysqli_query($con, $query);
    if ($delete):
        return mysqli_affected_rows($con);
    else:
        return 'Erro ao deletar: ' . mysqli_error($con);
    endif;
}
?>
<style type="text/css"> 
    a.semsublinhar:link 
    { 
        text-decoration:none; 
    } 
</style>
<style type="text/css"> 
    button.semborda:focus {
        outline: 0;
        -webkit-box-shadow: none;
    }
</style>
