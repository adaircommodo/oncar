<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADAIR :: Teste ONCAR</title>
    <link rel="stylesheet" href="assets/css/oncar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

    <?php require_once("preloader.php");?>

    <!--| HEADER |-->
    <nav class="navbar navbar-expand-lg navbar-light p-0 ty-0 border border-grey">
        <a class="navbar-brand" href="./">TESTE</a>
    </nav>

    <!--| CONTEÚDO |-->
    <div class="container-fluid">
        <!--| BUSCA OU FORM DE ADIÇÃO |-->
        <div class="row border border-grey">
            <div class="col-12 p-4">
                <div class="input-group">
                    <input id="inSearchCar" name="inSeachCar" type="text" class="form-control form-control-lg" placeholder="" aria-label="" aria-describedby="btns-search">
                    <div class="input-group-append" id="btns-search">
                        <button id="btn-searchcar" class="btn btn-lg" type="button"><i class="fas fa-search"></i></button>
                        <button class="btn btn-lg btn-actions" type="button" data-toggle="modal" data-target=".mdNovoVeiculoModalLabel"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row px-3 bg-light d-flex justify-content-between">
            <!--| LISTA DE VEÍCULOS |-->
            <div class="col-12 col-sm-7 my-3 p-3 border bg-white">
                <h3 class="h5 font-weight-bold">Lista de veículos</h3>
                <ul id="listcar" class="p-0">
                    <div class="text-center">
                        <div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>
                    </div>
                </ul>
            </div>
            <!--| DETALHES DO VEÍCULOS |-->
            <div class="col my-3 ml-sm-3 p-3 border bg-white">
                <h3 class="h5 font-weight-bold border-bottom pb-2">Detalhes do veículo</h3>
                <div class="row">
                    <div class="col-12 veiculos font-weight-bold" id="edit-veiculo">...</div>
                    <div class="col veiculos-marca font-weight-bold text-uppercase">
                        <span class="small text-secondary">MARCA</span>
                        <div id="edit-marca" class="h5 font-weight-bold">...</div>
                    </div>
                    <div class="col veiculos-ano font-weight-bold">
                        <span class="small text-secondary mb-0">ANO</span>
                        <div id="edit-ano" class="h5 font-weight-bold">...</div>
                    </div>
                    <div class="col veiculos-ano font-weight-bold">
                        <span class="small text-secondary mb-0">VENDIDO</span>
                        <div id="edit-vendido" class="h5 font-weight-bold">...</div>
                    </div>
                    <div class="col-12 text-justify mt-4" id="descr-veiculo">...</div>
                </div>
            </div>
            <a id="moredetais" class="mt-5"></a>
        </div>
    </div>

    <!--| MODAL DE ADIÇÃO DE VEÍCULOS |-->
    <div id="modalCadCar" class="modal fade mdNovoVeiculoModalLabel" tabindex="-1" role="dialog" aria-labelledby="mdNovoVeiculoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="./rest.php/veiculos" id="frmCadCar" class="needs-validation" novalidate>
                <div class="modal-header mb-2">
                    <h5 class="modal-title text-uppercase pl-0 ml-0">Adicionar Veículo</h5>
                    <button tabindex="8" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="cad_veiculo">Veículo</label>
                                <input tabindex="1" type="text" class="form-control" id="cad_veiculo" name=":veiculo" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="cad_marca">Marca</label>
                                <input tabindex="2" type="text" class="form-control" id="cad_marca" name=":marca" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="cad_ano">Ano</label>
                                <input tabindex="3" type="text" class="form-control" id="cad_ano" name=":ano" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cad_descricao">Descrição</label>
                                <textarea tabindex="4" class="form-control" id="cad_descricao" name=":descricao" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center  my-3">
                            <div class="custom-control custom-switch">
                                <input tabindex="5" type="checkbox" class="custom-control-input" id="vendido" name=":vendido" value="1">
                                <label class="custom-control-label" for="vendido">Vendido</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button tabindex="6" type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
                    <button tabindex="7" type="submit" for="frmCadCar" class="btn btn-lg text-uppercase btn-actions">
                        <span id="spinner" style="display:none" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        SALVAR <i class="fas fa-save ml-2"></i>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--| MODAL DE EDIÇÃO DE VEÍCULOS |-->
    <div id="modalEditCar" class="modal fade mdNovoVeiculoModalLabel" tabindex="-1" role="dialog" aria-labelledby="mdNovoVeiculoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="frmEditCar" method="POST" class="needs-validation" novalidate>
                <input type="hidden" id="id" name=":id" value="">
                <div class="modal-header mb-2">
                    <h5 class="modal-title text-uppercase pl-0 ml-0">Editar Veículo</h5>
                    <button tabindex="8" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="edit_veiculo">Veículo</label>
                                <input tabindex="1" type="text" class="form-control" id="edit_veiculo" name=":veiculo" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="edit_marca">Marca</label>
                                <input tabindex="2" type="text" class="form-control" id="edit_marca" name=":marca" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="edit_ano">Ano</label>
                                <input tabindex="3" type="text" class="form-control" id="edit_ano" name=":ano" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="edit_descricao">Descrição</label>
                                <textarea tabindex="4" class="form-control" id="edit_descricao" name=":descricao" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center  my-3">
                            <div class="custom-control custom-switch">
                                <input tabindex="5" type="checkbox" class="custom-control-input" id="edit_vendido" name=":vendido" value="1">
                                <label class="custom-control-label" for="edit_vendido">Vendido</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button tabindex="6" type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
                    <button tabindex="7" type="submit" for="frmEditCar" class="btn btn-lg text-uppercase btn-actions">
                        <span id="spinner" style="display:none" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        SALVAR <i class="fas fa-save ml-2"></i>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="assets/js/app.js"></script>

</body>
</html>