function buscaCarrinho() {
    window.history.pushState('Object', 'e.conomize - meu carrinho', BASE_URL + 'compra/carrinho');
    $('.carrega_pagina').load(BASE_URL + 'compra/carrinho');
}

function buscaEndereco() {
    window.history.pushState('Object', 'e.conomize - confirmar endereço', BASE_URL + 'compra/endereco');
    $('.carrega_pagina').load(BASE_URL + 'compra/endereco');
    $('body').append('<script src="' + BASE_URL2 + 'js/JQuery/jquery-mask.js"></script>\
    <script src="' + BASE_URL2 + 'js/mask.js"></script>');
}

function buscaAgendamento() {
    window.history.pushState('Object', 'e.conomize - agendamento', BASE_URL + 'compra/agendamento');
    $('.carrega_pagina').load(BASE_URL + 'compra/agendamento');
}

function buscaPagamento() {
    window.history.pushState('Object', 'e.conomize - pagamento', BASE_URL + 'compra/pagamento');
    $('.carrega_pagina').load(BASE_URL + 'compra/pagamento');
}

function buscaExtrato() {
    window.history.pushState('Object', 'e.conomize - extrato', BASE_URL + 'compra/extrato');
    $('.carrega_pagina').load(BASE_URL + 'compra/extrato');
}

buscaCarrinho();