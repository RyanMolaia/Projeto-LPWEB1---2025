<?php
include("banco.php");
session_start();

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['user'] ?? '');
    $senha = $_POST['password'] ?? ''; 
    $senha_conf = $_POST['password_confirm'] ?? ''; 
    $email = trim($_POST['e-mail'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $adm = 1;

    // VALIDAÇÕES:
    if (empty($user)) {
        $erros[] = " Usuário é obrigatório.";
    }

    if (empty($senha)) {
        $erros[] = " Senha é obrigatória.";
    }

    if (empty($senha_conf)) {
        $erros[] = " Confirmação de senha é obrigatória.";
    }

    if ($senha !== $senha_conf) {
        $erros[] = " As senhas não coincidem.";
    }

    if (empty($email)) {
        $erros[] = " E-mail é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = " E-mail inválido.";
    }

    if (empty($telefone)) {
        $erros[] = " Telefone é obrigatório.";
    }

    // Somente se não houver erros básicos, verifica se o usuário já existe
    if (count($erros) === 0) {
        $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE usuario = ? AND adm = 1");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $erros[] = " Nome de usuário já existente.";
        }
    }

    // Se não houver erros, prossegue com o cadastro
    if (count($erros) === 0) {
        $sql = "INSERT INTO usuarios(usuario, senha, email, telefone, adm) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssii", $user, $senha, $email, $telefone, $adm);

        if ($stmt->execute()) {
            $_SESSION['sucesso'] = " Funcionário cadastrado com sucesso!";
            header("Location: funcionarios.php");
            exit;
        } else {
            $erros[] = " Erro ao cadastrar o funcionário.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário</title>
    <link rel="stylesheet" href="cadastrofunc.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <div class="img">
                <a class="" href="menu_administrativo.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <h2>Cadastro Funcionário</h2>
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
            <form  action="adicionar_funcionario.php" method="post">
                <div class="input-group">
                    <input type="text" id="user" name="user" placeholder="👤 Usuário" >
                    <input type="password" id="password" name="password" placeholder="🔑 Senha" >
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="🔑 Confirmar senha" >
                    <input type="email" id="e-mail" name="e-mail" placeholder="📧 E-mail" >
                    <input type="number" id="telefone" name="telefone" placeholder="☎️ Telefone" >
                </div>

                <div class="button-container">

                    <button type="submit">Cadastrar</button>
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
