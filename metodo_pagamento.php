<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: tela_login_finaliza_compra.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="tela_metodo_pagamento.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <div class="img">
                <a class="" href="loja.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <h2>Pagamento</h2>
        </div>
        <div class="select-container">
        
        <form action="tela_finalizar_compra.php" class="buttons" method="post">
            <input type="text" id="endereco" name="endereco" placeholder="Endereço de entrega" required>
                <select name="metodo_pagamento" required>
                    <option value="">Selecione o método de pagamento</option>
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                    <option value="Pix">Pix</option>
                    <option value="Boleto">Boleto</option>
            </select>
            <button>Confirmar compra</button>
        </form>
    </div>
</body>
</html>
