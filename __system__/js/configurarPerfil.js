function showTelefones() {
    $.ajax({
        dataType: 'json',
        type: 'post',
        data: 'show_tel=1',
        url: BASE_URL + 'functions/configurarPerfil',
        beforeSend: function() {
            $(".divTelefones").html(loadingRes("Buscando telefone(s)..."));
        },
        success: function(json) {
            $(".divTelefones").html(loadingRes("Importando telefone(s)..."));
            $('.divTelefones').html(`
                <h3>Telefone(s)</h3>
            `);
            for(var i = 0; json['tel'].length > i; i++) {
                $('.divTelefones').append(`
                    <b>Número:</b> ` + json['tel'][i].tel_num + ` 
                    <b>Tipo:</b> ` + json['tel'][i].tpu_tel_nome + `<br/>
                `);
            }
            adicionaInputsMudarTelefone();
        }
    });
}

function mudarTelefone() {
    
}

function deletarTelefone() {
    $('.deletaTelefone').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Deseja mesmo excuir este telefone?",
            text: "Uma vez deletando o telefone, será perdido permanentemente",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: "#494949",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#A94442",
            confirmButtonText: "Sim, excluir"
        }).then((result) => {
            if(result.value) {
                var dado = "deletaTel=" + $(this).attr("id-tel");
                $.ajax({
                    dataType: 'json',
                    type: 'post',
                    data: dado,
                    url: BASE_URL + 'functions/configurarPerfil',
                    success: function(json) {
                        Toast.fire({
                            type: json['type'],
                            title: json['answer']
                        });
                        if(json['status']) {
                            showTelefones();
                        }
                    }
                });
            }
        });
    });
}

function adicionaInputsMudarTelefone() {
    $('.mudarTelefone').click(function(e) {
        e.preventDefault();
        $.ajax({
            dataType: 'json',
            type: 'post',
            data: 'show_tel=1',
            url: BASE_URL + 'functions/configurarPerfil',
            success: function(json) {
                $('.divMudarTelefone').html(`
                    <button class="cancelarMudarTelefone"><i class="far fa-times-circle"></i></button>
                    <h4>Mude seu(s) telefone</h4>
                    <form id="formMudaTelefone">
                `);
                for(var i = 0; json['tel'].length > i; i++) {
                    $('.divMudarTelefone').append(`
                        <input type="text" name="telefone[]" class="sp_celphones" value="` + json['tel'][i].tel_num + `"/>
                        <select name="tipo_tel[]">
                    `);
                    for(var c = 0; json['tipo_tel'].length > c; c++) {
                        if(json['tel'][i].tpu_tel == json['tipo_tel'][i].tpu_tel_id) {
                            $('.divMudarTelefone').append(`
                                <option value="` + json['tipo_tel'][i].tpu_tel_id + `" selected>` + json['tipo_tel'][i].tpu_tel_nome + `</option>
                            `);
                        } else {
                            $('.divMudarTelefone').append(`
                                <option value="` + json['tipo_tel'][i].tpu_tel_id + `">` + json['tipo_tel'][i].tpu_tel_nome + `</option>
                            `);
                        }
                    }
                    $('.divMudarTelefone').append(`
                        </select>
                        <button id-tel="` + json['tel'][i].tel_id + `" class="deletaTelefone"><i class="far fa-times-circle"></i></button><br/>
                    `);
                }
                $('.divMudarTelefone').append(`
                        <button id="btnSaveMudarTelefone" type="submit"><i class="fas fa-save"></i> Salvar</button>
                    </form>
                `);
                deletarTelefone();
                mudarTelefone();
                mask();
            }
        });
    });
}

function mudarSenha() {
    $('#formMudarSenha').submit(function() {
        var dado = $(this).serialize();
        $.ajax({
            dataType: 'json',
            type: 'post',
            data: dado,
            url: BASE_URL + 'functions/configurarPerfil',
            beforeSend: function() {
                clearErrors();
                $("#btnSaveMudarSenha").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                if(json["status"]) {
                    $("#btnSaveMudarSenha").siblings(".help-block").html(loadingRes("Mudando senha..."));
                    clearErrors();
                    Toast.fire({
                        type: 'success',
                        title: 'Senha foi mudada'
                    });
                    ButtonMudarSenha();
                } else {
                    showErrors(json["error_list"]);
                }
            }
        });

        return false;
    });
}

function ButtonMudarSenha() {
    $('.divMudarSenha').html(`
        <button class="mudarSenha">Mudar senha</button>
    `);
    adicionaInputsMudarSenha();
}

function adicionaButtonMudarSenha() {
    $('.cancelarMudarSenha').click(function(e) {
        $('.divMudarSenha').html(`
            <button class="mudarSenha">Mudar senha</button>
        `);
        adicionaInputsMudarSenha();
    });
}

function adicionaInputsMudarSenha() {
    $('.mudarSenha').click(function(e) {
        e.preventDefault();
        $('.divMudarSenha').html(`
            <button class="cancelarMudarSenha"><i class="far fa-times-circle"></i></button>
            <h4>Mude a senha</h4>
            <div class="divInputSenha">
                <form id="formMudarSenha">
                    <div>
                        <div>
                            <label>Senha atual</label><br/>
                            <input type="password" id="senha_atual" name="senha_atual"/><br/>
                        </div>
                        <div class="help-block"></div>
                    </div>
                    <div>
                        <div>
                            <label>Nova senha</label><br/>
                            <input type="password" id="senha_nova" name="senha_nova"/><br/>
                        </div>
                        <div class="help-block"></div>
                    </div>
                    <div>
                        <div>
                            <label>Confirme a senha</label><br/>
                            <input type="password" id="senha_nova_confirme" name="senha_nova_confirme"/><br/>
                        </div>
                        <div class="help-block"></div>
                    </div>
                    <button id="btnSaveMudarSenha" type="submit"><i class="fas fa-save"></i> Salvar</button>
                </form>
            </div>
        `);
        adicionaButtonMudarSenha();
        mudarSenha();
    });
}

showTelefones();
adicionaInputsMudarSenha();