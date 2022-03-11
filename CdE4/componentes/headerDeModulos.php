<?php
if (!logado()) {
    redirecionarPara("../index.php", false);
} else { ?>
    <header class="header-top" header-theme="light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <!--Barra de Pesquisa-->
                <?php headerSearch(); ?>
                <!--/Barra de Pesquisa-->
                <!--Opções-->
                <?php headerOpcoes("../../dist/img/usuarios/"); ?>
                <!--/Opções-->
            </div>
        </div>
    </header>
    <?php modalSair(); ?>
<?php } ?>