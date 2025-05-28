<?php

    include("banco.php");
    session_start();

    $erros = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $preco = str_replace(',', '.', $_POST['preco'] ?? '');
    $categoria = $_POST['categoria'] ?? '';
    $qtd_estoque = $_POST['qtd_estoque'] ?? '';
    $imagem = $_FILES['imagem'] ?? null;

    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }

    if (empty($preco)) {
        $erros[] = "Preço é obrigatório";
    } elseif (!is_numeric($preco) || $preco <= 0) {
        $erros[] = "Preço inválido. Digite um valor maior que 0.";
    }

    if (empty($categoria)) {
        $erros[] = "Categoria é obrigatória";
    }

    if (!filter_var($qtd_estoque, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $erros[] = "Quantidade em estoque deve ser um número inteiro maior que zero.";
    }

    if (!$imagem || $imagem['error'] !== 0) {
        $erros[] = "Imagem é obrigatória.";
    }


    if (count($erros) === 0) {
        $nomeimagem = $imagem['name'];
        $caminhotemp = $imagem['tmp_name'];
        $pastadestino = "img/";
        $caminhodestino = $pastadestino . basename($nomeimagem);

        if (move_uploaded_file($caminhotemp, $caminhodestino)) {
            $sql = "INSERT INTO produtos (nome, preco, categorias_id, imagem, qtd_estoque) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("sdssi", $nome, $preco, $categoria, $caminhodestino, $qtd_estoque);

            if ($stmt->execute()) {
                $_SESSION['sucesso'] = "Produto cadastrado com sucesso!";
                header("Location: produtos.php");
                exit;
            } else {
                $erros[] = "❌ Ocorreu um erro ao cadastrar o produto.";
            }

            $stmt->close();
        } else {
            $erros[] = "❌ Erro ao enviar a imagem.";
        }
    }
}
?>

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
                <a class="" href="menu_administrativo.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <h2>Cadastro de Produto</h2>
        </div>
        <?php if (!empty($erros)): ?>
        <div class="alerta alerta-erro">
            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?= htmlspecialchars($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
            <form  action="adicionar_produto.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="text" id="nome" name="nome" placeholder="Nome">
                    <input type="number" id="preco" name="preco" step="0.01" placeholder="Preço">
                    <select id="categoria" name="categoria">
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
                        <input type="file" id="imagem" name="imagem" accept="image/*" >
                    </div>
                    <input type="text" id="qtd_estoque" name="qtd_estoque" placeholder="Quantidade" >
                </div>
                <div class="button-container">
                    <button type="submit">Cadastrar</button>
                    <a href="produtos.php" class="btn-voltar">Voltar</a>
                </div>
            </form>
    </div>
    <script>
        setTimeout(function () {
            let alertas = document.querySelectorAll('.alerta');
            alertas.forEach(alerta => alerta.style.display = 'none');
        }, 5000);
    </script>

</body>
</html>