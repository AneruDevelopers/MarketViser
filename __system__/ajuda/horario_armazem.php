<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>e.conomize - Horários do armazém</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>/style/css/main.css">
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css">
</head>
<body>
    <div class="l-wrapper_FiltroPesq">
        <div class="l-topNavFiltroPesq" id="topNav">
        <?php
            include('__system__/functions/includes/topNav.php');
        ?>    
        </div>

        <nav class="l-headerNav" id="headerNav">
        <?php
            include('__system__/functions/includes/header.php');
        ?>
        </nav>

        <div class="l-bottomNav" id="bottomNav">
        <?php
            include('__system__/functions/includes/bottom.html');
        ?>
        </div>

        <div class="l-mainFiltroPesq">
            <h2 class="tituloOfertas">HORÁRIOS DE ENTREGA</h2>
            <p class="infoAgendText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ao agendar uma compra, você terá de escolher um horário de preferência para que ela seja entregue no endereço, previamente, definido. Contudo, há algumas restrições nessa escolha. Os horários disponíveis são do dia atual e do dia seguinte da compra, sendo que, os horários do dia seguinte só estarão disponíveis caso haja somente um ou nenhum horário para o dia atual. Caso a sua cidade seja uma <i>"subcidade"</i>, ela terá horários próprios para entrega, ou seja, não obrigatoriamente os horários serão iguais aos da cidade do seu armazém. Se tiver dúvida sobre as "subcidades" <a href="<?= base_url_php(); ?>ajuda/subcidades">clique aqui</a></p>
            <div class="l-horarios">
                <div class="table100 ver6 divTableArm">
                    <table align='center'>
                        <tr class="row100 head">
                            <th class="column100" colspan='8' style="text-align:center;">   
                                    <?= $_SESSION['arm_nome'] . "<br/>" . $_SESSION['arm']; ?>
                            </th>
                        </tr>
                <?php
                    $sel = $conn->prepare("SELECT * FROM dados_horario_entrega AS d JOIN horarios_entrega AS h ON d.dados_horario=h.hora_id JOIN armazem AS a ON d.dados_armazem=a.armazem_id WHERE a.armazem_id={$_SESSION['arm_id']} ORDER BY h.dia");
                    $sel->execute();
                    if($sel->rowCount() > 0) {
                        echo '
                        
                        ';
                        $res = $sel->fetchAll();
                        $dia_sem = 0;
                        $dia_semana = array();
                        $hora = array();
                        $c = -1;
                        foreach($res as $v) {
                            if($v['dia'] == 1) 
                                $dia = "SEGUNDA";
                            elseif($v['dia'] == 2)
                                $dia = "TERÇA";
                            elseif($v['dia'] == 3)
                                $dia = "QUARTA";
                            elseif($v['dia'] == 4)
                                $dia = "QUINTA";
                            elseif($v['dia'] == 5)
                                $dia = "SEXTA";
                            elseif($v['dia'] == 6)
                                $dia = "SÁBADO";
                            else
                                $dia = "DOMINGO";

                            if($dia_sem != $v['dia']) {
                                $dia_semana[] = $dia;
                                $dia_sem = $v['dia'];
                                $c++;
                            }
                            $hora[$c][] = substr($v['hora'],0,2) . "h" . substr($v['hora'],3,2);
                        }

                        if(!empty($dia_semana)) {
                            foreach($dia_semana as $k => $v) {
                                echo '
                                    <tr class="row100">
                                        <td class="columnTitle">' . $v . '</td>
                                ';
                                foreach($hora[$k] as $key => $val) {
                                    echo '
                                        <td class="column100 column1">' . $val . '</td>
                                    ';
                                }
                                echo '
                                    </tr>
                                ';
                            }
                        }

                        echo '
                            </table>
                        </div>
                        ';
                    } else {
                        echo '<h2 style="text-align:center;">Não há horários disponíveis</h2>';
                    }
                ?>

                <div class="table100 ver6 divTableArm">
                    <table align='center'>
                        <tr class="row100 head">
                            <th class="column100" colspan='8' style="text-align:center;">    
                                Subcidades de <?= $_SESSION['arm']; ?>
                            </th>
                        </tr>

                <?php
                    //HORÁRIOS DAS SUBCIDADES
                    $sel = $conn->prepare("SELECT * FROM dados_horario_subcidade AS d JOIN horarios_entrega AS h ON d.dados_horario=h.hora_id JOIN armazem AS a ON d.dados_armazem=a.armazem_id WHERE a.armazem_id={$_SESSION['arm_id']} ORDER BY h.dia");
                    $sel->execute();
                    if($sel->rowCount() > 0) {
                        echo '
                        ';
                        $res = $sel->fetchAll();
                        $dia_sem = 0;
                        $dia_semana = array();
                        $hora = array();
                        $c = -1;
                        foreach($res as $v) {
                            if($v['dia'] == 1) 
                                $dia = "SEGUNDA";
                            elseif($v['dia'] == 2)
                                $dia = "TERÇA";
                            elseif($v['dia'] == 3)
                                $dia = "QUARTA";
                            elseif($v['dia'] == 4)
                                $dia = "QUINTA";
                            elseif($v['dia'] == 5)
                                $dia = "SEXTA";
                            elseif($v['dia'] == 6)
                                $dia = "SÁBADO";
                            else
                                $dia = "DOMINGO";

                            if($dia_sem != $v['dia']) {
                                $dia_semana[] = $dia;
                                $dia_sem = $v['dia'];
                                $c++;
                            }
                            $hora[$c][] = substr($v['hora'],0,2) . "h" . substr($v['hora'],3,2);
                        }

                        if(!empty($dia_semana)) {
                            foreach($dia_semana as $k => $v) {
                                echo '
                                <tr class="row100">
                                    <td class="columnTitle">' . $v . '</td>
                                ';
                                foreach($hora[$k] as $key => $val) {
                                    echo '
                                        <td class="column100 column1">' . $val . '</td>
                                    ';
                                }
                                echo '
                                </tr>
                                ';
                            }
                        }

                        echo '
                            </table>
                            </div>
                            <p align="center">
                                <a style="text-align:center;color:#9C45EB;text-decoration:none;font-weight:bold;" href="' . base_url_php() . 'ajuda/subcidades">Ver subcidades de ' . $_SESSION['arm'] . '</a>
                            </p>
                        ';
                    } else {
                        echo '<h2 style="text-align:center;">Não há horários disponíveis para as subcidades</h2>';
                    }
                ?>
            </div>
        </div>
        <!-- -------------------- -->
        <div class="myModalArmazem" id="myModalArmazem">
			<div class="modalArmazemContent">
                <div class="modalArmTopContent">
                    <div class="meuArmazem">
                        
                    </div>
                    <span class="closeModalArmazem">&times;</span>
                </div>
                <div class="modalArmBottomContent">
                    <div class="Armazens">

                    </div>
                </div>
			</div>
		</div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modalLeftContent">
                    <form id="form-login">
                        <!-- <i class="far fa-check-circle"></i> -->
                        <h4 class="titleModalLogin">LOG IN</h4>
                        <div class="outsideSecInputCad">
                            <div class="field -md">
                                <input type="text" name="usu_email_login" id="usu_email_login" class="placeholder-shown" placeholder="Some placeholder"/>
                                <label class="labelFieldCad"><strong><i class="fas fa-envelope"></i> EMAIL</strong></label>
                            </div>
                            <div class="help-block"></div><br/>
                        </div>
                        <div class="outsideSecInputCad">
                            <div class="field -md">
                                <input type="password" name="usu_senha_login" id="usu_senha_login" class="placeholder-shown" placeholder="Some placeholder"/>
                                <label class="labelFieldCad"><strong><i class="fas fa-unlock"></i> SENHA</strong></label>
                            </div>
                            <div class="help-block"></div><br/>
                        </div>
                        <button class="btnSend" type="submit" id="btn-login" value="Entrar">ENTRAR</button>
                        <div class="help-block-login"></div>
                    </form>
                </div>
                <div class="modalRightContent">
                    <span class="close">&times;</span>
                    <p class="textModal">Olá, amigo!</p>
                    <p class="textModalBottom">Entre com seus detalhes pessoais e comece sua jornada conosco</p>
                    <div class="divLinkCad">    
                        <a class="linkCadModal" href="<?= base_url_php(); ?>usuario/cadastro">Cadastre-se já</a>
                    </div>    
                </div>
            </div>
        </div>
        <!-- -------------------- -->
        <div class="l-footerFiltroPesq" id="footer">
        <?php
            include('__system__/functions/includes/footer.php');
        ?>
        </div>
        <div class="l-footerBottomFiltroPesq" id="footerBottom">
        <?php
            include('__system__/functions/includes/bottomFooter.html');
        ?>
        </div>
    </div>

    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/listDepartamento.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
</body>
</html>