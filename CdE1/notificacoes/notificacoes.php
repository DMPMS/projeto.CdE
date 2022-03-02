<?php
include_once("lib/includes.php");
$sqlNotificacao = "SELECT * FROM cde_notificacao WHERE id_responsavel NOT IN (" . $_SESSION['id'] . ") ORDER BY id DESC";

if ($_SESSION['tipo'] == "Administrador Geral") {
    $sqlQtdNotificacao = "SELECT COUNT(*) as total FROM cde_notificacao WHERE visualizado NOT IN ('." . $_SESSION['id'] . ".') AND id_responsavel NOT IN (" . $_SESSION['id'] . ")";
} else {
    $sqlQtdNotificacao = "SELECT COUNT(*) as total FROM cde_notificacao WHERE visualizado NOT IN ('." . $_SESSION['id'] . ".') AND id_responsavel NOT IN (" . $_SESSION['id'] . ") AND tipo NOT IN ('Usuário', 'Venda')";
}
$recordsNotificacao = $pdo->prepare($sqlQtdNotificacao);
$recordsNotificacao->execute();
$resultNotificacao = $recordsNotificacao->fetch(PDO::FETCH_ASSOC);
?>

<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="ClientesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <?php if ($resultNotificacao['total'] > 0) { ?>
            <span class="badge badge-danger badge-counter"><?php echo $resultNotificacao['total']; ?></span>
        <?php } ?>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="ClientesDropdown">
        <h6 class="dropdown-header">
            Notificações
        </h6>
        <div class="scroll" style="height: 250px;">
            <?php
            foreach ($pdo->query($sqlNotificacao) as $row) {
                $idResponsavel = $row['id_responsavel'];

                if ($row['tipo'] == "Usuário" && $row['tipo_responsavel'] == "Administrador") {
                    ?>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:window.open('sistemas/usuarios/info_usuario.php?id=<?php echo $row['id_registro']; ?>', '_blank');">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?> 
                                <?php if (strpos($row['visualizado'], "." . $_SESSION['id'] . ".") === false) { ?><span style=" font-size: 15px; color: red;" >●</span><?php } ?></div>
                            <span><strong><?php echo $row['nome_responsavel']; ?></strong> cadastrou o cliente <strong><?php echo $row['nome']; ?></strong></span>
                        </div>
                    </a>
                <?php } else if ($row['tipo'] == "Produto" && $row['tipo_responsavel'] == "Administrador Geral") { ?>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:window.open('sistemas/produtos/info_produto.php?id=<?php echo $row['id_registro']; ?>', '_blank');">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-box-open text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?> 
                                <?php if (strpos($row['visualizado'], "." . $_SESSION['id'] . ".") === false) { ?><span style=" font-size: 15px; color: red;" >●</span><?php } ?></div>
                            <span>O produto <strong><?php echo $row['nome']; ?></strong> foi cadastrado.</span>
                        </div>
                    </a>
                <?php } else if ($row['tipo'] == "Venda" && $row['tipo_responsavel'] == "Administrador") {
                    ?>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:window.open('sistemas/vendas/info_venda.php?id=<?php echo $row['id_registro']; ?>', '_blank');">
                        <div class="mr-3">
                            <div class="icon-circle bg-info">
                                <i class="fas fa-comment-dollar text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?> 
                                <?php if (strpos($row['visualizado'], "." . $_SESSION['id'] . ".") === false) { ?><span style=" font-size: 15px; color: red;" >●</span><?php } ?></div>
                            <span><strong><?php echo $row['nome_responsavel']; ?></strong> realizou uma venda no valor de <strong><?php echo number_format($row['valor'], 2, ',', '.'); ?></strong>.</span>
                        </div>
                    </a>
                    <?php
                } else if ($row['tipo'] == "Tarefa" && ($row['id_responsavel_tarefa'] == $_SESSION['id'] || $row['id_responsavel_tarefa'] == 0) && $row['tipo_responsavel'] == "Administrador Geral") {
                    ?>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:window.open('sistemas/tarefas/info_tarefa.php?id=<?php echo $row['id_registro']; ?>', '_blank');">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-clipboard-list text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?> 
                                <?php if (strpos($row['visualizado'], "." . $_SESSION['id'] . ".") === false) { ?><span style=" font-size: 15px; color: red;" >●</span><?php } ?></div>
                            <span><strong><?php echo $row['nome_responsavel']; ?></strong> designou uma nova uma tarefa para <?php if ($row['id_responsavel_tarefa'] == 0) { ?> os administradores<?php } else { ?> você<?php } ?>.</span>
                        </div>
                    </a>
                    <?php
                } else if ($row['tipo'] == "Tarefa Concluída" && $_SESSION['tipo'] == "Administrador Geral" && $row['tipo_responsavel'] == "Administrador") {
                    ?>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:window.open('sistemas/tarefas/info_tarefa.php?id=<?php echo $row['id_registro']; ?>', '_blank');">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-clipboard-list text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"><?php echo date('d/m/Y \à\s H:i', strtotime($row['criadoem'])); ?> 
                                <?php if (strpos($row['visualizado'], "." . $_SESSION['id'] . ".") === false) { ?><span style=" font-size: 15px; color: red;" >●</span><?php } ?></div>
                            <span><strong><?php echo $row['nome_responsavel']; ?></strong> concluiu a tarefa <strong><?php echo $row['nome']; ?></strong>.</span>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
    </div>
</li>
