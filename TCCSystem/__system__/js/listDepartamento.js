function removeAcento (text) {
    text = text.toLowerCase();
    for(var i = 0; text.length > i; i++) {
        if(text[i] == " ") {
            text= text.replace(" ", "-");
        }
    }
    text = text.replace(new RegExp('[ÁÀÂÃ]','gi'), 'a');
    text = text.replace(new RegExp('[ÉÈÊ]','gi'), 'e');
    text = text.replace(new RegExp('[ÍÌÎ]','gi'), 'i');
    text = text.replace(new RegExp('[ÓÒÔÕ]','gi'), 'o');
    text = text.replace(new RegExp('[ÚÙÛ]','gi'), 'u');
    text = text.replace(new RegExp('[Ç]','gi'), 'c');
    return text;
}
var base = "http://localhost/BackupGit/economize/TCCSystem/";

$(function() {
    $.ajax({
        dataType: 'json',
        url: base + 'functions/listDepartamentos',
        success: function(json) {
            var departs = [];
            var departsMobile = [];
            for (var i = 0; json.length > i; i++) {
                departsMobile[i] = `
                    <div class="celulaMenuCarouselMobile">
                        <a class="linkBtnMenu" href="` + base + removeAcento(json[i].depart_nome) +`">
                            <i class="` + json[i].depart_icon + `"></i><h5 class="linkMenuCarouselMobile">` + json[i].depart_nome + `</h5>
                        </a>
                    </div>
                `;
                departs[i] = `
                    <div class="celulaMenuCarousel">
                        <a class="linkBtnMenu" href="` + base + removeAcento(json[i].depart_nome) +`">
                            <i class="` + json[i].depart_icon + `"></i><h5 class="linkMenuCarousel">` + json[i].depart_nome + `</h5>
                        </a>
                    </div>
                `;
            }
            for (var i = 0; departs.length > i; i++) {
                $('.departamentos').append(departs[i]);
                $('.prodsMobile').append(departsMobile[i]);
            }
            $('body').append('<script src="' + base + '__system__/js/main.js"></script>\
            <script src="' + base + '__system__/js/login.js"></script>');
        }
    });
});