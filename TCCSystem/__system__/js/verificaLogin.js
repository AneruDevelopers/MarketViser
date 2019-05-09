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
                    <div>
                        <span class="close">&times;</span>
                        <h4 class="titleModalLogin"><i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i> MEU PERFIL <i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i></h4>

                        <p class="infModal">
                            <b>` + json['usuario']['usu_tipo'] + `:</b> ` + json['usuario']['usu_nome'] + ` ` + json['usuario']['usu_sobrenome'] + `<br/>
                            <b>Juntos desde:</b> ` + json['usuario']['usu_registro'] + `
                        </p>
                        <p class="linkPerfil"><a href="#"><i class="fas fa-heart"></i> &nbsp;Meus produtos favoritos</a></p>
                        <p class="linkPerfil"><a href="#"><i class="fas fa-shopping-bag"></i> &nbsp;Minhas estatísticas no e.conomize</a></p>
                        <p class="linkPerfil"><a href="#"><i class="fas fa-cog"></i> &nbsp;Configurações da conta</a></p>
                        <p class="linkPerfil"><a href="` + BASE_URL + `functions/sair"><i class="fas fa-sign-out-alt"></i> &nbsp;Sair</a></p>
                    </div>
                `);
            } else {
                $('.s_login').html(`ENTRAR`);
            }
        }
    });
}

verificaLogin();