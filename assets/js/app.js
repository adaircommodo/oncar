
/*---| OBJETO PRINCIPAL |---**/
const ONCAR = {
    urlRest: './', //alterar aqui a url caso migre para outro server
    listAllCars: (idx = 0) => {
        $.ajax({
            url: ONCAR.urlRest + 'veiculos',
            success(data,status){ ONCAR.itemListCarsComponent(data,'ul#listcar', idx) },
            error: function(xhr,er) { console.log('Error ' + xhr.status + ' - ' + xhr.statusText + '\nTipo de erro: ' + er) }
        });
    },
    searchCar: (url) => {
        $.ajax({
            url: ONCAR.urlRest + url,
            method: 'GET',
            success: function(data, textStatus) { 
                if(!!data.success) {
                    console.log(data.result)
                }
            },
            error: function(xhr,er) { console.log('Error ' + xhr.status + ' - ' + xhr.statusText + '\nTipo de erro: ' + er) }
        });
    },
    cadCar: (url, data) => {
        $.ajax({
            url: ONCAR.urlRest + url,
            method: 'POST',
            data: data,
            beforeSend: function() {
                $("button.btn-actions").prop("disabled",true);
                $("span#spinner").prop("style",'');
            },
            complete: function() {
                setTimeout(()=>{
                    $('form#frmCadCar').trigger('reset');
                    $("button.btn-actions").prop("disabled",false);
                    $("span#spinner").prop("style",'display:none');
                    $('#modalCadCar').modal('hide');
                },500);
            },
            success: function(data, textStatus) { 
                if(!!data.success) {
                    setTimeout(()=>{Swal.fire({icon:'success', title:'Cadastrado sucesso!'})},500);
                    ONCAR.listAllCars();
                }
            },
            error: function(xhr,er) { console.log('Error ' + xhr.status + ' - ' + xhr.statusText + '\nTipo de erro: ' + er) }
        });
    },
    alterCar: (url, data) => {
        $.ajax({
            url: ONCAR.urlRest + url,
            method: 'PUT',
            data: { dados:data },
            beforeSend: function() {
                $("button.btn-actions").prop("disabled",true);
                $("span#spinner").prop("style",'');
            },
            complete: function() {
                setTimeout(()=>{
                    $('form#frmEditCar').trigger('reset');
                    $("button.btn-actions").prop("disabled",false);
                    $("span#spinner").prop("style",'display:none');
                    $('#modalEditCar').modal('hide');
                },500);
            },
            success: function(data, textStatus) {
                if(!!data.success) {
                    setTimeout(()=>{
                        Swal.fire({icon:'success', title:'Atualizado com sucesso!'}); 
                        ONCAR.listAllCars(data.id);
                        ONCAR.editCar(data.id);
                    },500);
                }
            },
            error: function(xhr,er) { console.log('Error ' + xhr.status + ' - ' + xhr.statusText + '\nTipo de erro: ' + er) }
        });
    },
    delCar: (idE) => {
        Swal.fire({
            title: 'Deseja excluir este veículo?', icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#364382', cancelButtonColor: '#d33', confirmButtonText: 'SIM', cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: ONCAR.urlRest + 'veiculos/' + parseInt(idE),
                    method: 'DELETE',
                    success: function(data, textStatus) { 
                        console.log(data)
                        if(!!data.success) {
                            Swal.fire({ icon: 'success', title: 'Excluído Sucesso!' });
                            ONCAR.listAllCars();
                            ONCAR.editCar();
                        }
                    },
                    error: function(xhr,er) { console.log('Error ' + xhr.status + ' - ' + xhr.statusText + '\nTipo de erro: ' + er) }
                });
            }
        })
    },
    editCar: (idv, type = 'moredetais') =>{
        let frmEdit = null;
        let veiculo = $("button#item"+idv).data("veiculo");
        let marca = $("button#item"+idv).data("marca");
        let ano = $("button#item"+idv).data("ano");
        let vendido = $("button#item"+idv).data("vendido");
        let descricao = $("button#item"+idv).data("descricao");
        let vendeu = (vendido==1)?'<span class="text-success">SIM</span>':'<span class="text-danger">NÃO</span>';

        $("div#edit-veiculo").html(veiculo);
        $("div#edit-marca").html(marca);
        $("div#edit-ano").html(ano);
        $("div#edit-vendido").html(vendeu);
        $("div#descr-veiculo").html(descricao.replace(/\n/g,"<br>"))
        $("html, body").animate({ scrollTop: $("button#item"+idv).offset().top }, 700);
        
        if(type!='moredetais'){
            frmEdit = $("form#frmEditCar");
            $('#modalEditCar').modal('show');
            $('input#id').val(idv);
            $('input#edit_veiculo').val(veiculo);
            $('input#edit_marca').val(marca);
            $('input#edit_ano').val(ano);
            $('input#edit_vendido').prop("checked",vendido);
            $('textarea#edit_descricao').val(descricao);
            
        }
    },
    itemListCarsComponent : (dataList, elApp, idx = 0) => {
        cars = []
        let totalItens = parseInt(dataList["result"].length);
        let lista = (totalItens>0)?'':`<button type="button" class="list-group-item list-group-item-action">Não há veículo cadastrado!</button>`;
        for(let i = 0;i<totalItens;i++) {
            let e = dataList["result"][i];
            if(idx!=0&&idx==e.id_veiculo){ idx = i; }
            lista+=`<button type="button" id="item${e.id_veiculo}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="ONCAR.editCar(${e.id_veiculo})" data-veiculo="${e.veiculo}" data-marca="${e.marca_veiculo}" data-ano="${e.ano_veiculo}" data-vendido="${e.vendido_veiculo}" data-descricao="${e.descricao_veiculo}">
                        <div>
                            <div class="veiculos-marca font-weight-bold">${e.marca_veiculo}</div>
                            <div class="veiculos font-weight-bold">${e.veiculo}</div>
                            <div class="veiculos-ano">${e.ano_veiculo}</div>
                        </div>
                        <div>
                            <a href="#moredetais" class="mr-2 scrollLink" onclick="ONCAR.editCar(${e.id_veiculo},'edit')"><i class="fas fa-edit h3 text-dark"></i></a>
                            <a href="#" class="btn-del" onclick="ONCAR.delCar(${e.id_veiculo})"><i class="fas fa-trash h3 text-dark"></i></a>
                        </div>
                    </button>`;
        }

        ONCAR.viewDetailsCar(['...','...','...','...','...']);
        if(totalItens>0){
            let e = dataList["result"][idx];
            ONCAR.viewDetailsCar([e.veiculo,e.marca_veiculo,e.ano_veiculo,e.vendido_veiculo,e.descricao_veiculo.replace(/\n/g,"<br>")])
        }
        $(elApp).html(lista);

    },
    viewDetailsCar: (obj) => {
        try {
            if(typeof obj === 'object'){ 
                let vendido = (obj[3]=="1")?'<span class="text-success">SIM</span>':'<span class="text-danger">NÃO</span>';
                if(obj[3]=="..."){ vendido = "..."; }
                $("div#edit-veiculo").html(obj[0]);
                $("div#edit-marca").html(obj[1]);
                $("div#edit-ano").html(obj[2]);
                $("div#edit-vendido").html(vendido);
                $("div#descr-veiculo").html(obj[4])
            }
        }catch(e){ console.log(e); }
    }
    
};


