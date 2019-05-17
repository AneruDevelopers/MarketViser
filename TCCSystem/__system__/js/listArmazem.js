$(document).ready(function() {
    $('.linkArm').click(function(e) {
        e.preventDefault();
        $.ajax({
            dataType: 'json',
            url: BASE_URL + 'functions/listArmazem',
            success: function(response) {
                $('.Armazens').html(loadingRes("Buscando armazéns..."));
                $('.Armazens').html(`
                    <h5 class="titleModalProfile">Escolha outro armazém:</h5>
                    <h3 style="opacity:0;">A</h3>
                `);
                for (var i = 0; response.length > i; i++) {
                    if(response[i].meuArm) {
                        $('.meuArmazem').html(`
                            <h1 style="opacity:0;">A</h1>
                            <h3 style="opacity:0;">A</h3>
                            <h5 class="titleModalProfile">Armazém atual:</h5<br>
                            <h4 class="titleModalProfileName">` + response[i].armazem_nome + `<br/>` + response[i].cid_nome + ` - ` + response[i].est_uf + `</h4>
                        `);
                    } else {
                        $('.Armazens').append(`
                            <button class="btn-arm btnNewArm" id-armazem="` + response[i].armazem_id + `">` + response[i].armazem_nome + `<br/>` + response[i].cid_nome + ` - ` + response[i].est_uf + `</button><br/><span style="opacity:0;">A</span><br/>
                        `);
                    }
                }
                $('.Armazens').append(`
                    <h5 class="linkConfig">O preço dos produtos podem mudar de acordo com o armazém</h5>
                `);
                $('body').append('<script src="' + BASE_URL2 + 'js/escolherArmazem.js"></script>');
            }
        });
    });
});