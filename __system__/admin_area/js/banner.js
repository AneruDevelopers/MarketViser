var qtd_result = 5;
var page = 1;
var max_links = 2;

function dataBanners(page, qtd_result) {
    var dados = new FormData();
    dados.append("page", page);
    dados.append("qtd_result", qtd_result);

    $.ajax({
        dataType: 'json',
        type: 'post',
        data: dados,
		cache: false,
		contentType: false,
		processData: false,
        url: BASE_URL4 + 'functions/banner',
        beforeSend: function() {
            $('.tbodyProd').html(`
                <tr>
                    <th colspan="5" class="thNoData">
                        - <i class='fa fa-circle-notch fa-spin'></i> PROCESSANDO -
                    </th>
                </tr>
            `);
        },
        success: function(json) {
            if(json['status']) {
                if(!json['empty']) {
                    $('.tbodyProd').html("");
                    for(var i = 0; json['banners'].length > i; i++) {
                        $('.tbodyProd').append(`
                            <tr>
                                <td><img class="imgBanner" style="width:100%;" src="` + BASE_URL2 + `img/Banner_TCC/` + json['banners'][i].banner_path + `"/></td>
                                <td class="tdCenter">` + json['banners'][i].banner_nome + `</td>
                                <td class="tdCenter">` + json['banners'][i].banner_status + `</td>
                                <td class="tdCenter">
                                    <button class="myBtnUpd btnEditBanner btnProductConfigAdm" id-banner="` + json['banners'][i].banner_id + `"><i class="fa fa-edit"></i></button>
                                    <button class="btnDelBanner btnProductConfigAdm" id-banner="` + json['banners'][i].banner_id + `"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        `);
                    }
                    $('body').append(`
                        <div class="myModalView" id="myModalView">
                            <div class="modalViewContent">
                                <span class="closeModalView">&times;</span>
                                <div class="showViewModal">

                                </div>
                            </div>
                        </div>

                        <div class="myModalUpd" id="myModalUpd">
                            <div class="modalUpdContent">
                                <span class="closeModalUpd">&times;</span>
                                <div class="showUpdModal">
                                    <div class="divCadBanner">
                                        <form class="formUpdateBanner" enctype="multipart/form-data">
                                            <div class="divUpdCadBanner">
                                                <div style="margin:25px 0;">
                                                <table class="tableSectionConfigArm" width="80%" align="center">
                                                    <tr align="center">
                                                        <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">EDITAR BANNER PROMOCIONAL</h2></td>
                                                    </tr>
                                                    <tr>
                                                        <input type="hidden" id="banner_idUpd" name="banner_idUpd"/>
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>NOME</b></td>
                                                        <td><input type="text" placeholder=" (Opcional)" class="selectConfigArm" id="banner_nomeUpd" name="banner_nomeUpd" size="60"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>STATUS</b></td>
                                                        <td>
                                                            <select class="selectConfigArm" id="banner_statusUpd" name="banner_statusUpd">
                                                                <option id="status01" value="*000*"> -- Selecione o status: --</option>
                                                                <option id="status1" value="1">Ativado</option>
                                                                <option id="status0" value="0">Desativado</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>IMAGEM</b></td>
                                                        <td>
                                                            <img class="imgUpload" src=""/><br/>
                                                            <label for="banner_pathUpd" class="selectConfigArm labelFile"><i class="fas fa-upload"></i> Alterar imagem</label>
                                                            <input type="file" class="selectConfigArm" accept="image/*" id="banner_pathUpd" name="banner_pathUpd"/>
                                                        </td>
                                                    </tr>
                                                </table>
                                                </div>
                                            </div>
                                            <div class="divSubmit" align="center">
                                                <button type="submit" id="btnUpdateBanner"><i class="fas fa-save"></i> Editar</button>
                                                <div class="help-block"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    deleteBanner();
                    modalUpd();
                    updBanner();
                    uploadImg();
                } else {
                    $('.tbodyProd').html(`
                        <tr>
                            <th colspan="5" class="thNoData">- NÃO HÁ BANNERS CADASTRADOS -</th>
                        </tr>
                    `);
                }
            } else {
                $('.tbodyProd').html(`
                    <tr>
                        <th colspan="5" class="thNoData">- OCORREU UM ERRO -</th>
                    </tr>
                `);
            }
            $('.registShow').html(`
                Mostrando ` + json['registrosMostra'] + ` de ` + json['registrosTotal'] + ` banners
            `);

            var totPage = Math.ceil(json['registrosTotal'] / qtd_result);

            $('.paginacao').html(`
                <a href="#" class="linkPaginacao" onclick="dataBanners(1, qtd_result)">Primeira</a> 
            `);

            for(var pag_ant = (page - max_links); pag_ant <= (page - 1); pag_ant++) {
                if(pag_ant >= 1) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataBanners(` + pag_ant + `, qtd_result)">` + pag_ant + `</button> 
                    `);
                }
            }

            $('.paginacao').append(` ` + page + ` `);

            for(var pag_dep = (page + 1); pag_dep <= (page + max_links); pag_dep++) {
                if(pag_dep <= totPage) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataBanners(` + pag_dep + `, qtd_result)">` + pag_dep + `</button> 
                    `);
                }
            }

            $('.paginacao').append(`
                <a href="#" class="linkPaginacao" onclick="dataBanners(` + totPage + `, qtd_result)">Última</a>
            `);
        }
    });
}

function updBanner() {
    $(".btnEditBanner").click(function(e) {
        e.preventDefault();
        clearErrors();
        var dado = "updBanner_id=" + $(this).attr("id-banner");
        $.ajax({
            dataType: 'json',
                type: 'post',
                data: dado,
                url: BASE_URL4 + 'functions/banner',
                beforeSend: function() {
                    $('#banner_idUpd').val("");
                    $('#banner_nomeUpd').val("");

                    $('#status0').attr("selected", false);
                    $('#status1').attr("selected", false);
                    $('#status01').attr("selected", true);
                },
                success: function(json) {
                    $('#banner_idUpd').val(json['banner']['banner_id']);

                    if(json['banner']['banner_status'] == 1) {
                        $('#status0').attr("selected", false);
                        $('#status1').attr("selected", true);
                    } else {
                        $('#status1').attr("selected", false);
                        $('#status0').attr("selected", true);
                    }

                    $('#banner_nomeUpd').val(json['banner']['banner_nome']);

                    $('.imgUpload').attr("src", BASE_URL2 + `img/Banner_TCC/` + json['banner']['banner_path']);
                    updateBanner();
                }
        });
    });
}

function updateBanner() {
    $('.formUpdateBanner').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/banner',
            type: 'POST',
            data: formData,
            beforeSend() {
                clearErrors();
                $("#btnUpdateBanner").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Banner editado com sucesso!",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#333",
                        confirmButtonText: "Ok",
                    }).then((result) => {
                        if(result.value) {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataBanners(page, qtd_result);
                        } else {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataBanners(page, qtd_result);
                        }
                    });
                } else {
                    $("#btnUpdateBanner").siblings(".help-block").html(json['error']);
                }
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
            return myXhr;
            }
        });
    });
}

function insertBanner() {
    $('.formInserirBanner').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/banner',
            type: 'POST',
            data: formData,
            beforeSend() {
                clearErrors();
                $("#btnInsertBanner").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                dataBanners(page, qtd_result);
                
                if(json['status']) {
                    Swal.fire({
                        title: "Banner(s) cadastrado(s) com sucesso!",
                        text: "Deseja continuar cadastrando banner(s)?",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#333",
                        confirmButtonText: "Continuar",
                        cancelButtonColor: "#999",
                        cancelButtonText: "Sair"
                    }).then((result) => {
                        if(result.value) {
                            mostraModalAdd();
                        } else {
                            modalAdd.style.display = "none";
                        }
                    });
                } else {
                    $("#btnInsertBanner").siblings(".help-block").html(json['error']);
                }
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
            return myXhr;
            }
        });
    });
}

function uploadImg() {
    $("input[type=file]").on("change", function(e){
        e.preventDefault();
        var input = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;

        if (/^image/.test( files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);

            reader.onload = function() {
                input.siblings(".imgUpload").attr('src', this.result);
            }
        }
    });
}

function deleteBanner() {
    $('.btnDelBanner').click(function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: "Deseja mesmo excuir este banner?",
            text: "Uma vez feito, não haverá volta!",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: "#494949",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#A94442",
            confirmButtonText: "Sim, excluir"
        }).then((result) => {
            if(result.value) {
                var dado = "delBanner_id=" + $(this).attr("id-banner");
                $.ajax({
                    dataType: 'json',
                    url: BASE_URL4 + 'functions/banner',
                    type: 'POST',
                    data: dado,
                    success: function(json) {
                        if(json['status']) {
                            Swal.fire({
                                title: "Banner excluido com sucesso!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#494949",
                                confirmButtonText: "Ok"
                            });
                            dataBanners(page, qtd_result);
                        } else {
                            Swal.fire({
                                title: "Ocorreu um erro ao excluir banner!",
                                text: json['error_del'],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#494949",
                                confirmButtonText: "Ok"
                            });
                        }
                    }
                });
            }
        });
    });
}

dataBanners(page, qtd_result);