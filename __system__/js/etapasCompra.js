// function tecla() {
//     var keys = {};
//     var updateKeys = function() {
//         var pressed = [];

//         for (var key in keys) {
//             if (keys[key] == true) {
//                 pressed.push(key);
//             }
//         }
//         $('.carrega_pagina').text(pressed.join());
//     };

//     $('body').on('keydown', function(e){
//         keys[e.keyCode] = true;
//         updateKeys();
//     });

//     $('body').on('keyup', function(e){
//         delete keys[e.keyCode];
//         updateKeys();
//     });
// }
// tecla();

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
    $('.carrega_pagina').load(BASE_URL + 'compra/pagamento');
}

function buscaExtrato() {
    $('.carrega_pagina').load(BASE_URL + 'compra/extrato');
}

buscaCarrinho();