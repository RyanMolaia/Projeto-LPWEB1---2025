<?php

    session_start();
    include("banco.php");

    $id = @$_GET['id'];

    $sql = "SELECT * FROM categorias WHERE id='$id'";

    $resultado = $conexao->query($sql);
    $dados = mysqli_fetch_assoc($resultado);

    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';

    $erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($nome)){
        $erros[] = "Nome é obrigatório";
    }

    if (count($erros) === 0) {
    $stmt = $conexao->prepare("UPDATE categorias SET nome = ? WHERE id = ?");
    $stmt->bind_param("si", $nome, $id);
    
    if ($stmt->execute()) {
        $_SESSION['sucesso'] = "Categoria atualizada com sucesso!";
        header("Location: categorias.php");
        exit;
    } else {
        $erros[] = "Erro ao atualizar categoria.";
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
    <title>Alteração de Categoria <?php echo $dados["nome"]; ?></title>
    <link rel="stylesheet" href="editarcat.css">
</head>
<body>
    <div class="tudo">
        <div class="title">
                <div class="img">
                    <a class="" href="menu_administrativo.php"><img class="logo" src="img/logo.png" alt=""></a>
                </div>
                <h2>Edição de Categoria</h2>
        </div>
        <?php if (!empty($erros)): ?>
            <div class="alerta-erros">
                <ul>
                    <?php foreach ($erros as $erro): ?>
                        <li><?php echo htmlspecialchars($erro); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="editar">
            <form action="?id=<?php echo $dados['id']; ?>" method="POST" enctype="multipart/form-data" >
                <div class="input-group">
                    
                    <div class="tp_input">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo $dados["nome"]; ?>" />
                    </div>

                    <div class="button-container">
                        <button type="submit">Salvar</button>
                        <a href="categorias.php" class="btn-voltar">Voltar</a>
                    </div>
                </div>
                </form>
        </div>
    </div>
<script>
    setTimeout(function() {
        var alerta = document.querySelector('.alerta-erros');
        if(alerta) {
            alerta.remove();
        }
    }, 5000);
</script>

</body>
</html>