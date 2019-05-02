<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Document</title>
    <script>
        var x = document.getElementById("objeto");

        function obterLocalizacao() {
            if(navigator.geoLocation) {
                navigator.geoLocation.getCurrentPosition(exibirPosicao);
            } else {
                x.innerHTML = "Não foi possível realizar este procedimento. A versão atual do navegador impediu o funcionamento.";
            }
        }

        function exibirPosicao(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude + "<br/>Longitude: " + position.coords.longitude;
        }

        function exibirPosicaoMapa(position) {
            var latitudeLongitudeFormatado = position.coords.latitude + "," + position.coords.longitude;

            var img_url = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitudeLongitudeFormatado + "&zoom=14&size=400x300&sensor=false&key=YOUR_:KEY";

            document.getElementById("painelDoMapa").innerHTML = "<img src='" + img_url + "'/>";
        }
        obterLocalizacao();
    </script>
</head>
<body>
    <?php
        require_once 'functions/connection/conn.php';

        if(isset($_SESSION['inf_usu'])) {
            foreach($_SESSION["tel_num"] as $k => $v) {
                $key = $k + 1;
                echo "<b>" . $key . "º Telefone:</b> " . $v . " - <b>Tipo:</b> " . $_SESSION["tipo_tel"][$k] . "<br/>";
            }
    
            foreach($_SESSION["inf_usu"] as $k => $v) {
                echo "<b>" . $k . ":</b> " . $v . "<br/>";
            }
        }
    ?>
</body>
</html>