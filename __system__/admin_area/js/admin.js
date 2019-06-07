function carregar(pagina) {
    $("#conteudo").load(pagina);
}

function modalView() {
    var modal = document.getElementById('myModalView');

    var btn = [];
    for(var i = 0; i < $('.myBtnView').length; i++) {
        btn[i] = $('.myBtnView')[i];
    }

    for(var c = 0; c < btn.length; c++) {
        btn[c].onclick = function() {
            modal.style.display = "block";
        }
    }

    var span = document.getElementsByClassName("closeModalView")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}


var modalAdd = document.getElementById('myModalAdd');

function mostraModalAdd() {
    $('.formInserir').each(function() {
        this.reset();
    });
    $('.help-block').html("");
    $('.newAdd').remove();
    $('.imgUpload').attr("src", "");
}

$('.linkAlterAdm').click(function(e) {
    e.preventDefault();
    mostraModalAdd();
    modalAdd.style.display = "block";
});

$('.closeModalAdd').click(function(e) {
    e.preventDefault();
    modalAdd.style.display = "none";
});

window.onclick = function(event) {
    if (event.target == modalAdd) {
        modalAdd.style.display = "none";
    }
}