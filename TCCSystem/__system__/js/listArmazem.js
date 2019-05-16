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
                    arm[i] = "<button class='btn-arm' id-armazem='"+response[i].armazem_id+"'>"+response[i].cid_nome+"-"+response[i].est_uf+"Escolher</button><a ></a>";
                    $('.Armazens').append(`` + arm + ``);
                }
                $('body').append('<script src="' + BASE_URL2 + 'js/escolherArmazem.js"></script>');
            }
        });
    });
});