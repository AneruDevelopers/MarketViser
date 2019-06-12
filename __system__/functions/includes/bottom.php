<?php
    $sel = $conn->prepare("SELECT depart_icon, depart_nome FROM departamento");
    $sel->execute();

    if($sel->rowCount() > 0):?>
        <div class="menuCarouselMobile owl-mobile owl-carousel prodsMobile">
            <?php
            while($row = $sel->fetch( PDO::FETCH_ASSOC )):?>
                <div class="celulaMenuCarouselMobile">
                    <a class="linkBtnMenu" href="<?= base_url_php() . removeAcento($row['depart_nome']); ?>">
                        <i class="<?= $row['depart_icon']; ?>"></i>
                        <h5 class="linkMenuCarouselMobile"><?= $row['depart_nome']; ?></h5>
                    </a>
                </div>
                <?php
            endwhile;?>
        </div>
        <?php
    else:?>
        <h3>Sem departamento(s) para pesquisa</h3>
        <?php
    endif;
?>

<div class="menuCarouselMobile owl-mobile owl-carousel prodsMobile">

</div>