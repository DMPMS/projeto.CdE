<?php
function sair($caminho)
{
    echo '
    <script>
        function Sair() {
            window.location = "' . $caminho . '";
        }
    </script>';
}

function mascaraCPF($inputId)
{
    echo '
    <script>
        $(document).ready(function() {
            $("#' . $inputId . '").mask("999.999.999-99");
        });
    </script>';
}

function mascaraContato($inputId)
{
    echo '
    <script>
        $(document).ready(function() {
            $("#' . $inputId . '").mask("(99) 99999-9999");
        });
    </script>';
}

function usuariosConfiguracaoDeCampos()
{
    echo '
    <script>
        $("#tipo").change(function() {
            if (this.value == "Administrador") {
                $("#mostrarSenha").show();
                $("#mostrarAsterisco").show();
                $("#email").attr("required", "required");
                $("#senha").attr("required", "required");
            } else {
                $("#mostrarSenha").hide();
                $("#mostrarAsterisco").hide();
                $("#email").removeAttr("required");
                $("#senha").removeAttr("required");
            }
        });
    </script>';
}

function previewDaFoto($imgId)
{
    echo '
    <script>
        function readImage() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("' . $imgId . '").src = e.target.result;
                };
                file.readAsDataURL(this.files[0]);
            }
        }
        document.getElementById("img-input").addEventListener("change", readImage, false);
    </script>';
}

function desabilitarEnterNoFormulario()
{
    echo '
    <script>
        $(document).ready(function() {
            $("input").keypress(function(e) {
                var code = null;
                code = (e.keyCode ? e.keyCode : e.which);
                return (code == 13) ? false : true;
            });
        });
    </script>';
}

function select2($inputId)
{
    echo '
    <script>
        $(document).ready(function() {
            $("#' . $inputId . '").select2();
        });
    </script>';
}

function usuariosVerificarEmail($inputId, $url)
{
    echo '
    <script>
        var email = $("#' . $inputId . '");
        email.blur(function() {
            $.ajax({
                url: "' . $url . '",
                type: "POST",
                data: {
                    "' . $inputId . '": email.val()
                },
                success: function(data) {
                    data = $.parseJSON(data);

                    if (data.email === true) {
                        document.querySelector("#' . $inputId . '").setCustomValidity("O e-mail \'" + email.val() + "\' já está cadastrado.");
                    } else {
                        document.querySelector("#' . $inputId . '").setCustomValidity("");
                    }
                }
            });
        });
    </script>';
}

function scriptDataTablePadrao($tableId)
{
    echo '
    <script>
        $(document).ready(function() {
            $("#' . $tableId . '").DataTable({
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Exibindo _MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });
        });
    </script>';
}

function modalAdministradorCadastrado()
{
    if (isset($_SESSION['UsuarioCadastrado'])) {
        echo '
        <script type="text/javascript">
            $(window).on("load", function() {
                $("#Dados' . $_SESSION['UsuarioCadastrado'] . '").modal("show");
            });
        </script>';

        unset($_SESSION['UsuarioCadastrado']);
    }
}
