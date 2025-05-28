<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoreComp</title>
    <link rel="stylesheet" href="descricao_produto.css">
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


            if (isset($_GET['id'])) {
                $id = (int) $_GET['id'];

                $statement = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
                $statement->bind_param("i", $id);
                $statement->execute();
                $result = $statement->get_result();
                $produto = $result->fetch_assoc();
            } else {
                echo "Produto não encontrado.";
                exit;
            }


                $statement = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
                $statement->bind_param("i", $id);
                $statement->execute();
                $result = $statement->get_result();
                $produto = $result->fetch_assoc();

            if($produto){
                    
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
            else{
                echo "<p>Nenhum produto encontrado.</p>";
            }
            $conexao->close();
        ?>
    </main>
</body>
</html>