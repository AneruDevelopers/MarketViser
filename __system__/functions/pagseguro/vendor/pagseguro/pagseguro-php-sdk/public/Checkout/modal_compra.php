<?php
require_once '__system__/functions/connection/conn.php';

function getProductsByIds($ids) {
    global $conn;
    $sel = $conn->prepare("SELECT p.produto_id, p.produto_nome, d.produto_qtd, p.produto_img, p.produto_tamanho, d.produto_preco, d.produto_desconto_porcent, m.marca_nome, pr.promo_desconto FROM produto AS p JOIN dados_armazem AS d ON p.produto_id=d.produto_id JOIN marca_prod AS m ON p.produto_marca=m.marca_id LEFT JOIN dados_promocao AS dp ON p.produto_id=dp.produto_id LEFT JOIN promocao_temp AS pr ON dp.promo_id=pr.promo_id WHERE d.armazem_id={$_SESSION['arm_id']} AND p.produto_id IN (".$ids.")");
    $sel->execute();
    if($sel->rowCount() > 0) {
        while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
            $dados[] = $v;
        }
    }
    return $dados;
}

function getContentCart() {
    global $conn;
    $results = array();
    
    if(isset($_SESSION['carrinho'])) {
        $cart = $_SESSION['carrinho'];
        $products =  getProductsByIds(implode(',', array_keys($cart)));

        foreach($products as $k => $product) {
            if($product['produto_desconto_porcent'] != "") {
                $product["produto_desconto"] = $product["produto_preco"]*($product["produto_desconto_porcent"]/100);
                $product["produto_desconto"] = number_format($product["produto_desconto"], 2, '.', '');
                $product["produto_desconto"] = $product["produto_preco"]-$product["produto_desconto"];
                $results[$k] = $product;
            } elseif($product['promo_desconto']) {
                $product["produto_desconto"] = $product["produto_preco"]*($product["promo_desconto"]/100);
                $product["produto_desconto"] = number_format($product["produto_desconto"], 2, '.', '');
                $product["produto_desconto"] = $product["produto_preco"]-$product["produto_desconto"];
                $results[$k] = $product;
            } else {
                $results[$k] = $product;
            }
        }
    }
    
    return $results;
}

$tel = $conn->prepare("SELECT * FROM telefone AS t JOIN tipo_tel AS tt ON t.tpu_tel=tt.tpu_tel_id WHERE t.usu_id=:id");
$tel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
$tel->execute();
$res = $tel->fetchAll();

/**
 * 2007-2016 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    PagSeguro Internet Ltda.
 * @copyright 2007-2016 PagSeguro Internet Ltda.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 *
 */

require_once "__system__/functions/pagseguro/vendor/autoload.php";

\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

?>
    <!DOCTYPE html>
    <html>
    <head>
    <!-- 
        EMAIL COMPRADOR: c42358207331366747669@sandbox.pagseguro.com.br
        SENHA: 4303c40373589875
    -->
        <?php if (\PagSeguro\Configuration\Configure::getEnvironment()->getEnvironment() == "sandbox") : ?>
            <!--Para integração em ambiente de testes no Sandbox use este link-->
            <script
                    type="text/javascript"
                    src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
            </script>
        <?php else : ?>
            <!--Para integração em ambiente de produção use este link-->
            <script
                    type="text/javascript"
                    src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
            </script>
        <?php endif; ?>
    </head>
    </html>

<?php

$payment = new \PagSeguro\Domains\Requests\Payment();

$resultsCarts = getContentCart();
foreach($resultsCarts as $k => $v) {
    if($v['produto_desconto_porcent'] || $v['promo_desconto']) {
        $payment->addItems()->withParameters(
            $v['produto_id'],
            $v['produto_nome'],
            $_SESSION['carrinho'][$v['produto_id']],
            $v['produto_desconto']
        );
    } else {
        $payment->addItems()->withParameters(
            $v['produto_id'],
            $v['produto_nome'],
            $_SESSION['carrinho'][$v['produto_id']],
            $v['produto_preco']
        );
    }
}

if(isset($_SESSION['cupom_compra'])) {
    $totCupom = $_SESSION['totCompraCupom']*($_SESSION['cupom_compra']['cupom_desconto_porcent']/100);
    $totCupom = number_format($totCupom,2,'.','');
    $payment->setExtraAmount('-' . $totCupom);
}

$payment->setCurrency("BRL");
$payment->setReference("ECONOMIZE0101");

// Set your customer information.
$payment->setSender()->setName($_SESSION['inf_usu']['usu_nome']. ' ' . $_SESSION['inf_usu']['usu_sobrenome']);
$payment->setSender()->setEmail($_SESSION['inf_usu']['usu_email']);
foreach($res as $v) {
    $v['ddd'] = substr($v['tel_num'],1,2);
    $v['num'] = substr($v['tel_num'],-10);
    if(strpos($v['num']," ")) {
        $v['num'] = str_replace($v['num']," ","");
    }
    $v['num'] = str_replace($v['num'], "-", "");

    $payment->setSender()->setPhone()->withParameters(
        $v['ddd'],
        $v['num']
    );
}

$cpf = str_replace($_SESSION['inf_usu']['usu_cpf'],"-","");
$cpf = str_replace($_SESSION['inf_usu']['usu_cpf'],".","");
$payment->setSender()->setDocument()->withParameters(
    $cpf,
    '07650258000182'
);

$payment->setShipping()->setAddress()->withParameters(
    $_SESSION['end_agend'][1],
    $_SESSION['end_agend'][2],
    $_SESSION['end_agend'][4],
    $_SESSION['end_agend'][0],
    $_SESSION['end_agend'][5],
    $_SESSION['end_agend'][6],
    'BRA',
    $_SESSION['end_agend'][3]
);
$payment->setShipping()->setCost()->withParameters(00.00);
$payment->setShipping()->setType()->withParameters(\PagSeguro\Enum\Shipping\Type::SEDEX);

//Add metadata items
$payment->addMetadata()->withParameters('PASSENGER_CPF', '15986210093');
$payment->addMetadata()->withParameters('GAME_NAME', 'DOTA');
$payment->addMetadata()->withParameters('PASSENGER_PASSPORT', '23456', 1);

//Add items by parameter
// $payment->addParameter()->withParameters('itemId', '0003')->index(3);
// $payment->addParameter()->withParameters('itemDescription', 'Notebook Rosa')->index(3);
// $payment->addParameter()->withParameters('itemQuantity', '1')->index(3);
// $payment->addParameter()->withParameters('itemAmount', '201.40')->index(3);

//Add items by parameter using an array
//$payment->addParameter()->withArray(['notificationURL', 'http://www.lojamodelo.com.br/nofitication']);


$payment->setRedirectUrl(base_url_php() . "compra/extrato");
$payment->setNotificationUrl(base_url_php() . "admin_area/notificacao");

try {
    $onlyCheckoutCode = true;
    $result = $payment->register(
        \PagSeguro\Configuration\Configure::getAccountCredentials(),
        $onlyCheckoutCode
    );

    echo "
        <img src='../__system__\img\E_zinho for Phone.png' class='imgLogoPagPage' alt='Equipe e.conomize'><br>
        <h2 class='warningMsgPag'>Criando requisi&ccedil;&atilde;o de pagamento. Aguarde...</h2>"
        . "<p class='warningMsgPag'>C&oacute;digo da transa&ccedil;&atilde;o: <strong>" . $result->getCode() . "</strong></p>"
        . "<script>PagSeguroLightbox('" . $result->getCode() . "');</script>";
} catch (Exception $e) {
    die($e->getMessage());
}
