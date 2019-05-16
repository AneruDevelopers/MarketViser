$(document).ready(function() {
    $('.linkArm').click(function(e) {
        e.preventDefault();
        $.ajax({
            dataType: 'json',
            url: BASE_URL + 'functions/listArmazem',
            success: function(response) {
                var arm = [];
                $('.Armazens').html(loadingRes("Buscando armazéns..."));
                $('.Armazens').html("");
                for (var i = 0; response.length > i; i++) {
                    arm[i] = `
                        <button class='btn-arm' id-armazem='` + response[i].armazem_id + `'>` + response[i].cid_nome + ` - ` + response[i].est_uf + `<br/>Escolher</button>
                    `;
                    $('.Armazens').append(arm[i] + `<br/>`);
                }
                $('body').append('<script src="' + BASE_URL2 + 'js/escolherArmazem.js"></script>');
            }
        });
    });
});