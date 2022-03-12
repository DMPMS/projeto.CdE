<?php
function cardAtualizacoesUsuarios($pdo, $sqlAtualizacoesUsuarios)
{
    echo '
    <div class="col-lg-7 col-md-12">
        <div class="card shadow-lg">
            <div class="card-header">
                <h3>Últimas Atualizações</h3>';
    cardHeaderAtualizacoesUsuarios();
    echo '
            </div>
            <div class="card-body feeds-widget" style="overflow: auto; max-height: 350px;">';
    foreach ($pdo->query($sqlAtualizacoesUsuarios) as $row) {
        cardItemBodyAtualizacoesUsuarios($row);
    }
    echo '
            </div>
        </div>
    </div>';
}

function cardHeaderAtualizacoesUsuarios()
{
    echo '
    <div class="card-header-right">
        <a title="Marcar Como Lidas" href="" class="badge badge-danger" data-toggle="modal" data-target="#marcarComoLidas">10</a>
    </div>';
}

function cardItemBodyAtualizacoesUsuarios($row)
{
    if (qdtAtualizacoesUsuarios() == 0) {
        echo '
        <div class="feed-item">
            <a>
                <div class="feeds-left"><i class="ik ik-x-circle text-primary"></i></div>
                <div class="feeds-body">
                    <h4 class="title text-primary">Nenhuma Atualização</h4>
                    <small>Ainda não há nenhuma atualização disponível.</small>
                </div>
            </a>
        </div>';
    } else if ($row['tipo'] == "Novo Usuário") {
        echo '
        <div class="feed-item">
            <a>
                <div class="feeds-left"><i class="ik ik-plus-circle text-primary"></i></div>
                <div class="feeds-body">
                    <h4 class="title text-primary">Novo(a) ' . tipoUsuario($row['idUsuario']) . ' <small class="float-right text-muted">' . date('d/m/Y \à\s H:i', strtotime($row['dataDeCadastro'])) . '</small></h4>
                    <small><strong>' . nomeUsuario($row['idResponsavel']) . '</strong> cadastrou <strong>' . nomeUsuario($row['idUsuario']) . '</strong>.</small>
                </div>
            </a>
        </div>';
    } else if ($row['tipo'] == "Excluir Usuário") {
        echo '
        <div class="feed-item">
            <a>
                <div class="feeds-left"><i class="ik ik-plus-circle text-primary"></i></div>
                <div class="feeds-body">
                    <h4 class="title text-primary">' . tipoUsuario($row['idUsuario']) . ' Excluído(a)<small class="float-right text-muted">' . date('d/m/Y \à\s H:i', strtotime($row['dataDeCadastro'])) . '</small></h4>
                    <small><strong>' . nomeUsuario($row['idResponsavel']) . '</strong> excluiu <strong>' . nomeUsuario($row['idUsuario']) . '</strong>.</small>
                </div>
            </a>
        </div>';
    }
}

function cardNovosClientes($pdo, $sqlNovosUsuarios)
{
    echo '
    <div class="col-lg-5 col-md-12">
        <div class="card new-cust-card shadow-lg">
            <div class="card-header">
                <h3>Novos Clientes</h3>
            </div>
            <div class="card-block" style="max-height: 350px;">';
    if (qtdUsuarios() == 0) {
        echo '
                <a>
                    <div class="align-middle mb-25">
                        <img src="../../dist/img/default-usuario.jpg" class="rounded-circle align-top mr-15" style="height: 40px; width: 40px;">
                        <div class="d-inline-block">
                            <h6>Nenhum Usuário Cadastrado</h6>
                            <p class="text-muted mb-0">Nenhum Usuário Cadastrado</p>
                        </div>
                    </div>
                </a>';
    } else {
        foreach ($pdo->query($sqlNovosUsuarios) as $row) {
            echo '
                <a title="Dados" href="" data-toggle="modal" data-target="#Dados' . $row['id'] . '">
                    <div class="align-middle mb-25">
                        <img src="../../dist/img/usuarios/' . $row['id'] . '.png" class="rounded-circle align-top mr-15" style="height: 40px; width: 40px;">
                        <div class="d-inline-block">
                            <h6>' . $row['nome'] . '</h6>
                            <p class="text-muted mb-0">' . tipoUsuario($row['id']) . '</p>
                            <span class="status text-muted">' . date('d/m/Y \à\s H:i', strtotime($row['dataDeCadastro'])) . '</span>
                        </div>
                    </div>
                </a>';
        }
    }
    echo '
            </div>
        </div>
    </div>';

    echo '
    <!--Modais de Dados-->';
    foreach ($pdo->query($sqlNovosUsuarios) as $row) {
        if ($row['tipo'] == "Administrador") {
            modalAdministrador($row, ['../../dist/img/usuarios/' . $row['id'] . '.png']);
        } else {
            modalCliente($row, ['../../dist/img/usuarios/' . $row['id'] . '.png']);
        }
    }
    echo '
    <!--/Modais de Dados-->';
}
