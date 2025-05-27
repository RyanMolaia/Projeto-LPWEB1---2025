<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoreComp</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="topo">
            <div class="esquerda">
                <a href="#sidebar" id="btn-departamento">☰</a>
            </div>
            <div>
                <a href="loja.php"><img class="logo" src="img/logo.png"></a>
            </div>
            <div class="meio">
                <form action="loja.php" method="POST">
                    <input type="text" name="buscar" placeholder="Buscar">
                    <button>🔍</button>
                </form>
            </div>
            <div class="direita">
                <?php if(isset($_SESSION['usuario'])): ?>
                    <a href="menu_cliente.php">👤 Conta</a>
                <?php else: ?>
                    <a href="tela_login.php">👤 Conta</a>
                <?php endif; ?>
                <a href="carrinho.php">🛒 Carrinho</a>
            </div>
        </div>
    </header>

    <aside id="sidebar">
        <a href="#" id="fechar-sidebar">🡸</a>
        <ul>
            <li><a href="desktops.php">Desktops</a></li>
            <li><a href="monitores.php">Monitores</a></li>
            <li><a href="notebooks.php">Notebooks</a></li>
            <li><a href="hardwares.php">Hardwares</a></li>
        </ul>
        <div class="suporte">
            <a href="suporte.php">Suporte</a>
        </div>
    </aside>
    <main class="exebicao-produtos">
        <?php

            include("banco.php"); 

            $busca = isset($_POST['buscar']) ? trim($_POST['buscar']) : '';

            $sql = "SELECT * FROM produtos WHERE qtd_estoque > 0";

            if(!empty($busca)){
                $sql .= " AND LOWER(nome) LIKE LOWER('%$busca%')";
            }

            $resultado = $conexao->query($sql);

            if($resultado->num_rows > 0){
                while($produto = $resultado->fetch_assoc()){
                    
                    echo "<div class='produto'>
                            <img src='{$produto['imagem']}' alt='{$produto['nome']}'>
                            <h3>{$produto['nome']}</h3>
                            <p class='preco'>R$ ". number_format($produto['preco'], 2, ',','.') . "</p>
                            <div class='botoes'>
                                <form action='carrinho.php' method='POST'>
                                    <input type='hidden' name='id' value='{$produto['id']}'>
                                    <button>Adicionar ao Carrinho</button>
                                </form>
                            </div>
                        </div>";
                }
            }else{
                echo "<p>Nenhum produto encontrado.</p>";
            }
            $conexao->close();
        ?>
    </main>
</body>
</html>