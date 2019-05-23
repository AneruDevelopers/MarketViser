
            <h2 class="tituloOfertas"><i class="fas fa-dollar-sign"></i> PAGAMENTO</h2>
            <pre>
            <?php
                print_r($_SESSION['end_agend']);
            ?>
            </pre>
            <?php
                // $hora = substr($_SESSION['agend_horario'],0,2) . "h" . substr($_SESSION['agend_horario'],3,2);
                $totCompra = number_format($_SESSION['totCompra'], 2, ',', '.');
                echo "<b>Entrega no dia:</b> {$_SESSION['agend_horario']}<br/><b>Total à pagar:</b> R$" . $totCompra;
            ?>

            <button class="pagamento_feito">
                Fiz o pagamento
            </button>
            <script>
                $(".pagamento_feito").click(function() {
                    buscaExtrato();
                });
            </script>