<?php include("banco.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="logon.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <div class="img">
                <a class="" href="loja.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <h2>Login</h2>
        </div>
        <div class="space"></div>
            <form  action="validar_usuario.php" method="post">
                <div class="input-group">
                    <input type="text" id="user" name="user" placeholder="👤 Usuário" required>
                    <input type="password" id="password" name="password" placeholder="🔑 Senha" required>
                </div>
                
                <div class="forget-password">
                    <a href="#">Esqueceu sua senha</a>
                </div>
                
                <div class="button-container">
                    <button type="submit">Entrar</button>

                    <button type="submit">Cadastrar</button>
                </div>
            </form>
    </div>
</body>
</html>
