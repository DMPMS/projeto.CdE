<?php
if (isset($_SESSION['id']) == '') {
    $_SESSION['Entrar'] = True;
    echo '<script> window.location = "../index.php"; </script>';
} else { ?>
    <header class="header-top" header-theme="light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="top-menu d-flex align-items-center">
                    <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                    <div class="header-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="top-menu d-flex align-items-center">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="../../img/usuarios/<?php echo $_SESSION['foto']; ?>" alt=""></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i> Perfil</a>
                            <a class="dropdown-item" href="profile.html"><i class="ik ik-clipboard dropdown-icon"></i> Tarefas</a>
                            <button class="dropdown-item text-red" data-toggle="modal" data-target="#Sair"><i class="ik ik-power dropdown-icon text-red"></i> Sair</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="modal fade" id="Sair" tabindex="-1" role="dialog" aria-labelledby="Sair" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterLabel">Sair</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
    </div>
<?php } ?>