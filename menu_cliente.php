<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: tela_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta Cliente</title>
    <link rel="stylesheet" href="menu_cliente.css">
</head>
<body>
    <header>
        <div class="topo">
            <div class="esquerda">
                <a href="#sidebar" id="btn-departamento">☰</a>
            </div>
            <div>
                <a href="loja.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <div class="meio">
                <?php
                    echo "<h3>Bem vindo ".$_SESSION['usuario']."</h3>"
                ?>
            </div>
            <div class="direita">
                <a href="logout.php">🚪 Sair</a>
                <a href="carrinho.php">🛒</a>
            </div>
    </header>
            <aside id="sidebar">
                <a href="#" id="fechar-sidebar">🡸</a>
                    <ul>
                        <li><a href="carrinho.php">Carrinho</a></li>
                        <li><a href="compras_cliente.php">Historico de compras</a></li>
                    </ul>
            <div class="suporte">
                <a href="suporte.php">Suporte</a>
            </div>
        </aside>
</body>
</html>