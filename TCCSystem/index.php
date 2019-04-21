<?php

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e.conomize</title>
    <meta name="viewpor t" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style\css\main.css">
    <link href="style\libraries\fontawesome-free-5.8.0-web\css\all.css" rel="stylesheet">
    <link rel="stylesheet" href="style\libraries\OwlCarousel2-2.3.4\dist\assets\owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="style\libraries\OwlCarousel2-2.3.4\dist\assets\owl.theme.default.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="style\fonts\Icons\icons_pack\font\flaticon.css"> 
</head>
<body>
    <div class="l-wrapper">

        <div class="l-topNav" id="topNav">
        <?php
            include('functions\includes\topNav.html');
        ?>    
        </div>
        <nav class="l-headerNav" id="headerNav">
        <?php
            include('functions\includes\header.html');
        ?>
        </nav>

        <div class="l-bottomNav" id="bottomNav">
        <?php
            include('functions\includes\bottom.html');
        ?>
        </div>
        

        
        <!-- -------------------- -->



        <!-- Carousel -->
        
        <div class="l-carousel">
            <div id="owl-demo" class="owl-carousel">
                <div class="item"><img src="img\Banner2_Oficial.png" alt="The Last of us"></div>
                <div class="item"><img src="img\Banner2_Oficial.png" alt="GTA V"></div>
                <div class="item"><img src="img\Banner2_Oficial.png" alt="Mirror Edge"></div>
            </div>   
        </div>

        <!-- Title/Display Products -->

        <div class="l-main">
            <h2 class="tituloOfertas">OFERTAS IMPERDÍVEIS</h2>
        </div>

        <!-- Display Products -->

        <!-- -------------------- -->

        <div class="l-footer" id="footer"></div>
        <div class="l-footerBottom" id="footerBottom"></div>

    </div>

    <script src="js\JQuery\jquery-3.3.1.min.js"></script>
    <script src="style\libraries\OwlCarousel2-2.3.4\dist\owl.carousel.js" type="text/javascript"></script>
    <script src="js\main.js" async="">
        
    </script>
</body>
</html>