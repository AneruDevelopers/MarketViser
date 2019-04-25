<?php
    require_once 'connection/conn.php';
    
    $sel = $conn->prepare("SELECT * FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id");
    $sel->execute();

    if($sel) {
        if($sel->rowCount() > 0) {
            $rows = $sel->fetchAll();
            foreach($rows as $row) {
                echo "
                    <p>
                        <b>ID:</b> {$row["produto_id"]}<br/>
                        <b>Produto:</b> {$row["produto_nome"]}<br/>
                        <b>Descrição:</b> {$row["produto_descricao"]}<br/>
                        <b>Imagem:</b> {$row["produto_img"]}<br/>
                        <b>Marca:</b> {$row["marca_nome"]}<br/>
                        <b>Preço:</b> {$row["produto_preco"]}
                    </p>
                ";
            }
        } else {
            echo "Não há produtos cadastrados na base de dados";
        }
    } else {
        echo "Ocorreu um erro inesperado. Tente novamente mais tarde!";
    }
?>