<?php
    if(!isset($URL[4])):?>
        <div class="center_header">
            <i class="<?= $result[0]["depart_icon"]; ?>"></i> <?= $result[0]["depart_nome"]; ?><br/>
            <?= $result[0]["depart_desc"]; ?>
        </div>


        <?php
        $sel = $conn->prepare("SELECT * FROM subcateg WHERE depart_id={$_SESSION['depart_id']} ORDER BY subcateg_nome");
        $sel->execute();
        $result = $sel->fetchAll();?>
        <div class="filtro_pesquisa">
            <i class="fas fa-list"></i> 
            Categoria <select id="href">
                <option selected disabled>-- Buscar --</option>
                <?php
                foreach($result as $v):?>
                    <option value="<?= $v['subcateg_nome']; ?>"><?= $v['subcateg_nome']; ?></option>
                    <?php
                endforeach;?>
            </select>

            <?php
            $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_tamanho) AS tam FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();?>
            Tamanho <select id="tamanho_filtro">
                <option selected disabled>-- Filtrar --</option>
                <?php
                foreach($result2 as $v):?>
                    <option value="<?= $v['tam']; ?>"><?= $v['tam']; ?></option>
                    <?php
                endforeach;?>
            </select>

            <?php
            $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_marca), m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();?>
            Marca <select id="marca_filtro">
                <option selected disabled>-- Filtrar --</option>
                <?php
                foreach($result2 as $v):?>
                    <option value="<?= $v['produto_marca']; ?>"><?= $v['marca_nome']; ?></option>
                    <?php
                endforeach;?>
            </select>
            
            Preço <select id="preco_filtro">
                <option selected disabled>-- Filtrar --</option>
                <option value="DESC">Maior Preço</option>
                <option value="ASC">Menor Preço</option>
            </select>
             <i class="fas fa-list"></i>
        </div>
        
        <div class="produtos">
            <?php
            $sel2 = $conn->prepare("SELECT * FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();
            foreach($result2 as $v):?>
                <div class="prod">
                <?= "<img src='" . base_url() . "admin_area/imagens_produtos/" . $v["produto_img"] . "'/>" . $v["produto_nome"] . " - "  . $v["produto_tamanho"] . "<br/>R$ " . number_format($v["produto_preco"], 2, ',', '.'); ?>
                </div>
                <?php
            endforeach;?>
        </div><?php
    else:
        if(!isset($URL[5])):?>
            <div class="center_header">
                <?= $result2[0]["subcateg_nome"]; ?>
            </div>
            <?php
            $sel = $conn->prepare("SELECT * FROM categ WHERE subcateg_id={$_SESSION['subcateg_id']}");
            $sel->execute();
            if($sel->rowCount() > 0):?>
                <div class="filtro_pesquisa">
                    <i class="fas fa-list"></i> 
                    <select id="href">
                        Categoria <option selected disabled>-- Buscar --</option>
                        <?php
                        $result = $sel->fetchAll();
                        foreach($result as $v):?>
                            <option value="<?= $v['categ_nome']; ?>"><?= $v['categ_nome']; ?></option>
                            <?php
                        endforeach;?>
                    </select>

                    <?php
                    $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_tamanho) AS tam FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id WHERE c.subcateg_id={$_SESSION['subcateg_id']}");
                    $sel2->execute();
                    $result2 = $sel2->fetchAll();?>
                    Tamanho <select id="tamanho_filtro">
                        <option selected disabled>-- Filtrar --</option>
                        <?php
                        foreach($result2 as $v):?>
                            <option value="<?= $v['tam']; ?>"><?= $v['tam']; ?></option>
                            <?php
                        endforeach;?>
                    </select>

                    <?php
                    $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_marca), m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id JOIN categ AS c ON p.produto_categ=c.categ_id WHERE c.subcateg_id={$_SESSION['subcateg_id']}");
                    $sel2->execute();
                    $result2 = $sel2->fetchAll();?>
                    Marca <select id="marca_filtro">
                        <option selected disabled>-- Filtrar --</option>
                        <?php
                        foreach($result2 as $v):?>
                            <option value="<?= $v['produto_marca']; ?>"><?= $v['marca_nome']; ?></option>
                            <?php
                        endforeach;?>
                    </select>

                    Preço <select id="preco_filtro">
                        <option selected disabled>-- Filtrar --</option>
                        <option value="DESC">Maior Preço</option>
                        <option value="ASC">Menor Preço</option>
                    </select>
                     <i class="fas fa-list"></i>
                </div>

                <div class="produtos">
                    <?php
                    $sel2 = $conn->prepare("SELECT * FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id WHERE c.subcateg_id={$_SESSION['subcateg_id']}");
                    $sel2->execute();
                    $result2 = $sel2->fetchAll();
                    foreach($result2 as $v):?>
                        <div class="prod">
                            <?= "<img src='" . base_url() . "admin_area/imagens_produtos/" . $v["produto_img"] . "'/> " . $v["produto_nome"] . " - "  . $v["produto_tamanho"] . "<br/>R$ " . number_format($v["produto_preco"], 2, ',', '.'); ?>
                        </div>
                        <?php
                    endforeach;?>
                </div><?php
            endif;
        else:?>
            <div class="center_header">
                <?= $result3[0]["categ_nome"]; ?>
            </div>
            
            <div class="filtro_pesquisa">
                <i class="fas fa-list"></i> 
                <?php
                $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_tamanho) AS tam FROM produto AS p WHERE p.produto_categ={$_SESSION['categ_id']}");
                $sel2->execute();
                $result2 = $sel2->fetchAll();?>
                Tamanho <select id="tamanho_filtro">
                    <option selected disabled>-- Filtrar --</option>
                    <?php
                    foreach($result2 as $v):?>
                        <option value="<?= $v['tam']; ?>"><?= $v['tam']; ?></option>
                        <?php
                    endforeach;?>
                </select>

                <?php
                $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_marca), m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id WHERE p.produto_categ={$_SESSION['categ_id']}");
                $sel2->execute();
                $result2 = $sel2->fetchAll();?>
                Marca <select id="marca_filtro">
                    <option selected disabled>-- Filtrar --</option>
                    <?php
                    foreach($result2 as $v):?>
                        <option value="<?= $v['produto_marca']; ?>"><?= $v['marca_nome']; ?></option>
                        <?php
                    endforeach;?>
                </select>

                Preço <select id="preco_filtro">
                    <option selected disabled>-- Filtrar --</option>
                    <option value="DESC">Maior Preço</option>
                    <option value="ASC">Menor Preço</option>
                </select>
                 <i class="fas fa-list"></i>
            </div>

            <div class="produtos">
                <?php
                $sel = $conn->prepare("SELECT * FROM produto WHERE produto_categ={$_SESSION['categ_id']}");
                $sel->execute();
                if($sel->rowCount() > 0):
                    $result = $sel->fetchAll();
                    foreach($result as $v):?>
                        <div class="prod">
                            <?= "<img src='" . base_url() . "admin_area/imagens_produtos/" . $v["produto_img"] . "'/> " . $v["produto_nome"] . " - "  . $v["produto_tamanho"] . "<br/>R$ " . number_format($v["produto_preco"], 2, ',', '.'); ?>
                        </div>
                        <?php
                    endforeach;
                endif;?>
            </div><?php
        endif;
    endif;
?>