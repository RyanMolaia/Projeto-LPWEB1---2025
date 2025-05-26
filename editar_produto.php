<?php

    include("banco.php");

    $id = @$_GET['id'];

    $sql = "SELECT * FROM produtos WHERE id='$id'";

    $resultado = $conexao->query($sql);
    $dados = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração do Produto <?php echo $dados["nome"]; ?></title>
    <link rel="stylesheet" href="editarprod.css">
</head>
<body>
    <div class="tudo">
        <div class="title">
                <div class="img">
                    <a class="" href="menu_administrativo.php"><img class="logo" src="img/logo.png" alt=""></a>
                </div>
                <h2>Edição de Produto</h2>
        </div>
        <div class="editar">
            <form action="editar_produto_salvar.php" method="POST" >
                <div class="input-group">
                    
                    <div class="tp_input">
                        <label>ID</label>
                        <input class="campo_id" type="number" name="id" value="<?php echo $dados["id"]; ?>" readonly />
                   
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo $dados["nome"]; ?>" />

                        <label>Preço</label>
                        <input type="number" name="preco" value="<?php echo $dados["preco"]; ?>" />
                    </div>
                    <div class="meio_input">
                        <label>Categoria</label><br>
                        <div class="cat">
                            <select id="categoria" name="categoria" required>
                                <option  value="">Selecione a Categoria</option>
                                    <?php
                                        include("banco.php");
                                        $sql = "SELECT id, nome FROM categorias";

                                        $resultado = $conexao->query($sql);

                                        foreach ($resultado as $categoria) {
                                            $selected = ($categoria['id'] == $dados['categorias_id']) ? "selected" : "";
                                            echo "<option value='" . $categoria['id'] . "' $selected>" . $categoria['nome'] . "</option>";
                                            }
                                    ?>
                            </select>
                        </div>
                        <label>Quantidade em Estoque</label>
                        <input class="campo_estoque" type="text" name="qtd_estoque" value="<?php echo $dados["qtd_estoque"]; ?>" />
                    </div>
                    <div class="final_input">
                        <div class="imagem-atual">
                            <label>Imagem atual</label>
                            <img src="<?php echo $dados['imagem']; ?>" alt="Imagem do Produto" />
                        </div>
                        <div class="anexarimagem">
                            <label for="imagem">Anexar Nova Imagem:</label>
                            <input type="file" id="imagem" name="imagem" accept="image/*" >
                        </div>
                    </div>
                        
                    <div class="button-container">
                        <button type="submit">Salvar</button>
                        <a href="produtos.php" class="btn-voltar">Voltar</a>
                    </div>
                    </div>
                </form>
        </div>
    </div>
</body>
</html>