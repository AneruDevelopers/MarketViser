<?php
    require_once '__system__/functions/connection/conn.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Painel de controle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link href="<?= base_url_adm(); ?>style/admin.css" rel="stylesheet"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
</head>
<body>
    <div class="l-wrapper">
        <header class="l-header">
        </header>
        <section class="l-menu">
            <h1 class="tituloAdminPage">Admstr</h1>
            <ul class="listaTrocaPagina">        
                <li>
                    <ul>
                        <li class="celulaTrocaPagina" onclick="carregar('produto/inserir_produto');"><a class="linkTrocaPagina" href="#">Inserir Produtos</a></li>
                        <li class="celulaTrocaPagina" onclick="carregar('armazem/inserir_armazem');"><a class="linkTrocaPagina" href="#">Armazém</a></li>
                        <li class="celulaTrocaPagina" onclick="carregar('produto/inserir_marca');"><a class="linkTrocaPagina" href="#">Marca</a></li>
                        <li class="celulaTrocaPagina" onclick="carregar('produto/inserir_dep');"><a class="linkTrocaPagina" href="#">Departamento</a></li> 
                        <li class="celulaTrocaPagina" onclick="carregar('produto/inserir_subcateg');"><a class="linkTrocaPagina" href="#">Subcategoria</a></li>
                        <li class="celulaTrocaPagina" onclick="carregar('produto/inserir_categ');"><a class="linkTrocaPagina" href="#">Categoria</a></li>                     
                    </ul>
                </li>
            </ul>
        </section>
        <section id="conteudo" class="l-main">
        
        </section>
        <footer class="l-footer">
        </footer>
    </div>

    <script src="<?php echo base_url(); ?>js/JQuery/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/JQuery/jquery-mask.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/mask.js" type="text/javascript"></script>
    <script src="<?php echo base_url_adm(); ?>js/admin.js" type="text/javascript"></script>
</body>
</html>