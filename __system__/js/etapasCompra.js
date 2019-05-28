function buscaCarrinho() {
    $('.carrega_pagina').load(BASE_URL + 'compra/carrinho');
}

function buscaEndereco() {
    $('.carrega_pagina').load(BASE_URL + 'compra/endereco');
}

function buscaAgendamento() {
    $('.carrega_pagina').load(BASE_URL + 'compra/agendamento');
}

function buscaPagamento() {
    // $('.carrega_pagina').load(BASE_URL + 'compra/pagamento');
    // $('.pagseguro').load(BASE_URL + 'functions/pagseguro/modal_compra');
    // console.log('Tra');
    window.location.href = BASE_URL + 'compra/pagamento';
}

function buscaExtrato() {
    $('.carrega_pagina').load(BASE_URL + 'compra/extrato');
}

buscaCarrinho();