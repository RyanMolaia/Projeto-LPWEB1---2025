<?php include("banco.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="logon.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <div class="img">
                <a class="" href="loja.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <h2>Cadastro</h2>
        </div>
            <form  action="cadastrar_cliente.php" method="post">
                <div class="input-group">
                    <input type="text" id="user" name="user" placeholder="👤 Usuário" required>
                    <input type="password" id="password" name="password" placeholder="🔑 Senha" required>
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="🔑 Confirmar senha" required>
                    <input type="text" id="e-mail" name="e-mail" placeholder="📧 E-mail" required>
                    <input type="text" id="telefone" name="telefone" placeholder="☎️ Telefone" required>
                </div>

                <div class="button-container">

                    <button type="submit">Cadastrar</button>
                </div>
            </form>
    </div>
</body>
</html>
