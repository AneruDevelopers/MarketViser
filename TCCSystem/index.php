<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e.conomize</title>
    <meta name="viewpor t" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style\css\main.css">
    <link rel="stylesheet" type="text/css" media="screen" href="style\libraries\bootstrap\css\bootstrap.min.css">
    <link href="style\libraries\fontawesome-free-5.8.0-web\css\all.css" rel="stylesheet">
    <link rel="stylesheet" href="style\libraries\OwlCarousel2-2.3.4\dist\assets\owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="style\libraries\OwlCarousel2-2.3.4\dist\assets\owl.theme.default.css" type="text/css">
</head>
<body>
    <div class="container-fluid">
        <div class="row topnavClass" id="topNav"></div>
        <nav class="row headerClass sticky-top" id="header"></nav>
        <!-- -------------------- -->

        <!-- Storage Header Menu -->

        <div class="row">
            <div id="modalMenuHeader" class="col-12 modalMenuHeader" onmouseover="javascript:mostra(); " onmouseout="javascript:esconde();">
                <div class="categoriasMenu">
                    <ul  class="listaCategoriasMenu">
                        
                    </ul>
                    <div id='linkMenu_1' class='linkMenuGeral linkMenu_1' onmouseover='javascript:showMenu1(); ' onmouseout='javascript:hideMenu1();'>
                        
                    </div>
                    <div id='linkMenu_2' class='linkMenuGeral linkMenu_2' onmouseover='javascript:showMenu2(); ' onmouseout='javascript:hideMenu2();'>
                        
                    </div>
                    <div id='linkMenu_3' class='linkMenuGeral linkMenu_3' onmouseover='javascript:showMenu3(); ' onmouseout='javascript:hideMenu3();'>

                    </div>
                    <div id='linkMenu_4' class='linkMenuGeral linkMenu_4' onmouseover='javascript:showMenu4(); ' onmouseout='javascript:hideMenu4();'>
                        
                    </div>
                    <div id='linkMenu_5' class='linkMenuGeral linkMenu_5' onmouseover='javascript:showMenu5(); ' onmouseout='javascript:hideMenu5();'>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel -->
        
        <div class="row carouselClass no-gutter">
            <div class="owl-carousel owl-dots col-12 com-md-12 col-sm-12">
                <div class=""><img class="imgCarousel" src="img\fliperama.jpg" alt=""></div>
                <div class=""><img class="imgCarousel" src="img\fifa.jpg" alt=""></div>
                <div class=""><img class="imgCarousel" src="img\controleps4.jpg" alt=""></div>
            </div>
        </div>

        <!-- Title/Display Products -->

        <div class="row">
            <h2 class="tituloOfertas">OFERTAS IMPERDÍVEIS</h2>
        </div>

        <!-- Display Products -->

        <div class="row productsClass">

        </div>

        <!-- -------------------- -->
        <div class="row" id="footer"></div>
    </div>

    <script src="js\JQuery\jquery-3.3.1.min.js"></script>
    <script src="style\libraries\bootstrap\js\bootstrap.js"></script>
    <script src="style\libraries\OwlCarousel2-2.3.4\dist\owl.carousel.js" type="text/javascript"></script>
    <script src="style\libraries\Sticky-Header-Navigation-jQuery\simple-sticky-header.js" type="text/javascript"></script>
    <script src="js\main.js" async></script>
</body>
</html>