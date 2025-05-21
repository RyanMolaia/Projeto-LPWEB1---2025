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
    <link rel="stylesheet" href="cadastroprod.css">
</head>
<body>
    <form action="editar_produto_salvar.php" method="POST" >
        <div>
            <span>ID</span>
            <input type="number" name="id" value="<?php echo $dados["id"]; ?>" readonly />
        </div>
        <div>
            <span>Nome</span>
            <input type="text" name="nome" value="<?php echo $dados["nome"]; ?>" />
        </div>
        <div>
            <span>Preço</span>
            <input type="number" name="preco" value="<?php echo $dados["preco"]; ?>" />
        </div>
        <div>
            <select id="categoria" name="categoria" required>
                        <option class="cat" value="">Selecione a Categoria</option>
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
        <div>
            <span>Quantidade em Estoque</span>
            <input type="text" name="qtd_estoque" value="<?php echo $dados["qtd_estoque"]; ?>" />
        </div>
        <div>
            <input type="submit" value="Salvar" class="btn btn-primary" />
            <a href="produtos.php" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</body>
</html>