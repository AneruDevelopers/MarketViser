<header class="l-header">
    <h2 class="notification">
        <i class="fas fa-bell"></i>
        <p class="qtdNotifi">1</p>
    </h2>
    <h1 class="comapanyName">
        <a class="linkCompanyNameAdm" href="<?= base_url_php(); ?>">
            <img src="<?= base_url(); ?>img\Banner_TCC\logoPadrao.png" alt="e.conomize">
        </a>
    </h1>
</header>
<section class="l-menu">
    <h1 class="tituloAdminPage">
        <a class="linkAdmDash" href="<?= base_url_php(); ?>admin_area/dashboard">
            Admstr
        </a>
    </h1>
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
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>banner/central">
            <li class="celulaTrocaPagina">
                Banners promocionais
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>categoria/central">
            <li class="celulaTrocaPagina">
                Categorias
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
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="#" onclick="carregar('<?= base_url_adm_php(); ?>departamento/inserir_dep')">
                        <li>
                            Inserir departamento
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
                    <a class="linkSubMenu" href="#" onclick="carregar('<?= base_url_adm_php(); ?>marca/inserir_marca')">
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
            </li>
        </a>
        <a class="linkTrocaPagina" href="<?= base_url_adm_php(); ?>subcategoria/central">
            <li class="celulaTrocaPagina">
                Subcategorias
                <ul class="sub-menu">
                    <a class="linkSubMenu" href="#" onclick="carregar('<?= base_url_adm_php(); ?>subcategoria/inserir_subcateg')">
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