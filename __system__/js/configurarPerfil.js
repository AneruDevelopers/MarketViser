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
            mudarTelefone();
        }
    });
}

function mudarTelefone() {
    
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