function verificaLogin() {
    $.ajax({
        dataType: 'json',
        url: BASE_URL + 'functions/verificaLogin',
        beforeSend: function() {
            $('.s_login').html(`<i class='fa fa-circle-notch fa-spin'></i>`);
        },
        success: function(json) {
            if(json['logado']) {
                $('.s_login').html(`PERFIL`);
                $('.modal-content').html(`
                <div class="modalProfileLeftContent">
                    <h5 class="titleModalProfile">` + json['usuario']['usu_tipo'] + `</h5<br><h4 class="titleModalProfileName">` + json['usuario']['usu_nome'] + ` ` + json['usuario']['usu_sobrenome'] + `</h4>
                    <div class='divisorFilterProfile'></div>
                    <div class="sectionAccountInfo">
                        <h5>DADOS PESSOAIS</h5>
                        <div class="accountInfoData">
                            <p class="linhaProfile"><b>Nome:</b> ` + json['usuario']['usu_nome'] + ` ` + json['usuario']['usu_sobrenome'] + `</p>
                            <p class="linhaProfile"><b>CPF:</b>&nbsp;&nbsp;&nbsp;&nbsp; ` + json['usuario']['usu_cpf'] + `</p>
                            <p class="linhaProfile"><b>Email:</b>&nbsp; ` + json['usuario']['usu_email'] + `</p>
                        </div>
                        <h5>ENDEREÇO</h5>
                        <div class="accountInfoData">
                        <p class="linhaProfile"><b>` + json['usuario']['usu_end'] + `</b><b>, ` + json['usuario']['usu_num'] + `</b></p>
                        <p class="linhaProfile"><b>` + json['usuario']['usu_complemento'] + `</b></p>
                        <p class="linhaProfile"><b>` + json['usuario']['usu_cep'] + `</b></p>
                        <p class="linhaProfile"><b>` + json['usuario']['usu_cidade'] + ` - ` + json['usuario']['usu_uf'] + `</b></p>
                        </div>
                    </div>
                    <p class="linkConfig"><a href="` + BASE_URL + `usuario/configurar"><i class="fas fa-cog"></i> &nbsp;CONFIGURAÇÕES DO PERFIL</a></p>
                </div>
                <div class="modalProfileRightContent">
                    <span class="close">&times;</span>
                    <p class="linkRight"><a href="` + BASE_URL + `usuario/favoritos"><i class="fas fa-heart"></i> &nbsp;MEUS PRODUTOS FAVORITOS</a></p>
                    <p class="linkRight"><a href="` + BASE_URL + `usuario/estatisticas"><i class="fas fa-chart-line"></i> &nbsp;MINHAS ESTATÍSTICAS</a></p>
                    <p class="linkRight"><a href="` + BASE_URL + `usuario/compras"><i class="fas fa-shopping-bag"></i> &nbsp;HISTÓRICO DE COMPRAS</a></p>
                    <p class="linkRight logout"><a href=""><i class="fas fa-sign-out-alt"></i> &nbsp;SAIR</a></p>   
                    <p class="linkDate">JUNTOS DESDE ` + json['usuario']['usu_registro'] + `</p>
                </div>
                `);
                $('.logout').click(function() {
                    Swal.fire({
                        title: "Deseja mesmo sair?",
                        text: "Qualquer compra não finalizada será perdida permanentemente!",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonColor: "#494949",
                        cancelButtonText: "Cancelar",
                        confirmButtonColor: "#A94442",
                        confirmButtonText: "Sim, sair"
                    }).then((result) => {
                        if(result.value) {
                            window.location.href = BASE_URL + 'functions/sair';
                        }
                    });
                    return false;
                });
            } else {
                $('.s_login').html(`ENTRAR`);
            }
        }
    });
}

verificaLogin();