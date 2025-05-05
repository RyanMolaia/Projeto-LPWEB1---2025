<?php include("banco.php"); ?>
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
                <a href="#sidebar" id="btn-departamento">☰ Departamentos</a>
            </div>
            <div class="meio">
                <input type="text" placeholder="Buscar">
                <button>🔍</button>
            </div>
            <div class="direita">
                <a href="">👤 Conta</a>
                <a href="">🛒 Carrinho</a>
            </div>
        </div>
    </header>

    <aside id="sidebar">
        <a href="#" id="fechar-sidebar">🡸</a>
        <ul>
            <li><a href="">Desktops</a></li>
            <li><a href="">Monitores</a></li>
            <li><a href="">Notebooks</a></li>
        </ul>
        <div class="suporte">
            <a href="">Suporte</a>
        </div>
    </aside>
    <main class="exebicao-produtos">
       <?php

            $sql = "SELECT * FROM produtos";
            $resultado = $conexao->query($sql);

            if($resultado->num_rows > 0){
                while($produto = $resultado->fetch_assoc()){
                    echo "<div class='produto'>
                            <img src='{$produto['imagem']}' alt='{$produto['nome']}'>
                            <h3>{$produto['nome']}</h3>
                            <p>R$ ". number_format($produto['preco'], 2, ',','.') . "</p>
                            <button>Comprar</button>
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