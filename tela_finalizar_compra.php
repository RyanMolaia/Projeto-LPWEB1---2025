<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: tela_login_finaliza_compra.php");
    exit;
}else{
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
</html>

';
}
?>