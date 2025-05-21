<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="cadastroprod.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <div class="img">
                <a class="" href="loja.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <h2>Cadastro de Produto</h2>
        </div>
            <form  action="adicionar_produto_salvar.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="text" id="nome" name="nome" placeholder="Nome" required>
                    <input type="number" id="preco" name="preco" placeholder="Preço" required>
                    <select id="categoria" name="categoria" required>
                        <option class="cat" value="">Selecione a Categoria</option>
                            <?php
                                include("banco.php");
                                $sql = "SELECT id, nome FROM categorias";

                                $resultado = $conexao->query($sql);

                                foreach($resultado as $categoria){
                                    echo "<option value='" . $categoria['id'] . "'>" . $categoria['nome'] . "</option>";
                                }
                            ?>
                    </select>
                    <div class="anexarimagem">
                        <label for="imagem">Anexar Imagem:</label>
                        <input type="file" id="imagem" name="imagem" accept="image/*" required>
                    </div>
                    <input type="text" id="qtd_estoque" name="qtd_estoque" placeholder="Quantidade" required>
                </div>
                <div class="button-container">
                    <button type="submit">Cadastrar</button>
                    <a href="produtos.php" class="btn-voltar">Voltar</a>
                </div>
            </form>
    </div>
</body>
</html>