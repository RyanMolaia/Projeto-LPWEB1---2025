<?php

    session_start();
    include("banco.php");

    $id = @$_GET['id'];

    $sql = "SELECT * FROM usuarios WHERE id='$id'";

    $resultado = $conexao->query($sql);
    $dados = mysqli_fetch_assoc($resultado);

    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
    $adm = isset($_POST['adm']) ? trim($_POST['adm']) : '';

    $erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($usuario)){
        $erros[] = "Usuário é obrigatório";
    }

    if(empty($senha)){
        $erros[] = "Senha é obrigatório";
    }

    if(empty($email)){
        $erros[] = "E-mail é obrigatório";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erros[] = "E-mail inválido. Digite um e-mail no formato correto!";
    }

    if(empty($telefone)){
        $erros[] = "Telefone é obrigatório";
    }

    if(empty($adm)){
        $erros[] = "Permissão é obrigatória";
    }

    if(count($erros) == 0){
        $update = "UPDATE usuarios
                    SET usuario='$usuario',
                        email='$email',
                        telefone='$telefone',
                        adm='$adm'
                    WHERE id='$id'";
        $conexao->query($update);
        $_SESSION['sucesso'] = "Usuário atualizado com sucesso!";
        header("location: funcionarios.php");
        exit;

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração do Usuário <?php echo $dados["nome"]; ?></title>
    <link rel="stylesheet" href="editarfunc.css">
</head>
<body>
    <div class="tudo">
        <div class="title">
                <div class="img">
                    <a class="" href="menu_administrativo.php"><img class="logo" src="img/logo.png" alt=""></a>
                </div>
                <h2>Edição de Usuário</h2>
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
                   
                        <label>Usuário</label>
                        <input type="text" name="usuario" value="<?php echo $dados["usuario"]; ?>" />

                        <label>Senha</label>
                        <input type="password" name="senha" value="<?php echo $dados["senha"]; ?>" />
                    </div>
                    <div class="meio_input">
                        <label>E-Mail</label>
                        <input class="campo_estoque" type="text" name="email" value="<?php echo $dados["email"]; ?>" />
                    </div>
                    <div class="final_input">
                        <div class="imagem-atual">
                            <label>Telefone</label>
                            <input type="number" name="telefone" value="<?php echo $dados['telefone']; ?>" />
                        </div>
                        <div class="anexarimagem">
                            <label>Permissão</label>
                            <input type="int" name="adm" value="<?php echo $dados['adm']; ?>" />
                        </div>
                    </div>
                        
                    <div class="button-container">
                        <button type="submit">Salvar</button>
                        <a href="funcionarios.php" class="btn-voltar">Voltar</a>
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