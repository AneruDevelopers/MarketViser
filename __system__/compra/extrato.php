<ul class="progress-tracker progress-tracker--word progress-tracker--word-left progress-tracker--center anim-ripple-large">
    <li class="progress-step is-complete">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 1</h4>
            <i class="fas fa-shopping-cart"></i> CARRINHO
        </span>
    </li>
    <li class="progress-step is-complete">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 2</h4>
            <i class="fas fa-map-marker-alt"></i> ENDEREÇO
        </span>
    </li>
    <li class="progress-step is-complete">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 3</h4>
            <i class="far fa-clock"></i> AGENDAMENTO
        </span>
    </li>
    <li class="progress-step is-complete">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 4</h4>
            <i class="far fa-credit-card"></i> PAGAMENTO
        </span>
    </li>
    <li class="progress-step is-active">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 5</h4>
            <i class="fas fa-file-alt"></i> EXTRATO
        </span>
    </li>
</ul>

<h2 class="defaultTitle"><i class="fas fa-file-alt"></i> EXTRATO</h2>

<?php
    if(isset($_SESSION['paymentDone'])):
        $nome = $_SESSION['inf_usu']['usu_nome'];?>
        <div class="divThanks">
            <h4 class="thanksPurchase">
                Sua compra foi efetuada com sucesso!<br/>
                Muito obrigado pela preferência, <?= $nome; ?>!
            </h4>
        </div>

        <h5 class="hashPurchase">
            Código da compra: <b><?= $_SESSION['compra']['hash']; ?></b><br/>
            <small>* Guarde este hash para confirmação na hora da entrega</small>
        </h5>

        <div class="infPurchase">
            <h5 class="totPurchase">
                Valor total: R$ <?= $_SESSION['compra']['total']; ?>
            </h5>
            <h5 class="totPurchase">
                Status: <?= $_SESSION['compra']['status']; ?>
            </h5>
            <h5 class="totPurchase">
                Meio pag.: <?= $_SESSION['compra']['forma_pag']; ?>
            </h5>
            <h5 class="totPurchase">
                Armazém: <?= $_SESSION['compra']['armazem']; ?>
            </h5>

            <a class="linkBoleto" target="_blank" href="<?= base_url_php(); ?>usuario/nota-fiscal?compra=<?= $_SESSION['compra']['id'] ?>">
                <button class="btnBoleto">Gerar PDF</button>
            </a>

            <?= (isset($_SESSION['compra']['link']) ? ' &nbsp;<a class="linkBoleto" target="_blank" href="' . $_SESSION['compra']['link'] . '"><button class="btnBoleto">Abrir boleto</button></a><br/><br/>' : '<br/><br/>' ); ?>
            <a href="#">Ver mais</a>
        </div>

        <div class="itemsCart">
            <h5 class="titCartPurchase">
                Itens do carrinho
            </h5>
            <?php
                foreach($_SESSION['produto_nome'] as $k => $v):?>
                    <div class="productCart">
                        ID: <b>000-<?= $_SESSION['produto_id'][$k]; ?></b><br/>
                        Produto: <b><?= $v; ?></b><br/>
                        Quantidade: <b><?= $_SESSION['produto_qtd'][$k]; ?></b>
                    </div>
                    <?php
                endforeach;
            ?>
        </div>
        
        <div class="footPurch">
            <small>
                * Também enviamos um comprovante de compra ao seu email, verifique lá!<br/>
                * A entrega será feita no horário escolhido e no endereço informado<br/>
                * Ao fechar esta página, esta compra será perdida
            </small>
        </div>
        
        <?php
        unset($_SESSION['totCompra']);
        unset($_SESSION['carrinho']);
        unset($_SESSION['subtotal']);
        unset($_SESSION['carrinho']);
        unset($_SESSION['end_agend']);
        unset($_SESSION['agend_horario']);
        unset($_SESSION['pagamento']);
        unset($_SESSION['paymentDone']);
        unset($_SESSION['compra']);
        unset($_SESSION['produto_id']);
        unset($_SESSION['produto_nome']);
        unset($_SESSION['produto_qtd']);

        if(isset($_SESSION['totCompraCupom'])) {
            unset($_SESSION['totCompraCupom']);
        }

        if(isset($_SESSION['cupom_compra'])) {
            unset($_SESSION['cupom_compra']);
        }

        if(isset($_SESSION['subcid_id'])) {
            unset($_SESSION['subcid_id']);
            unset($_SESSION['subcid_frete']);
        }
    endif;
?>