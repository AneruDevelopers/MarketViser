<?php
    require_once '__system__/functions/connection/conn.php';
    require_once 'includes/main.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Centro Administrativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="<?php echo base_url(); ?>admin_area/style/admin.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>
<body>
    
    <div class="l-wrapper">
        <header class="l-header">
        
        </header>
        <section class="l-menu">
            <h1 class="tituloAdminPage">Admstr</h1>
            <ul class="listaTrocaPagina">
                <li class="celulaTrocaPagina" onclick="carregar('inserir_produto');"><a class="linkTrocaPagina" href="#">Inserir Produtos</a></li>
                <li class="celulaTrocaPagina" onclick="carregar('inserir_categ');"><a class="linkTrocaPagina" href="#">Inserir Categoria</a></li>
                <li class="celulaTrocaPagina" onclick="carregar('inserir_subcateg');"><a class="linkTrocaPagina" href="#">Inserir Subcategoria</a></li>
                <li class="celulaTrocaPagina" onclick="carregar('inserir_tipo');"><a class="linkTrocaPagina" href="#">Inserir Tipo</a></li>
                <li class="celulaTrocaPagina" onclick="carregar('inserir_marca');"><a class="linkTrocaPagina" href="#">Inserir Marca</a></li>
                <li class="celulaTrocaPagina" onclick="carregar('armazem');"><a class="linkTrocaPagina" href="#">Armazém</a></li>
            </ul>
        </section>
        <section id="conteudo" class="l-main">
            
        </section>
        <footer class="l-footer">

        </footer>
    </div>

    <script src="<?php echo base_url(); ?>js\JQuery\jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_area\js\main.js"></script>
    <script src="<?php echo base_url(); ?>admin_area\js\admin.js"></script>
</body>
</html>