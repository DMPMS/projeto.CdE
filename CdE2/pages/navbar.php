<?php require_once '../../funcoes.php'; ?>
<div class="row header shadow-sm">
    <div class="col-sm-2 pl-0 text-center header-logo">
        <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
            <h3 class="logo"><a href="#" class="text-secondary logo"><img src="../../ico.png" width=25 height=25> CdE<span class="small">2</span></a></h3>
        </div>
    </div>
    <div class="col-sm-10 header-menu pt-2 pb-0">
        <div class="row">
            <div class="col-sm-12 col-4 text-right flex-header-menu justify-content-end">
                <div class="search-rounded mr-3">
                    <input type="text" class="form-control search-box" placeholder="Enter keywords.." />
                </div>
                <div class="mr-4">
                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../../assets/img/usuarios/<?php echo $_SESSION['foto']; ?>" alt="Adam" class="rounded-circle" width="40px" height="40px">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-13" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#"><i class="fa fa-user pr-2"></i> Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fa fa-th-list pr-2"></i> Tarefas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Sair"><i class="fa fa-power-off pr-2"></i> Sair</a>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <div class="modal fade" id="Sair" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary"><strong>Sair</strong></h5>
                    <button type="button" class="close semborda" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente sair?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <button type="button" class="btn btn-primary" onclick="Sair()">Sim</button>
                </div>
            </div>
        </div>
    </div>
</div>