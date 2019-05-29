<div class="topNavCity">
    <h6 class="linkMenuTopNavCityMobile linkArm" id="myBtnArmazemMobile">
        <i class="fas fa-globe-americas"></i> <span class="armName"><?= $_SESSION['arm']; ?></span>
    </h6>
</div>
<div class="companyNameSpace">
    <h1 class="comapanyName"><a class="linkCompanyName" href="<?= base_url_php(); ?>"><img src="<?= base_url(); ?>img/Banner_TCC/logoPadrao.png" alt=""></a></h1>
</div>
<div class="searchSpace">
    <div class="searchBoxHeader" id="searchBoxHeader">
        <form class="formPesquisaHeader" method="post" action="<?= base_url_php(); ?>search">
            <input class="pesquisaTxtHeader" value="<?= isset($_POST['buscaBarra']) ? $_POST['buscaBarra'] : '' ; ?>" type="text" name="buscaBarra" placeholder=" Clique e pesquise">
                <button class="pesquisaBtnHeader" type="submit">
                    <i class="fas fa-search"></i>
                </button>
        </form>
    </div>
</div>
<ul class="menuTopNav">
    <li class="celulaTopNavCity linkArm" id="myBtnArmazem">
        <a class="linkMenuTopNavCity" href="#">
            <span class="armName"><?= $_SESSION['arm']; ?></span>
        </a>
    </li>
    <li class="celulaTopNav">
        <a class="linkMenuTopNav" href="<?= base_url_php(); ?>compra/etapas_compra">
            <div class="leftBack">
                <i class="fas fa-shopping-cart"></i>
            </div>
            CARRINHO
        </a>
    </li>
    <li class="celulaTopNav" id="myBtn2">
        <a class="linkMenuTopNav" href="#">
            <div class="leftBack">
                <i class="far fa-user-circle"></i>
            </div>
            <span class="s_login">ENTRAR</span>
        </a>
    </li>
</ul>
<ul class="menuTopNavMobile">
  <li class="celulaTopNavMobile"><a class="linkMenuTopNavMobile" href="#" id="myBtn"><i class="far fa-user-circle"></i></a></li>
  <li class="celulaTopNavMobile"><a class="linkMenuTopNavMobile" href="<?= base_url_php(); ?>compra/etapas_compra"><i class="fas fa-shopping-cart"></i></a></li>
</ul>