$(document).ready(function(){

    /*---| LISTA OS VEÍCULOS CADASTRADOS |---*/
    ONCAR.listAllCars();

    /*---| BUSCA: NÃO FINALIZADO |---*/
    $("button#btn-searchcar").click(function(evt){
        let searchItem = $( "input#inSearchCar" ).val().trim();
        ONCAR.searchCar('veiculos/' + searchItem);
        console.log("chamo --> "+searchItem )
    })

    /*---| AO ABRIR O MODAL DE CADASTRO, SETA O FOCO NO 1º CAMPO |---*/
    $('#modalCadCar').on('shown.bs.modal', function () {
        $('form#frmCadCar').trigger('reset');
        $('input#cad_veiculo').trigger('focus');
    })

    /*---| SUBMETER DADOS PARA CADASTRAR VEÍCULO |---*/
    $("form#frmCadCar").submit(function(evt){
        evt.preventDefault();
        evt.stopPropagation();
        const frm = $("form#frmCadCar");
        frm.removeClass('was-validated');
        if (frm[0].checkValidity()!==false) {
            ONCAR.cadCar(ONCAR.urlRest + 'veiculos', frm.serialize());
        } else { frm.addClass('was-validated'); }
    });

    /*---| SUBMETER DADOS PARA EDITAR VEÍCULO |---*/
    $("form#frmEditCar").submit(function(evt){
        evt.preventDefault();
        evt.stopPropagation();
        const frm = $("form#frmEditCar");
        frm.removeClass('was-validated');
        if (frm[0].checkValidity()!==false) {
            ONCAR.alterCar(ONCAR.urlRest + 'veiculos/', frm.serialize());
        } else { frm.addClass('was-validated'); }
    });

    /*---| SCROLL LINK |---*/
    $( "a.scrollLink" ).click(function( event ) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: $($(this).attr("href")).offset().top }, 700);
    });

});

/*---| PRELOADER |---*/
$(window).on('load', function () {
    setTimeout(()=>{
        $('#ctn-preloader').addClass('loaded');
        if ($('#ctn-preloader').hasClass('loaded')) {
            $('#preloader').delay(900).queue(function () { $(this).remove(); });
        }
    },2000);
});