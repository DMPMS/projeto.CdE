<?php
$notificacaoCliente = "SELECT * FROM cde_usuario WHERE notificacao = 0";

$sqlCliente = "SELECT COUNT(*) as total FROM cde_usuario WHERE notificacao = 0";
$recordsCliente = $pdo->prepare($sqlCliente);
$recordsCliente->execute();
$resultCliente = $recordsCliente->fetch(PDO::FETCH_ASSOC);
?>

<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="ClientesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-users fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter"><?php echo $resultCliente['total']; ?></span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="ClientesDropdown">
        <h6 class="dropdown-header">
            Notificações dos Clientes
        </h6>
        <div class="scroll" style="height: 250px;">
            <?php
            foreach ($pdo->query($notificacaoCliente) as $row) {
                $idResponsavel = $row['id_responsavel'];
                ?>
                <a class="dropdown-item d-flex align-items-center" href="sistemas/usuarios/info_usuario.php?id=<?php echo $row['id']; ?>">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-user-plus text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500"><?php echo $row['criadoem']; ?></div>
                        <span class="font-weight-bold"><?php echo $row['nome_responsavel']; ?> cadastrou o cliente <?php echo $row['nome']; ?>!</span>
                    </div>
                </a>
            <?php } ?>
        </div>
        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
    </div>
</li>
