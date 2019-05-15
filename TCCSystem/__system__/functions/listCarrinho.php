<?php
    if(isXmlHttpRequest()) {
        require_once 'connection/conn.php';
        $json = array();
        $json['empty'] = TRUE;
        $json['totCompra'] = 0;
        $json['prods'] = array();

        function getProducts() {
            global $conn;
            $sel = $conn->prepare("SELECT * FROM produto");
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
            $sel = $conn->prepare("SELECT * FROM produto WHERE produto_id IN (".$ids.")");
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
            
            if($_SESSION['carrinho']) {
                $cart = $_SESSION['carrinho'];
                $products =  getProductsByIds(implode(',', array_keys($cart)));
    
                foreach($products as $k => $product) {
                    if($product['produto_desconto_porcent'] != "") {
                        $product["produto_desconto"] = $product["produto_preco"]*($product["produto_desconto_porcent"]/100);
                        $product["produto_desconto"] = $product["produto_preco"]-$product["produto_desconto"];
                        $product["produto_desconto"] = number_format($product["produto_desconto"], 2, ',', '.');
                        $results[$k] = $product;
                        $results[$k]['subtotal'] = $cart[$product['produto_id']] * $product['produto_preco'];
                    } else {
                        $results[$k] = $product;
                        $results[$k]['subtotal'] = $cart[$product['produto_id']] * $product['produto_preco'];
                    }
                    
                }
            }
            
            return $results;
        }
    
        function getTotalCart() {
                $total = 0;
            foreach(getContentCart() as $product) {
                $total += $product['subtotal'];
            } 
            return $total;
        }
    
        
        $resultsCarts = getContentCart();
        $totalCarts  = getTotalCart();

        if($totalCarts >= 1) {
            $json['empty'] = FALSE;
            foreach($resultsCarts as $k => $v) {
                if($v['produto_desconto_porcent'] <> "") {
                    $v["produto_desconto"] = $v["produto_preco"]*($v["produto_desconto_porcent"]/100);
                    $v["produto_desconto"] = $v["produto_preco"]-$v["produto_desconto"];
                    $v["produto_desconto"] = number_format($v["produto_desconto"], 2, ',', '.');
                }
                
                $json['totCompra'] += $v['subtotal'];
                $v['subtotal'] = number_format($v['subtotal'], 2, ',', '.');
                $v["produto_preco"] = number_format($v["produto_preco"], 2, ',', '.');
                $v['carrinho'] = $_SESSION['carrinho'][$v['produto_id']];

                $json['prods'][] = $v;
            }
            $json['totCompra'] = number_format($json['totCompra'], 2, ',', '.');
        }

        echo json_encode($json);
    }
?>