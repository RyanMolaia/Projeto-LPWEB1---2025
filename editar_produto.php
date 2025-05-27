<?php

    session_start();
    include("banco.php");

    $id = @$_GET['id'];

    $sql = "SELECT * FROM produtos WHERE id='$id'";

    $resultado = $conexao->query($sql);
    $dados = mysqli_fetch_assoc($resultado);

    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $preco = isset($_POST['preco']) ? trim($_POST['preco']) : '';
    $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';
    $qtd_estoque = isset($_POST['qtd_estoque']) ? trim($_POST['qtd_estoque']) : '';
    $imagem = isset($_POST['imagem']);

    $erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($nome)){
        $erros[] = "Nome é obrigatório";
    }

    if(empty($preco)){
        $erros[] = "Preço é obrigatório";
    }elseif(!is_numeric($preco) || $preco <= 0){
        $erros[] = "Preço inválido. Digite um valor maior que 0.";
    }

    if(empty($categoria)){
        $erros[] = "Categoria é obrigatória";
    }
    if(!filter_var($qtd_estoque, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])){
        $erros[] = "Quantidade em estoque deve ser um número inteiro maior que zero.";
    }

    if(count($erros) == 0){
        $update = "UPDATE produtos
                    SET categorias_id='$categoria',
                        nome='$nome',
                        preco='$preco',
                        qtd_estoque='$qtd_estoque'
                    WHERE id='$id'";
        $conexao->query($update);
        $_SESSION['sucesso'] = "Produto atualizado com sucesso!";
        header("location: produtos.php");
        exit;

    }
}
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
                        <input class="campo_estoque" type="number" name="qtd_estoque" value="<?php echo $dados["qtd_estoque"]; ?>" />
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