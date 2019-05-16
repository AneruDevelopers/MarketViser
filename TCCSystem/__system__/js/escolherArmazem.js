$(document).ready(function() {
    $('.btn-arm').click(function(e) {
        e.preventDefault();
        var dado = 'arm_id=' + $(this).attr('id-armazem');

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: dado,
            url: BASE_URL + 'functions/escolherArmazem',
            success: function() {
                
            }
        });
    });
});