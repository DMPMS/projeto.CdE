<?php
function modalSair()
{
    echo '
    <div class="modal fade" id="Sair">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sair</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    Deseja realmente sair?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <button type="button" class="btn btn-primary" onclick="Sair()">Sim</button>
                </div>
            </div>
        </div>
    </div>';
}

function modalCliente($row, $caminhoFoto)
{
    echo '
    <div class="modal fade" id="Dados' . $row['id'] . '">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dados: <strong>' . $row['nome'] . '</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">';
    fotoDoModal([12], $caminhoFoto);
    echo '
                    </div>
                    <div class="row">';
    formInput(["", 3, ""], ["Data de Cadastro"], [false, "", ""], ["", "", "text", "", date('d/m/Y \à\s H:i', strtotime($row['dataDeCadastro'])), false, false, true]);
    formInput(["", 4, ""], ["Responsável pelo Cadastro"], [false, "", ""], ["", "", "text", "", nomeUsuario($row['idResponsavel']), false, false, true]);
    formInput(["", 2, ""], ["Compras"], [false, "", ""], ["", "", "text", "", 1234, false, false, true]);
    formInput(["", 3, ""], ["Dinheiro em Compras"], [false, "", ""], ["", "", "text", "", "R$ 12.000,00", false, false, true]);
    echo '
                    </div>
                    <div class="row">';
    formInput(["", 4, ""], ["Nome"], [false, "", ""], ["", "", "text", "", $row['nome'], false, false, true]);
    formInput(["", 4, ""], ["E-mail"], [false, "", ""], ["", "", "text", "", $row['email'], false, false, true]);
    formInput(["", 4, ""], ["Tipo"], [false, "", ""], ["", "", "text", "", $row['tipo'], false, false, true]);
    echo '
                    </div>
                    <div class="row">';
    formInput(["", 3, ""], ["CPF"], [false, "", ""], ["", "", "text", "", $row['cpf'], false, false, true]);
    formInput(["", 5, ""], ["Endereço"], [false, "", ""], ["", "", "text", "", $row['endereco'], false, false, true]);
    formInput(["", 4, ""], ["Contato"], [false, "", ""], ["", "", "text", "", $row['contato'], false, false, true]);
    echo '
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>';
}

function modalAdministrador($row, $caminhoFoto)
{
    echo '
    <div class="modal fade" id="Dados' . $row['id'] . '">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dados: <strong>' . $row['nome'] . '</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">';
    fotoDoModal([12], $caminhoFoto);
    echo '
                    </div>
                    <div class="row">';
    formInput(["", 3, ""], ["Data de Cadastro"], [false, "", ""], ["", "", "text", "", date('d/m/Y \à\s H:i', strtotime($row['dataDeCadastro'])), false, false, true]);
    formInput(["", 4, ""], ["Responsável pelo Cadastro"], [false, "", ""], ["", "", "text", "", nomeUsuario($row['idResponsavel']), false, false, true]);
    formInput(["", 2, ""], ["Compras"], [false, "", ""], ["", "", "text", "", 1234, false, false, true]);
    formInput(["", 3, ""], ["Dinheiro em Vendas"], [false, "", ""], ["", "", "text", "", "R$ 12.000,00", false, false, true]);
    echo '
                    </div>
                    <div class="row">';
    formInput(["", 3, ""], ["Clientes Cadastrados"], [false, "", ""], ["", "", "text", "", 25, false, false, true]);
    formInput(["", 3, ""], ["Tarefas Designadas"], [false, "", ""], ["", "", "text", "", 75, false, false, true]);
    echo '
                    </div>
                    <div class="row">';
    formInput(["", 4, ""], ["Nome"], [false, "", ""], ["", "", "text", "", $row['nome'], false, false, true]);
    formInput(["", 4, ""], ["E-mail"], [false, "", ""], ["", "", "text", "", $row['email'], false, false, true]);
    formInput(["", 4, ""], ["Tipo"], [false, "", ""], ["", "", "text", "", $row['tipo'], false, false, true]);
    echo '
                    </div>
                    <div class="row">';
    formInput(["", 3, ""], ["CPF"], [false, "", ""], ["", "", "text", "", $row['cpf'], false, false, true]);
    formInput(["", 5, ""], ["Endereço"], [false, "", ""], ["", "", "text", "", $row['endereco'], false, false, true]);
    formInput(["", 4, ""], ["Contato"], [false, "", ""], ["", "", "text", "", $row['contato'], false, false, true]);
    echo '
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>';
}

function modalExcluirCliente($row, $imgSrc)
{
    echo '
    <div class="modal fade" id="Excluir' . $row['id'] . '">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir: <strong>' . $row['nome'] . '</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12 text-center">
                                <img src="' . $imgSrc[0] . '" class="rounded-circle" width="120px" height="120px">
                            </div>
                        </div>
                        <p>Deseja excluir <b>' . $row['nome'] . '</b>? As compras deste(a) cliente serão mantidas.</p>
                    </div>
                    <input type="hidden" name="id" value="' . $row['id'] . '">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" name="Excluir" value="Excluir"  class="btn btn-danger">Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';
}

function modalExcluirAdministrador($row, $imgSrc)
{
    echo '
    <div class="modal fade" id="Excluir' . $row['id'] . '">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir: <strong>' . $row['nome'] . '</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12 text-center">
                                <img src="' . $imgSrc[0] . '" class="rounded-circle" width="120px" height="120px">
                            </div>
                        </div>
                        <p>Deseja excluir <b>' . $row['nome'] . '</b>? As vendas, tarefas e clientes deste(a) administrador(a) serão mantidas.</p>
                    </div>
                    <input type="hidden" name="id" value="' . $row['id'] . '">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" name="Excluir" value="Excluir"  class="btn btn-danger">Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';
}
