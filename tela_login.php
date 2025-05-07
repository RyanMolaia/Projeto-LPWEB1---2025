<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="logon.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <h2>Login</h2>
        </div>
        <div class="mensage-attention">
            <h4>Atenção:</h4>
            <p>Caso deseje criar usuário de Administrador</p>
            <p>por favor consutar suporte ou equipe de TI</p>
        </div>

            <form action="#" method="post">
                <div class="input-group">
                    <input type="text" id="usuario" name="usuario" placeholder="Usuário" required>
                    <input type="text" id="senha" name="senha" placeholder="Senha" required>
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
