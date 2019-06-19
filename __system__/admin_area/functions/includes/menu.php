<header class="l-header">
    <h2 class="notification btnModalNot">
        <i class="fas fa-bell"></i>
        <div class="numNot"></div>
    </h2>

        <div class="modalNotContent" id="myModalNot">
            <div class="headerNot" id="headerNot">
                <span class="bHeaderNot" id="bHeaderNot">Notificações</span>
                <span class="aNotMarca" func-id="<?= $_SESSION['inf_func']['funcionario_id'] ?>" id="aNotMarca">Marcar todas como lidas</span>
            </div>
            <div class="showNotModal" id="showNotModal">

            </div>
        </div>

    <div class="divLinkCompanyNameAdm">
        <a class="linkCompanyNameAdm" href="<?= base_url_php(); ?>">
            <img src="<?= base_url(); ?>img\Banner_TCC\logoPadrao.png" alt="e.conomize">
        </a>
    </div>
</header>
<section class="l-menu">
    <!-- <h1 class="tituloAdminPage">
        <a class="linkAdmDash" href="<?= base_url_php(); ?>admin_area/dashboard">
            PAINEL
        </a>
    </h1> -->
    <ul class="listaTrocaPagina">
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>armazem/central">
            <li class="celulaTrocaPagina">
                Armazéns
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="<?= base_url_adm_php(); ?>armazem/central?fnc=IPA">
                        <li>
                            Inserir produto ao armazém
                        </li>
                    </a>
                    <a class="linkSubMenu" href="<?= base_url_adm_php(); ?>armazem/central?fnc=IA">
                        <li>
                            Inserir armazém
                        </li>
                    </a>
                </ul>
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>atendimento/central">
            <li class="celulaTrocaPagina">
                Atendimento online
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>banner/central">
            <li class="celulaTrocaPagina">
                Banners promocionais
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>categoria/central">
            <li class="celulaTrocaPagina">
                Categorias
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="<?= base_url_adm_php(); ?>categoria/central?fnc=IC">
                        <li>
                            Inserir categoria
                        </li>
                    </a>
                </ul>
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>compra/central">
            <li class="celulaTrocaPagina">
                Compras
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>cupom/central">
            <li class="celulaTrocaPagina">
                Cupons
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>departamento/central">
            <li class="celulaTrocaPagina">
                Departamentos
                <!-- <ul class="sub-menu">
                    <a class="linkSubMenu" href="departamento/central?fnc=ID">
                        <li>
                            Inserir departamento
                        </li>
                    </a>
                </ul> -->
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>duvida-frequente/central">
            <li class="celulaTrocaPagina">
                Dúvidas Frequentes
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="<?= base_url_adm_php(); ?>duvida-frequente/central?fnc=IDF">
                        <li>
                            Inserir dúvida frequente
                        </li>
                    </a>
                </ul>
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>fornecedor/central">
            <li class="celulaTrocaPagina">
                Fornecedores
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>funcionario/central">
            <li class="celulaTrocaPagina">
                Funcionários
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="<?= base_url_adm_php(); ?>funcionario/central?fnc=IF">
                        <li>
                            Inserir funcionário
                        </li>
                    </a>
                </ul>
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>horarios/central">
            <li class="celulaTrocaPagina">
                Horários entrega
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>marca/central">
            <li class="celulaTrocaPagina">
                Marcas
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="<?= base_url_adm_php(); ?>marca/central?fnc=IM">
                        <li>
                            Inserir marca
                        </li>
                    </a>
                </ul>
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>produto/central">
            <li class="celulaTrocaPagina">
                Produtos
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="<?= base_url_adm_php(); ?>produto/central?fnc=IP">
                        <li>
                            Inserir produto
                        </li>
                    </a>
                </ul>
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>produto/central">
            <li class="celulaTrocaPagina">
                Promoção personalizada
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="<?= base_url_adm_php(); ?>promocao/central?fnc=IPP">
                        <li>
                            Inserir promoção personalizada
                        </li>
                    </a>
                </ul>
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>subcategoria/central">
            <li class="celulaTrocaPagina">
                Subcategorias
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="<?= base_url_adm_php(); ?>subcategoria/central?fnc=IS">
                        <li>
                            Inserir subcategoria
                        </li>
                    </a>
                </ul>
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>usuario/central">
            <li class="celulaTrocaPagina">
                Usuários
            </li>
        </a>
    </ul>
</section>