
            <h2 class="tituloOfertas"><i class="fas fa-file-alt"></i> EXTRATO</h2>
            <pre>
            <?php
                print_r($_SESSION['carrinho']);
            ?>
            </pre>
            <?php
                // $hora = substr($_SESSION['agend_horario'],0,2) . "h" . substr($_SESSION['agend_horario'],3,2);
                $totCompra = number_format($_SESSION['totCompra'], 2, ',', '.');
                echo "<b>Entrega no dia:</b> {$_SESSION['agend_horario']}<br/><b>Total à pagar:</b> R$" . $totCompra;
            ?>