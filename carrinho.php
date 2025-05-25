<?php include("banco.php"); ?>
<?php session_start();      ?>
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
                <a href="tela_login.php">👤 Conta</a>
            </div>
        </div>
    </header>
    <div class="geral-cart">
        <div class="container-product">
            <?php 
            foreach($_SESSION["produtos_exibidos"] as $id_produto){
                $statement = $conexao->prepare("SELECT * from produtos WHERE id = ?");
                $statement->bind_param("i",$_SESSION["produtos_exibidos"][$i]);
                $statement->execute();
                $result = $statement->get_result();
                $produto = $result->fetch_assoc();

                echo    "
                        <div class='produto'>
                            <img src='{$produto['imagem']}' alt='{$produto['nome']}'>
                            <h3>{$produto['nome']}</h3>
                            <p class='preco'>R$ ". number_format($produto['preco'], 2, ',','.') . "</p>
                        </div>
                        ";
            }
            ?>
        </div>

        <div class="container-resume">
            <h3>Resumo</h3>
            

        </div>
    </div>
</body>
</html>
