$(document).ready(function(){
    $('#submit1').click(function(){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: BASE_URL + 'functions/novEmail',
            data: $(this).serialize(),
            beforeSend: function () {
                Toast.fire({
                    type: 'success',
                    title: 'Email está sendo enviado'
                });
                    
            },
            success: function (response) {
               
                Toast.fire({
                    type: 'success',
                    title: 'Email enviado com sucesso'
                });
            
            }
                            });
    });
});;

  