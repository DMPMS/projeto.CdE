<?php
require 'connection.php';
date_default_timezone_set('America/Fortaleza');

if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "index.php"; </script>';
} else {

    function TipoUsuario($idUsuario)
    {
        $pdo = Database::connect();
        $sql = "SELECT tipo FROM usuario_usuarios WHERE id = $idUsuario";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['tipo'];
    }

    function NomeUsuario($idUsuario)
    {
        $pdo = Database::connect();
        $sql = "SELECT nome FROM usuario_usuarios WHERE id = $idUsuario";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['nome'];
    }

    function NomeProduto($idProduto)
    {
        $pdo = Database::connect();
        $sql = "SELECT nome FROM produto_produtos WHERE id = $idProduto";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['nome'];
    }

    function NomeTipo($idTipo)
    {
        $pdo = Database::connect();
        $sql = "SELECT nome FROM produto_tipos WHERE id = $idTipo";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['nome'];
    }

    function PrecoProduto($idProduto)
    {
        $pdo = Database::connect();
        $sql = "SELECT preco FROM produto_produtos WHERE id = $idProduto";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['preco'];
    }

    function QtdUsuarios()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE tipo IN('Administrador','Cliente') AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdAdministradores()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE tipo IN('Administrador') AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdClientes()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE tipo IN('Cliente') AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdClientesDoAdministrador($idAdministrador)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE id_responsavel = $idAdministrador AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdProdutos()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM produto_produtos WHERE ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdTipos()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM produto_tipos WHERE ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdProdutosDoTipo($idTipo)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM produto_produtos WHERE id_tipo LIKE '%({$idTipo})%'AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdProdutosSemEstoque()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM produto_produtos WHERE unidades = 0 AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdVendas()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM venda_vendas WHERE ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdVendasCanceladas()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM venda_vendas WHERE ativo = 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function AlterarUnidadesDoProduto($idProduto, $unidades)
    {
        $pdo = Database::connect();
        $sql = "UPDATE produto_produtos SET unidades = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($unidades, $idProduto));
    }

    function UnidadesDoProduto($idProduto)
    {
        $pdo = Database::connect();
        $sql = "SELECT unidades FROM produto_produtos WHERE id = $idProduto";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['unidades'];
    }

    

    function DescontoDaVenda($idProduto)
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM venda_vendas WHERE id = $idProduto";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return array($result['tipo_desconto'], $result['desconto']);
    }

    function TotalDaVendaSemDesconto($idVenda)
    {
        $pdo = Database::connect();
        $sql = "SELECT SUM(qtd * preco) as total FROM venda_produtos WHERE id_venda = $idVenda";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    function TotalDaVendaComDesconto($idVenda)
    {
        $pdo = Database::connect();
        $sql = "SELECT SUM(qtd * preco) as total FROM venda_produtos WHERE id_venda = $idVenda";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);

        if (DescontoDaVenda($idVenda)[0] == "EmPorcentagem") {
            return $result['total'] * (1 - (DescontoDaVenda($idVenda)[1] / 100));
        } else if (DescontoDaVenda($idVenda)[0] == "EmReais") {
            return $result['total'] - DescontoDaVenda($idVenda)[1];
        } else {
            return $result['total'];
        }
    }

    function UltimoIdUsuario()
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM usuario_usuarios ORDER BY id DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    function UltimoIdProduto()
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM produto_produtos ORDER BY id DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    function UltimoIdTipo()
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM produto_tipos ORDER BY id DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    function UltimoIdVenda()
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM venda_vendas ORDER BY id DESC LIMIT 1";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    function QtdAtualizacoesUsuarios()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM atualizacao_atualizacoes WHERE tipo IN('Usuário') AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdAtualizacoesProdutos()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM atualizacao_atualizacoes WHERE tipo IN('Produto') AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdAtualizacoesUsuariosNaoVizualidado()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM atualizacao_atualizacoes WHERE tipo IN('Usuário') AND ids_vizualizados NOT LIKE '%.{$_SESSION['id']}.%' AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdAtualizacoesProdutosNaoVizualidado()
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM atualizacao_atualizacoes WHERE tipo IN('Produto') AND ids_vizualizados NOT LIKE '%.{$_SESSION['id']}.%' AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdClientesCadastradosNoMes($data)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE criadoem LIKE '%$data%' AND tipo IN('Cliente')";

        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdAdministradoresCadastradosNoMes($data)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE criadoem LIKE '%$data%' AND tipo IN('Administrador')";

        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdProdutosCadastradosNoMes($data)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM produto_produtos WHERE criadoem LIKE '%$data%'";

        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdTiposCadastradosNoMes($data)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM produto_tipos WHERE criadoem LIKE '%$data%'";

        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdVendasCadastradasNoMes($data)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM venda_vendas WHERE criadoem LIKE '%$data%' AND ativo = 0";

        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function QtdVendasCanceladasCadastradasNoMes($data)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM venda_vendas WHERE criadoem LIKE '%$data%' AND ativo = 1";

        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function UsuarioExiste($idUsuario)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM usuario_usuarios WHERE id = $idUsuario AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function TipoExiste($idTipo)
    {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) as total FROM produto_tipos WHERE id = $idTipo AND ativo = 0";
        $records = $pdo->prepare($sql);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    //Pegar registros dentro de 1 semana;
    //$sqlAtualizacao = "SELECT * FROM atualizacao_atualizacoes WHERE tipo = 'Usuário' AND ativo = 0 AND CAST(criadoem AS DATE) BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE() ORDER BY id DESC";
}
?>
<style type="text/css">
    a.semsublinhar:link {
        text-decoration: none;
    }
</style>
<style type="text/css">
    button.semborda:focus {
        outline: 0;
        -webkit-box-shadow: none;
    }
</style>