<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta Adminitrativa</title>
    <link rel="stylesheet" href="suporte.css">
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
                        <li><a href="#">Carrinho</a></li>
                        <li><a href="#">Informações pessoais</a></li>
                        <li><a href="#">Historico de compras</a></li>
                    </ul>
            <div class="suporte">
                <a href="suporte.php">Suporte</a>
            </div>
        </aside>
</body>
</html>