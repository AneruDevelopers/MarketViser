<?php
    if(isXmlHttpRequest()) {
        require_once 'connection/conn.php';
        $json = array();
        $json['empty'] = TRUE;
        $json['totCompra'] = 0;
        $json['totDesconto'] = 0;
        $json['logado'] = TRUE;
        $json['prods'] = array();

        function getProducts() {
            global $conn;
            $sel = $conn->prepare("SELECT * FROM produto AS p JOIN dados_armazem AS d ON p.produto_id=d.produto_id JOIN marca_prod AS m ON p.produto_marca=m.marca_id WHERE d.armazem_id={$_SESSION['arm_id']}");
            $sel->execute();
            if($sel->rowCount() > 0) {
                $result = $sel->fetchAll();
                foreach($result as $v) {
                    $dados[] = $v;
                }
            }
            return $dados;
        }
    
        function getProductsByIds($ids) {
            global $conn;
            $sel = $conn->prepare("SELECT * FROM produto AS p JOIN dados_armazem AS d ON p.produto_id=d.produto_id JOIN marca_prod AS m ON p.produto_marca=m.marca_id WHERE d.armazem_id={$_SESSION['arm_id']} AND p.produto_id IN (".$ids.")");
            $sel->execute();
            if($sel->rowCount() > 0) {
                $result = $sel->fetchAll();
                foreach($result as $v) {
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
                        $product["produto_desconto"] = $product["produto_preco"]-$product["produto_desconto"];
                        $results[$k] = $product;
                        $results[$k]['subtotal'] = $cart[$product['produto_id']] * $product['produto_desconto'];
                        $results[$k]["produto_desconto"] = number_format($results[$k]["produto_desconto"], 2, ',', '.');
                    } else {
                        $results[$k] = $product;
                        $results[$k]['subtotal'] = $cart[$product['produto_id']] * $product['produto_preco'];
                    }
                }
            }
            
            return $results;
        }

        if(isset($_SESSION['carrinho'])) {
            if(!empty($_SESSION['carrinho'])) {
                $json['empty'] = FALSE;
                if(!isset($_SESSION['inf_usu']['usu_id'])) {
                    $json['logado'] = FALSE;
                }
                $resultsCarts = getContentCart();
                
                foreach($resultsCarts as $k => $v) {
                    if($v['produto_desconto_porcent'] <> "") {
                        $v["produto_desconto"] = $v["produto_preco"]*($v["produto_desconto_porcent"]/100);
                        $json['totDesconto'] += ($v["produto_desconto"] * $_SESSION['carrinho'][$v['produto_id']]);
                        $v["produto_desconto"] = $v["produto_preco"]-$v["produto_desconto"];
                        $v["produto_desconto"] = number_format($v["produto_desconto"], 2, ',', '.');
                    }
                    
                    $json['totCompra'] += $v['subtotal'];
                    $v['subtotal'] = number_format($v['subtotal'], 2, ',', '.');
                    $v["produto_preco"] = number_format($v["produto_preco"], 2, ',', '.');
                    $v['carrinho'] = $_SESSION['carrinho'][$v['produto_id']];

                    $json['prods'][] = $v;
                }
                $json['totDesconto'] = number_format($json['totDesconto'], 2, ',', '.');
                $json['totCompra'] = number_format($json['totCompra'], 2, ',', '.');
                $_SESSION['totCompra'] = $json['totCompra'];
            }
        }

        echo json_encode($json);
    }
?>