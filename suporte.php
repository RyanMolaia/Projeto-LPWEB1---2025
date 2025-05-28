<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte</title>
    <link rel="stylesheet" href="suporte.css">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <div class="img">
                <a class="" href="loja.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <h2>Suporte</h2>
        </div>
            <form onsubmit="alert('✅ Solicitação aberta com sucesso!')" action="#" method="post">
                <div class="input-group">
                    <input type="text" name="nome" placeholder="Nome" required>
                    <input type="text" name="email" placeholder="E-mail" required>
                    <input type="int" name="telefone" placeholder="Telefone" required>
                    <input type="text" name="descricao" placeholder="Descrição do Problema" required>
                    <input type="file" name="foto" placeholder="Imagem" required>
                </div>

                <div class="button-container">
                    <button type="submit">Abrir Ticket</button>
                    <a href="loja.php" class="btn-voltar">Voltar</a>
                </div>
            </form>
    </div>
</body>
</html>
