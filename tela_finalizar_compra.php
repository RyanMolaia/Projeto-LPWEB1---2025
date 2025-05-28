<?php
session_start();
include("banco.php");

if (!isset($_SESSION['id'])) {
    header("Location: tela_login_finaliza_compra.php");
    exit;
}

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "Carrinho vazio!";
    exit;
}

$hj = date("Y-m-d");
$endereco = $_POST['endereco'] ?? '';
$metodo = $_POST['metodo_pagamento'] ?? '';


$sql = "INSERT INTO vendas (data_venda, id_usuario, endereco_entrega, metodo_pagamento) VALUES (?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);

if ($stmt) {
    $stmt->bind_param("siss", $hj, $_SESSION['id'], $endereco, $metodo);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $venda_id = $stmt->insert_id; 


        foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
            

            $sql_produto = "SELECT preco FROM produtos WHERE id = ?";
            $stmt_produto = $conexao->prepare($sql_produto);
            $stmt_produto->bind_param("i", $id_produto);
            $stmt_produto->execute();
            $result = $stmt_produto->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $preco_unitario = $row['preco'];


                $sql_item = "INSERT INTO vendas_itens (vendas_id, produtos_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)";
                $stmt_item = $conexao->prepare($sql_item);
                $stmt_item->bind_param("iiid", $venda_id, $id_produto, $quantidade, $preco_unitario);
                $stmt_item->execute();
                $stmt_item->close();

            } else {
                echo "Produto com ID $id_produto não encontrado.<br>";
            }

            $stmt_produto->close();
        }

        unset($_SESSION['carrinho']);

        echo '
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Compra Finalizada</title>
            <link rel="stylesheet" href="tela_finalizar_compra.css">
        </head>
        <body>
            <h3>Obrigado por ter comprado ❤🐱‍👤</h3>
            <a href="loja.php"><img class="logo" src="img/logo.png"></a>
        </body>
        </html>';
        
    } else {
        echo "Erro ao registrar a venda. Tente novamente.";
    }

    $stmt->close();
} else {
    echo "Erro na preparação da query de venda: " . $conexao->error;
}

$conexao->close();
?>
