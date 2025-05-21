<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="tela_login_cliente.css">
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
        <div class="forms-container">
            <form  action="validar_usuario.php" method="post">
                    <input type="text" id="user" name="user" placeholder="👤 Usuário" required>
                    <input type="password" id="password" name="password" placeholder="🔑 Senha" required>
                    <a class="esq-senha" href="#">Esqueceu sua senha</a>
                    <div class="buttons">
                        <button type="submit">Entrar</button>
                        <a href="tela_cadastro.php">Cadastrar</a>
                    </div>
            </form>
                    
        </div> 
    </div>
</body>
</html>
