<?php

    include("banco.php");
    session_start();

    $erros = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');

    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }

    if (count($erros) === 0) {
            $sql = "INSERT INTO categorias (nome) 
                    VALUES (?)";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $nome);

            if ($stmt->execute()) {
                $_SESSION['sucesso'] = "Categoria cadastrada com sucesso!";
                header("Location: categorias.php");
                exit;
            } else {
                $erros[] = "❌ Ocorreu um erro ao cadastrar a categoria.";
            }

            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="cadastrocat.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <div class="img">
                <a class="" href="loja.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <h2>Cadastro de Categoria</h2>
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
            <form  action="adicionar_categorias.php" method="post">
                <div class="input-group">
                    <input type="text" id="nome" name="nome" placeholder="Nome" required>
                </div>
                <div class="button-container">
                    <button type="submit">Cadastrar</button>
                    <a href="categorias.php" class="btn-voltar">Voltar</a>
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