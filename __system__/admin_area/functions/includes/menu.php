<header class="l-header">
    <h2 class="logout">
        <a href="<?= base_url_adm_php(); ?>functions/logout"><i class="fas fa-sign-out-alt"></i></a>
    </h2>

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

<!-- novo menu -->

    <nav class="menuNavigation">
        <div class="item">
            <input type="checkbox" id="check1">
            <label for="check1"><i class="fas fa-warehouse"></i>&nbsp; ARMAZÉM</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>armazem/central">GERENCIADOR</a></li>
                <li><a href="<?= base_url_adm_php(); ?>armazem/central?fnc=IPA">ADICIONAR PRODUTO</a></li>
                <li><a href="<?= base_url_adm_php(); ?>armazem/central?fnc=IPA">REGISTRAR ARMAZÉM</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check2">
            <label for="check2"><i class="fas fa-headset"></i>&nbsp; ATENDIMENTO ONLINE</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>atendimento/central">GERENCIADOR</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check3">
            <label for="check3"><i class="fas fa-ad"></i>&nbsp; BANNERS</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>banner/central">GERENCIADOR</a></li>
                <li><a href="<?= base_url_adm_php(); ?>banner/central?fnc=IB">INSERIR BANNER</a></li>
            </ul>
        </div>
        <!-- <div class="item">
            <input type="checkbox" id="check4">
            <label for="check4"><i class="fas fa-shopping-basket"></i>&nbsp; COMPRAS</label>
            <ul>
                <li><a href="compra/central">GERENCIADOR</a></li>
            </ul>
        </div> -->
        <div class="item">
            <input type="checkbox" id="check5">
            <label for="check5"><i class="fas fa-ticket-alt"></i>&nbsp; CUPONS</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>cupom/central">GERENCIADOR</a></li>
                <li><a href="<?= base_url_adm_php(); ?>cupom/central?fnc=IC">INSERIR CUPOM</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check6">
            <label for="check6"><i class="far fa-building"></i>&nbsp; DEPARTAMENTOS</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>departamento/central">GERENCIADOR</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check7">
            <label for="check7"><i class="far fa-question-circle"></i>&nbsp; DÚVIDAS FREQUENTES</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>duvida-frequente/central">GERENCIADOR</a></li>
                <li><a href="<?= base_url_adm_php(); ?>duvida-frequente/central?fnc=IDF">INSERIR DÚVIDA FREQUENTE</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check8">
            <label for="check8"><i class="fas fa-truck"></i>&nbsp; ENTREGAS <span class="notifEnt"></span></label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>entrega/central">GERENCIADOR</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check9">
            <label for="check9"><i class="fas fa-pallet"></i>&nbsp; FORNECEDORES</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>fornecedor/central">GERENCIADOR</a></li>
                <li><a href="<?= base_url_adm_php(); ?>fornecedor/central?fnc=IF">INSERIR FORNECEDOR</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check10">
            <label for="check10"><i class="fas fa-walking"></i>&nbsp; FUNCIONÁRIOS</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>funcionario/central">GERENCIADOR</a></li>
                <li><a href="<?= base_url_adm_php(); ?>duvida-frequente/central?fnc=IF">INSERIR FUNCIONÁRIO</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check11">
            <label for="check11"><i class="far fa-clock"></i>&nbsp; HORÁRIOS DE ENTREGA</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>horarios/central">GERENCIADOR</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check12">
            <label for="check12"><i class="fas fa-trademark"></i>&nbsp; PRODUTOS</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>produto/central">GERENCIADOR</a></li>
                <li><a href="<?= base_url_adm_php(); ?>produto/central?fnc=IP">INSERIR PRODUTO</a></li>
                <li><a href="<?= base_url_adm_php(); ?>categoria/central?fnc=IC">INSERIR CATEGORIA</a></li>
                <li><a href="<?= base_url_adm_php(); ?>subcategoria/central?fnc=IS">INSERIR SUBCATEGORIA</a></li>
                <li><a href="<?= base_url_adm_php(); ?>marca/central?fnc=IM">INSERIR MARCA</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check13">
            <label for="check13"><i class="fas fa-file-alt"></i>&nbsp; RELATÓRIOS</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>relatorio/central">ESPECÍFICO</a></li>
                <li><a href="<?= base_url_adm_php(); ?>relatorio/geral">GERAL</a></li>
            </ul>
        </div>
        <div class="item">
            <input type="checkbox" id="check14">
            <label for="check14"><i class="fas fa-users"></i>&nbsp; USUÁRIOS</label>
            <ul>
                <li><a href="<?= base_url_adm_php(); ?>usuario/central">GERENCIADOR</a></li>
            </ul>
        </div>
    </nav>
</section>