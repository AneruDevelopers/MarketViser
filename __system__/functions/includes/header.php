<div class="searchSpaceMobile">
  <div class="searchBoxHeader" id="searchBoxHeader">
      <form class="formPesquisaHeader" method="post" action="<?= base_url_php(); ?>search">
          <input class="pesquisaTxtHeader" value="<?= isset($_POST['buscaBarra']) ? $_POST['buscaBarra'] : '' ; ?>" type="text" name="buscaBarra" placeholder=" Clique e pesquise">
              <button class="pesquisaBtnHeader" type="submit" name="search">
                  <i class="fas fa-search"></i>
              </button>
      </form>
  </div>
</div>

<?php
    $sel = $conn->prepare("SELECT depart_icon, depart_nome FROM departamento");
    $sel->execute();

    if($sel->rowCount() > 0):
        function removeAcento($string) {
            if(strpos($string," "))
                str_replace(" ", "-", $string);
            $string = strtolower($string);

            return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a a e e i i o o u u n n c c"),$string);
        }?>
        <div class="menuCarousel owl-one owl-carousel departamentos">
            <?php
            while($row = $sel->fetch( PDO::FETCH_ASSOC )):?>
                <div class="celulaMenuCarousel">
                    <a class="linkBtnMenu" href="<?= base_url_php() . removeAcento($row['depart_nome']); ?>">
                        <i class="<?= $row['depart_icon']; ?>"></i>
                        <h5 class="linkMenuCarousel"><?= $row['depart_nome']; ?></h5>
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