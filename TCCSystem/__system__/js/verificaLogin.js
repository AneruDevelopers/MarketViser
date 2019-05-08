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
                        <p><a href="#"><i class="fas fa-heart"></i> &nbsp;Meus favoritos</a></p>
                        <p><a href="#"><i class="fas fa-shopping-bag"></i> &nbsp;Minhas compras</a></p>
                        <p><a href="#"><i class="fas fa-cog"></i> &nbsp;Configurações</a></p>
                        <p><a href="` + BASE_URL + `functions/sair"><i class="fas fa-sign-out-alt"></i> &nbsp;Sair</a></p>
                    </div>
                `);
            } else {
                $('.s_login').html(`ENTRAR`);
            }
        }
    });
}

verificaLogin();