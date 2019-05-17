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

<div class="menuCarousel owl-one owl-carousel departamentos">

</div>