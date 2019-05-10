<?php
    if(!isset($URL[4])):?>
        <div class="center_header">
            <div class="tilteFilterProd">
                <h4><i class="<?= $result[0]["depart_icon"]; ?>"></i><?= $result[0]["depart_nome"]; ?></h4>
            </div>
            <h5><?= $result[0]["depart_desc"]; ?></h5>
        </div>

        <?php
        $sel = $conn->prepare("SELECT * FROM subcateg WHERE depart_id={$_SESSION['depart_id']} ORDER BY subcateg_nome");
        $sel->execute();
        $result = $sel->fetchAll();?>
        <div class="filtro_pesquisaMobile">
            <h5 class="titleFilter"><i class="fas fa-sliders-h"></i> FILTROS DE PESQUISA</h5>
            <div class="divFilter">
                <label for="href" class="titleConfigFilter"><i class="fas fa-font"></i> CATEGORIA</label>
                <select class="selectFilter" id="href">
                    <option selected disabled> Filtrar </option>
                    <?php
                    foreach($result as $v):?>
                        <option value="<?= $v['subcateg_nome']; ?>"><?= $v['subcateg_nome']; ?></option>
                        <?php
                    endforeach;?>
                </select>
            </div>
            <?php
            $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_tamanho) AS tam FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();?>
            <div class="divFilter">
                <label class="titleConfigFilter"><i class="fas fa-weight-hanging"></i> VOLUME</label>
                <select class="selectFilter" id="tamanho_filtro">
                    <option selected disabled> Filtrar </option>
                    <?php
                    foreach($result2 as $v):?>
                        <option value="<?= $v['tam']; ?>"><?= $v['tam']; ?></option>
                        <?php
                    endforeach;?>
                </select>
            </div>
            <div class="divFilter">
            <?php
            $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_marca), m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();?>
                <label class="titleConfigFilter"><i class="fas fa-copyright"></i> MARCA</label> 
                <select class="selectFilter" id="marca_filtro">
                    <option selected disabled> Filtrar </option>
                    <?php
                    foreach($result2 as $v):?>
                        <option value="<?= $v['produto_marca']; ?>"><?= $v['marca_nome']; ?></option>
                        <?php
                    endforeach;?>
                </select>
            </div>
            <div class="divFilter">
                <label class="titleConfigFilter">&nbsp<i class="fas fa-dollar-sign"></i> &nbspPREÇO</label>
                <select class="selectFilter" id="preco_filtro">
                    <option selected disabled> Filtrar </option>
                    <option value="DESC">Maior Preço</option>
                    <option value="ASC">Menor Preço</option>
                </select>
            </div>
        </div>

        <!-- FILTROS PARA TELAS GRANDES -->

        <div class="filtro_pesquisa">
            <div class="divTitleFilter">
                <h5 class="titleFilter">FILTROS DE PESQUISA</h5>
            </div>
            <div class="divFilter">
                <label for="href" class="titleConfigFilter"><i class="fas fa-font"></i> CATEGORIA</label>
                <ul class="listFilterOptions">
                <?php
                foreach($result as $v):?>
                    <li class="celulaListFilterOpt" value="<?= $v['subcateg_nome']; ?>"><input class="categ" type="checkbox" value="<?= $v['subcateg_nome']; ?>"> <?= $v['subcateg_nome']; ?></li>
                    <?php
                endforeach;?>
                </ul>
            </div>
            <?php
            $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_tamanho) AS tam FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();?>
            <div class="divFilter">
                <label for="href" class="titleConfigFilter"><i class="fas fa-weight-hanging"></i> VOLUME</label>
                <ul class="listFilterOptions">
                <?php
                foreach($result2 as $v):?>
                    <li class="celulaListFilterOpt" value="<?= $v['tam']; ?>"><input type="checkbox"><a href="#"><?= $v['tam']; ?></a></li>
                    <?php
                endforeach;?>
                </ul>
            </div>
            <?php
            $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_marca), m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();?>
            <div class="divFilter">
                <label for="href" class="titleConfigFilter"><i class="fas fa-copyright"></i> MARCA</label>
                <ul class="listFilterOptions">
                <?php
                foreach($result2 as $v):?>
                    <li class="celulaListFilterOpt" value="<?= $v['produto_marca']; ?>"><input type="checkbox"><a href="#"><?= $v['marca_nome']; ?></a></li>
                    <?php
                endforeach;?>
                </ul>
            </div>
            <div class="divFilter">
                <label class="titleConfigFilter">&nbsp<i class="fas fa-dollar-sign"></i> &nbspPREÇO</label>
                <ul class="listFilterOptions" id="preco_filtro">
                    <li class="celulaListFilterOpt" value="ASC">
                        <input type="checkbox"><a href="#">Menor preço</a>
                    </li>
                    <li class="celulaListFilterOpt" value="DESC">
                        <input type="checkbox"><a href="#">Maior preço</a>
                    </li>
                </ul>
            </div>
        </div>




        <div class="divShowProdFilter">
            <?php
            $sel2 = $conn->prepare("SELECT * FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();
            foreach($result2 as $v):?>
                <div class="prod">
                <?= "<div class='btnFavoriteFilter'>
                        <i class='far fa-heart'></i>
                    </div>
                    <img src='" . base_url() . "admin_area/imagens_produtos/" . $v["produto_img"] . "'/>
                    <div class='divisorFilter'></div>
                    <h5 class='titleProdFilter'>" . $v["produto_nome"] . " - "  . $v["produto_tamanho"] . "</h5>
                    <p class='priceProdFilter'>R$ " . number_format($v["produto_preco"], 2, ',', '.');"</p>" ?>
                </div>
                <?php
            endforeach;?>
        </div><?php
    else:
        if(!isset($URL[5])):?>
            <div class="center_header">
                <div class="tilteFilterProd">
                    <h4><i class="<?= $result[0]["depart_icon"]; ?>"></i><?= $result2[0]["subcateg_nome"]; ?></h4>
                </div>
            </div>

            <?php
            $sel = $conn->prepare("SELECT * FROM categ WHERE subcateg_id={$_SESSION['subcateg_id']}");
            $sel->execute();
            if($sel->rowCount() > 0):?>
                <div class="filtro_pesquisaMobile">
                    <h5 class="titleFilter"><i class="fas fa-sliders-h"></i> FILTROS DE PESQUISA</h5>
                    <div class="divFilter">
                        <label for="href" class="titleConfigFilter"><i class="fas fa-font"></i> SUBCATEGORIA</label>
                        <select class="selectFilter" id="href">
                            <option selected disabled> Filtrar </option>
                            <?php
                            $result = $sel->fetchAll();
                            foreach($result as $v):?>
                                <option value="<?= $v['categ_nome']; ?>"><?= $v['categ_nome']; ?></option>
                                <?php
                            endforeach;?>
                        </select>
                    </div>

                    <?php
                    $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_tamanho) AS tam FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id WHERE c.subcateg_id={$_SESSION['subcateg_id']}");
                    $sel2->execute();
                    $result2 = $sel2->fetchAll();?>
                    <div class="divFilter">
                        <label class="titleConfigFilter"><i class="fas fa-weight-hanging"></i> VOLUME</label>
                        <select class="selectFilter" id="tamanho_filtro">
                            <option selected disabled> Filtrar </option>
                            <?php
                            foreach($result2 as $v):?>
                                <option value="<?= $v['tam']; ?>"><?= $v['tam']; ?></option>
                                <?php
                            endforeach;?>
                        </select>
                    </div>
                    <div class="divFilter">
                    <?php
                    $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_marca), m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id JOIN categ AS c ON p.produto_categ=c.categ_id WHERE c.subcateg_id={$_SESSION['subcateg_id']}");
                    $sel2->execute();
                    $result2 = $sel2->fetchAll();?>
                    <label class="titleConfigFilter"><i class="fas fa-copyright"></i> MARCA</label> 
                    <select class="selectFilter" id="marca_filtro">
                        <option selected disabled> Filtrar </option>
                        <?php
                        foreach($result2 as $v):?>
                            <option value="<?= $v['produto_marca']; ?>"><?= $v['marca_nome']; ?></option>
                            <?php
                        endforeach;?>
                    </select>
                    </div>
                    <div class="divFilter">
                        <label class="titleConfigFilter">&nbsp<i class="fas fa-dollar-sign"></i> &nbspPREÇO</label>
                        <select class="selectFilter" id="preco_filtro">
                            <option selected disabled> Filtrar </option>
                            <option value="DESC">Maior Preço</option>
                            <option value="ASC">Menor Preço</option>
                        </select>
                    </div>
                </div>

                <div class="filtro_pesquisa">
                <div class="divTitleFilter">
                    <h5 class="titleFilter">FILTROS DE PESQUISA</h5>
                </div>
                <div class="divFilter">
                    <label for="href" class="titleConfigFilter"><i class="fas fa-font"></i> CATEGORIA</label>
                    <ul class="listFilterOptions">
                    <?php
                    foreach($result as $v):?>
                        <li class="celulaListFilterOpt" value="<?= $v['categ_nome']; ?>"><input class="categ" type="checkbox" value="<?= $v['categ_nome']; ?>"> <?= $v['categ_nome']; ?></li>
                        <?php
                    endforeach;?>
                    </ul>
                </div>
                <?php
                $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_tamanho) AS tam FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
                $sel2->execute();
                $result2 = $sel2->fetchAll();?>
                <div class="divFilter">
                    <label for="href" class="titleConfigFilter"><i class="fas fa-weight-hanging"></i> VOLUME</label>
                    <ul class="listFilterOptions">
                    <?php
                    foreach($result2 as $v):?>
                        <li class="celulaListFilterOpt" value="<?= $v['tam']; ?>"><input type="checkbox"><a href="#"><?= $v['tam']; ?></a></li>
                        <?php
                    endforeach;?>
                    </ul>
                </div>
                <?php
                $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_marca), m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
                $sel2->execute();
                $result2 = $sel2->fetchAll();?>
                <div class="divFilter">
                    <label for="href" class="titleConfigFilter"><i class="fas fa-copyright"></i> MARCA</label>
                    <ul class="listFilterOptions">
                    <?php
                    foreach($result2 as $v):?>
                        <li class="celulaListFilterOpt" value="<?= $v['produto_marca']; ?>"><input type="checkbox"><a href="#"><?= $v['marca_nome']; ?></a></li>
                        <?php
                    endforeach;?>
                    </ul>
                </div>
                <div class="divFilter">
                    <label class="titleConfigFilter">&nbsp<i class="fas fa-dollar-sign"></i> &nbspPREÇO</label>
                    <ul class="listFilterOptions" id="preco_filtro">
                        <li class="celulaListFilterOpt" value="ASC">
                            <input type="checkbox"><a href="#">Menor preço</a>
                        </li>
                        <li class="celulaListFilterOpt" value="DESC">
                            <input type="checkbox"><a href="#">Maior preço</a>
                        </li>
                    </ul>
                </div>
            </div>

                <div class="divShowProdFilter">
                    <?php
                    $sel2 = $conn->prepare("SELECT * FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id WHERE c.subcateg_id={$_SESSION['subcateg_id']}");
                    $sel2->execute();
                    $result2 = $sel2->fetchAll();
                    foreach($result2 as $v):?>
                        <div class="prod">
                        <?= "<div class='btnFavoriteFilter'>
                                <i class='far fa-heart'></i>
                            </div>
                            <img src='" . base_url() . "admin_area/imagens_produtos/" . $v["produto_img"] . "'/>
                            <div class='divisorFilter'></div>
                            <h5 class='titleProdFilter'>" . $v["produto_nome"] . " - "  . $v["produto_tamanho"] . "</h5>
                            <p class='priceProdFilter'>R$ " . number_format($v["produto_preco"], 2, ',', '.');"</p>" ?>
                        </div>
                        <?php
                    endforeach;?>
                </div><?php
            endif;
        else:?>
            <div class="center_header">
                <div class="tilteFilterProd">
                    <h4><i class="<?= $result[0]["depart_icon"]; ?>"></i><?= $result2[0]["subcateg_nome"]; ?> - <?= $result3[0]["categ_nome"]; ?></h4>
                </div>
            </div>
            
            <div class="filtro_pesquisaMobile">
                <?php
                $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_tamanho) AS tam FROM produto AS p WHERE p.produto_categ={$_SESSION['categ_id']}");
                $sel2->execute();
                $result2 = $sel2->fetchAll();?>
                <div class="divFilter">
                    <label class="titleConfigFilter"><i class="fas fa-weight-hanging"></i> VOLUME</label>
                    <select class="selectFilter" id="tamanho_filtro">
                        <option selected disabled> Filtrar </option>
                        <?php
                        foreach($result2 as $v):?>
                            <option value="<?= $v['tam']; ?>"><?= $v['tam']; ?></option>
                            <?php
                        endforeach;?>
                    </select>
                </div>
                <div class="divFilter">
                <?php
                $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_marca), m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id WHERE p.produto_categ={$_SESSION['categ_id']}");
                $sel2->execute();
                $result2 = $sel2->fetchAll();?>
                <label class="titleConfigFilter"><i class="fas fa-copyright"></i> MARCA</label> 
                <select class="selectFilter" id="marca_filtro">
                    <option selected disabled> Filtrar </option>
                    <?php
                    foreach($result2 as $v):?>
                        <option value="<?= $v['produto_marca']; ?>"><?= $v['marca_nome']; ?></option>
                        <?php
                    endforeach;?>
                </select>
                </div>
                <div class="divFilter">
                    <label class="titleConfigFilter">&nbsp<i class="fas fa-dollar-sign"></i> &nbspPREÇO</label>
                    <select class="selectFilter" id="preco_filtro">
                        <option selected disabled> Filtrar </option>
                        <option value="DESC">Maior Preço</option>
                        <option value="ASC">Menor Preço</option>
                    </select>
                </div>
            </div>

            <div class="filtro_pesquisa">
            <div class="divTitleFilter">
                <h5 class="titleFilter">FILTROS DE PESQUISA</h5>
            </div>
            <?php
            $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_tamanho) AS tam FROM produto AS p JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();?>
            <div class="divFilter">
                <label for="href" class="titleConfigFilter"><i class="fas fa-weight-hanging"></i> VOLUME</label>
                <ul class="listFilterOptions">
                <?php
                foreach($result2 as $v):?>
                    <li class="celulaListFilterOpt" value="<?= $v['tam']; ?>"><input type="checkbox"><a href="#"><?= $v['tam']; ?></a></li>
                    <?php
                endforeach;?>
                </ul>
            </div>
            <?php
            $sel2 = $conn->prepare("SELECT DISTINCT(p.produto_marca), m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id JOIN categ AS c ON p.produto_categ=c.categ_id JOIN subcateg AS s ON s.subcateg_id=c.subcateg_id WHERE s.depart_id={$_SESSION['depart_id']}");
            $sel2->execute();
            $result2 = $sel2->fetchAll();?>
            <div class="divFilter">
                <label for="href" class="titleConfigFilter"><i class="fas fa-copyright"></i> MARCA</label>
                <ul class="listFilterOptions">
                <?php
                foreach($result2 as $v):?>
                    <li class="celulaListFilterOpt" value="<?= $v['produto_marca']; ?>"><input type="checkbox"><a href="#"><?= $v['marca_nome']; ?></a></li>
                    <?php
                endforeach;?>
                </ul>
            </div>
            <div class="divFilter">
                <label class="titleConfigFilter">&nbsp<i class="fas fa-dollar-sign"></i> &nbspPREÇO</label>
                <ul class="listFilterOptions" id="preco_filtro">
                    <li class="celulaListFilterOpt" value="ASC">
                        <input type="checkbox"><a href="#">Menor preço</a>
                    </li>
                    <li class="celulaListFilterOpt" value="DESC">
                        <input type="checkbox"><a href="#">Maior preço</a>
                    </li>
                </ul>
            </div>
        </div>

            <div class="divShowProdFilter">
                <?php
                $sel = $conn->prepare("SELECT * FROM produto WHERE produto_categ={$_SESSION['categ_id']}");
                $sel->execute();
                if($sel->rowCount() > 0):
                    $result = $sel->fetchAll();
                    foreach($result as $v):?>
                        <div class="prod">
                        <?= "<div class='btnFavoriteFilter'>
                                <i class='far fa-heart'></i>
                            </div>
                            <img src='" . base_url() . "admin_area/imagens_produtos/" . $v["produto_img"] . "'/>
                            <div class='divisorFilter'></div>
                            <h5 class='titleProdFilter'>" . $v["produto_nome"] . " - "  . $v["produto_tamanho"] . "</h5>
                            <p class='priceProdFilter'>R$ " . number_format($v["produto_preco"], 2, ',', '.');"</p>" ?>
                        </div>
                        <?php
                    endforeach;
                endif;?>
            </div><?php
        endif;
    endif;
?>