    $("#form-atd").submit(function() {
        $.ajax({
            dataType: 'json',
            type: 'post',
            data: $(this).serialize(),
            url: BASE_URL + 'functions/envatd',
             success: function(json) {
              console.log(json);
             }

              });
});