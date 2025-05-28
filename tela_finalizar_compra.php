<?php
session_start();
include("banco.php");
if (!isset($_SESSION['id'])) {
    header("Location: tela_login_finaliza_compra.php");
    exit;
}
else{


        $hj = date("Y-m-d"); 
        $endereco = $_POST['endereco'] ?? '';
        $metodo = $_POST['metodo_pagamento'] ?? '';
    
    
        $sql = "INSERT INTO vendas (data_venda, id_usuario, endereco_entrega, metodo_pagamento) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("siss", $hj, $_SESSION['id'], $endereco, $metodo);
            $stmt->execute();
    
            if ($stmt->affected_rows > 0) {
                echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <link rel="stylesheet" href="tela_finalizar_compra.css">
                </head>
                <body>
                    <h3>Obrigado por ter comprado ❤🐱‍👤<h3>
                    <a href="loja.php"><img class="logo" src="img/logo.png"></a>
                </body>
                </html>';  
            } else {
                echo "Erro ao registrar a venda. Tente novamente";
            }
    
            $stmt->close();
        } else {
            echo "Erro na preparação da query: " . $conexao->error;
        }
    
        $conexao->close();
    }


?>