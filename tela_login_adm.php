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
                <a class="" href="loja.php"><img class="logo" src="img/logo.png"></a>
            </div>
            <h2>Login - ADM</h2>
        </div>
        <div class="mensage-attention">
            <div>
                <h4>Atenção!</h4>
                <p>Caso deseje criar ou acessar usuário de Administrador</p>
                <p>por favor consutar suporte ou equipe de TI</p>
            </div>
        </div>

            <form action="#" method="post">
                <div class="input-group">
                    <input type="text" id="usuario" name="usuario" placeholder="👤 Usuário" required>
                    <input type="text" id="senha" name="senha" placeholder="🔑 Senha" required>
                </div>   
                <div class="button-container">

                    <button type="submit">Entrar</button>

                </div>
            </form>
    </div>
</body>
</html>
