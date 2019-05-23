            
            <h2 class="tituloOfertas"><i class="far fa-clock"></i> AGENDAMENTO</h2>
            <div class="divAgend">
                <h4>Escolha o horário que você quer que entreguemos a compra (prazo máximo de uma hora e meia)!</h4>
                <p>
                    <?php
                        foreach($_SESSION['end_agend'] as $k => $v) {
                            if(($v != "") && ($k != count($_SESSION['end_agend']))) {
                                echo $v . ", ";
                            } else {
                                echo $v;
                            }
                        }
                    ?>
                </p>
                <div class="inputsRadioAgend"></div>
            </div>
            <script>
                $(function() {
                    $.ajax({
                        url: BASE_URL + 'functions/agendamento',
                        success: function(response) {
                            $('.inputsRadioAgend').html(response);
                            $("#hora_agend").submit(function() {
                                $.ajax({
                                    url: BASE_URL + 'functions/agendamento',
                                    type: 'post',
                                    data: $(this).serialize(),
                                    success: function() {
                                        buscaPagamento();
                                    }
                                });
                                return false;
                            });
                        }
                    });
                });
            </script>