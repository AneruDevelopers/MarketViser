<?php
    require_once 'configuration.php';
    header("Content-Type: application/json");

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

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // TRANFORMANDO DADOS EM INTEIRO
        $dados['inputSenderCPF'] = str_replace(".", "", $dados['inputSenderCPF']);
        $dados['inputSenderCPF'] = str_replace("-", "", $dados['inputSenderCPF']);

        $dados['creditCardHolderCPF'] = str_replace(".", "", $dados['creditCardHolderCPF']);
        $dados['creditCardHolderCPF'] = str_replace("-", "", $dados['creditCardHolderCPF']);
        
        $dados['shippingAddressPostalCode'] = str_replace("-", "", $dados['shippingAddressPostalCode']);
        
        $dados['billingAddressPostalCode'] = str_replace("-", "", $dados['billingAddressPostalCode']);
        
        $dados['billingAddressOtherPostalCode'] = str_replace("-", "", $dados['billingAddressOtherPostalCode']);
    // ---------- //

    $dadosArray["email"] = EMAIL_PAGSEGURO;
    $dadosArray["token"] = TOKEN_PAGSEGURO;

    $dadosArray["paymentMode"] = "default";
    $dadosArray["paymentMethod"] = $dados['paymentMethod'];

    if($dadosArray["paymentMethod"] == "eft") {
        $dadosArray["bankName"] = $dados['bankName'];
    }

    $dadosArray["receiverEmail"] = $dados['receiverEmail'];
    $dadosArray["currency"] = $dados['currency'];
    
    $dadosArray["extraAmount"] = $dados['extraAmount'];

    $resultsCarts = getContentCart();
    foreach($resultsCarts as $k => $v) {
        $c = $k + 1;
        
        $dadosArray["itemId{$c}"] = $v['produto_id'];
        $dadosArray["itemDescription{$c}"] = $v['produto_nome'];
        $dadosArray["itemAmount{$c}"] = isset($v['produto_desconto']) ? number_format($v['produto_desconto'], 2, '.', '') : number_format($v['produto_preco'], 2, '.', '');
        $dadosArray["itemQuantity{$c}"] = $_SESSION['carrinho'][$v['produto_id']];
    }

    $dadosArray["notificationURL"] = $dados['notificationURL'];
    $dadosArray["reference"] = $dados['reference'];
    
    $dadosArray["senderName"] = $dados['inputSenderName'];
    $dadosArray["senderCPF"] = $dados['inputSenderCPF'];
    $dadosArray["senderAreaCode"] = $dados['inputSenderDDD'];
    $dadosArray["senderPhone"] = $dados['inputSenderNum'];
    $dadosArray["senderEmail"] = $dados['inputSenderEmail'];
    $dadosArray["senderHash"] = $dados['senderHash'];

    $dadosArray["shippingAddressRequired"] = $dados['shippingAddressRequired'];
    $dadosArray["shippingAddressStreet"] = $dados['shippingAddressStreet'];
    $dadosArray["shippingAddressNumber"] = $dados['shippingAddressNumber'];
    $dadosArray["shippingAddressComplement"] = $dados['shippingAddressComplement'];
    $dadosArray["shippingAddressDistrict"] = $dados['shippingAddressDistrict'];
    $dadosArray["shippingAddressPostalCode"] = $dados['shippingAddressPostalCode'];
    $dadosArray["shippingAddressCity"] = $dados['shippingAddressCity'];
    $dadosArray["shippingAddressState"] = $dados['shippingAddressState'];
    $dadosArray["shippingAddressCountry"] = $dados['shippingAddressCountry'];

    $dadosArray["shippingType"] = $dados['shippingType'];
    $dadosArray["shippingCost"] = $dados['shippingCost'];

    if($dadosArray['paymentMethod'] == "creditCard") {
        $dadosArray["creditCardToken"] = $dados['inputTokenCard'];

        $dadosArray["installmentQuantity"] = $dados['selQtdParc'];
        $dadosArray["installmentValue"] = $dados['inputParcValue'];
        $dadosArray["noInterestInstallmentQuantity"] = 2;

        $dadosArray["creditCardHolderName"] = $dados['creditCardHolderName'];
        $dadosArray["creditCardHolderCPF"] = $dados['creditCardHolderCPF'];
        $dadosArray["creditCardHolderBirthDate"] = $dados['creditCardHolderBirthDate'];

        $ddd = substr($dados['creditCardHolderPhone'], 1, 2);
        $num = substr($dados['creditCardHolderPhone'], -10);
        $num = str_replace(" ", "", $num);
        $num = str_replace("-", "", $num);

        $dadosArray["creditCardHolderAreaCode"] = $ddd;
        $dadosArray["creditCardHolderPhone"] = $num;

        if($dados['billingAddress'] == 1) {
            $dadosArray["billingAddressStreet"] = $dados['billingAddressStreet'];
            $dadosArray["billingAddressNumber"] = $dados['billingAddressNumber'];
            $dadosArray["billingAddressComplement"] = $dados['billingAddressComplement'];
            $dadosArray["billingAddressDistrict"] = $dados['billingAddressDistrict'];
            $dadosArray["billingAddressPostalCode"] = $dados['billingAddressPostalCode'];
            $dadosArray["billingAddressCity"] = $dados['billingAddressCity'];
            $dadosArray["billingAddressState"] = $dados['billingAddressState'];
            $dadosArray["billingAddressCountry"] = $dados['billingAddressCountry'];
        } else {
            $dadosArray["billingAddressStreet"] = $dados['billingAddressOtherStreet'];
            $dadosArray["billingAddressNumber"] = $dados['billingAddressOtherNumber'];
            $dadosArray["billingAddressComplement"] = $dados['billingAddressOtherComplement'];
            $dadosArray["billingAddressDistrict"] = $dados['billingAddressOtherDistrict'];
            $dadosArray["billingAddressPostalCode"] = $dados['billingAddressOtherPostalCode'];
            $dadosArray["billingAddressCity"] = $dados['billingAddressOtherCity'];
            $dadosArray["billingAddressState"] = $dados['billingAddressOtherState'];
            $dadosArray["billingAddressCountry"] = $dados['billingAddressOtherCountry'];
        }
    }

    $http_query = http_build_query($dadosArray);
    $url = URL_PAGSEGURO . "transactions";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $http_query);
    $answer = curl_exec($curl);

    curl_close($curl);
    $xml = simplexml_load_string($answer);

    if(!isset($xml->error)) {
        $ins = $conn->prepare("INSERT INTO compra(armazem_id, compra_hash, compra_total, usu_id, status_id, forma_id) 
        VALUES({$_SESSION['arm_id']}, '{$xml->code}', {$xml->grossAmount}, {$_SESSION['inf_usu']['usu_id']}, {$xml->status}, {$xml->paymentMethod->type})");
        if(!$ins->execute()) {
            $xml->errorInsert = "Um erro inesperado aconteceu! Estamos trabalhando para consertá-lo. Desculpe-nos!";
        } else {
            $sel = $conn->prepare("SELECT compra_id FROM compra WHERE compra_hash='{$xml->code}'");
            $sel->execute();
            $res = $sel->fetch( PDO::FETCH_ASSOC );

            foreach($resultsCarts as $k => $v) {
                $ins = $conn->prepare("INSERT INTO lista_compra(compra_id, produto_id, produto_qtd) VALUES({$res['compra_id']}, {$v['produto_id']}, {$_SESSION['carrinho'][$v['produto_id']]})");
                if(!$ins->execute()) {
                    $xml->errorInsert = "Um erro inesperado aconteceu! Estamos trabalhando para consertá-lo. Desculpe-nos!";
                    break;
                }
            }

            if(!isset($xml->errorInsert)) {
                $cep = substr($xml->shipping->address->postalCode, 0, 5) . "-" . substr($xml->shipping->address->postalCode, -3);

                $ins = $conn->prepare("INSERT INTO entrega(compra_id, entrega_horario, entrega_cep, entrega_end, entrega_num, entrega_complemento, entrega_bairro, entrega_cidade, entrega_uf) VALUES({$res['compra_id']}, '{$_SESSION['agend_horario']}', '$cep', '{$xml->shipping->address->street}', {$xml->shipping->address->number}, '{$xml->shipping->address->complement}', '{$xml->shipping->address->district}', '{$xml->shipping->address->city}', '{$xml->shipping->address->state}')");
                if(!$ins->execute()) {
                    $xml->errorInsert = "Um erro inesperado aconteceu! Estamos trabalhando para consertá-lo. Desculpe-nos!";
                } else {
                    $_SESSION['paymentDone'] = TRUE;
                }
            }
        }
    }

    $json = ['dados' => $xml];

    echo json_encode($json);
?>