<?php session_start();      ?>
<?php include("banco.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoreComp</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <header>
        <div class="top">
            <div class="left">
                <a href="loja.php"><img class="logo" src="img/logo.png"></a>
            </div>
            <div class="middle">
                <h2> Meu carrinho </h2>
            </div>
            <div class="right">
                <?php if(isset($_SESSION['usuario'])): ?>
                    <a href="menu_cliente.php">👤 Conta</a>
                <?php else: ?>
                    <a href="tela_login.php">👤 Conta</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <div class="geral-cart">
        <div class="container-product">
            <?php
                $id = $_POST['id'] ?? null;

                if(!isset($_SESSION['carrinho'])) {
                    $_SESSION['carrinho'] = [];
                }

                if(isset($_POST['id'])) {
                    $id = (int) $_POST['id'];

                    if(isset($_SESSION['carrinho'][$id])){
                        $_SESSION['carrinho'][$id]++;
                    }
                    else{
                        $_SESSION['carrinho'][$id] = 1;
                    }


                }
               


                if(count($_SESSION['carrinho']) == 0) {
                    echo "<p>Seu carrinho está vazio.</p>";
                } else {
    
                if (isset($_GET['remover'])) {
                    $id_remover = (int) $_GET['remover'];
                    if (isset($_SESSION['carrinho'][$id_remover])) {
                        unset($_SESSION['carrinho'][$id_remover]);
                    }
                }

                if (isset($_GET['adicionar'])) {
                    $id_adicionar = (int) $_GET['adicionar'];  
                    if (isset($_SESSION['carrinho'][$id_adicionar])) {
                        $_SESSION['carrinho'][$id_adicionar]++;
                    } else {
                        $_SESSION['carrinho'][$id_adicionar] = 1;
                    }
                }

                if (isset($_GET['tirar'])) {
                    $id_tirar = (int) $_GET['tirar'];
                    if (isset($_SESSION['carrinho'][$id_tirar])) {
                        $_SESSION['carrinho'][$id_tirar]--;
                        if ($_SESSION['carrinho'][$id_tirar] <= 0) {
                            unset($_SESSION['carrinho'][$id_tirar]);
                        }
                    }
                }

                $produtosCarrinho = [];
                $total = 0;
                $statement = $conexao->prepare("SELECT * from produtos WHERE id = ?");
                foreach($_SESSION['carrinho'] as $ids => $qtd){
                    $statement->bind_param("i",$ids);
                    $statement->execute();
                    $result = $statement->get_result();
                    $produto = $result->fetch_assoc();

                if($produto) {
                    echo    "
                        <div class='produto'>
                            <img src='{$produto['imagem']}' alt='{$produto['nome']}'>
                            <h3>{$produto['nome']}</h3>
                            <p class='preco'>R$ ". number_format($produto['preco'], 2, ',','.') . "</p>
                            <p class='quantidade'>
                                Qtd: {$qtd}
                                <a href='carrinho.php?adicionar={$produto['id']}' class='adicionar'>🔼</a>
                                <a href='carrinho.php?tirar={$produto['id']}' class='tirar'>🔽</a>
                                <a href='carrinho.php?remover={$produto['id']}' class='botao-remover'>🗑️</a>
                            </p>
                        </div>
                            ";
                    $produtosCarrinho[] = $produto;
                    $total += $produto['preco'] * $qtd;
                } else {
                    echo "<p>Produto não encontrado.</p>";
                }
                 
                }
                $statement->close();
            }
        ?>
        </div>
        
        <div class="container-resume">
            <h3>Resumo</h3>
            <?php
                if(isset($total) && isset($produtosCarrinho)){
                    foreach ($produtosCarrinho as $produto) {
                    echo "<li>R$ " . number_format($produto['preco'], 2, ',', '.') . "</li>";
                    }
                    echo "</ul>";

                    echo "<h3>Total: R$ " . number_format($total, 2, ',', '.') . "</h3>";
                    echo "  <form action='metodo_pagamento.php' class='finalizar-compra'> 
                            <button>Finalizar Compra</button>
                            </form>
                        ";
                }else {
                    echo "";
                }

            ?>
        </div>
    </div>
</body>
</html>
