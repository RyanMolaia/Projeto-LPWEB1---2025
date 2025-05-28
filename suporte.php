<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoreComp</title>
    <link rel="stylesheet" href="suporte.css">
</head>
<body>
    <header>
        <div class="topo">
            <div class="esquerda">
                <a href="#sidebar" id="btn-departamento">☰</a>
            </div>
            <div>
                <a href="loja.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <div class="meio">
                <h3>Suporte StoreComp</h3>
            </div>
            <div class="direita">
                <a href="tela_login.php">👤 Conta</a>
                <a href="carrinho.php">🛒 Carrinho</a>
            </div>
        </div>
    </header>
    <main>
        <div class="info">
            <form>
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="text" name="telefone" placeholder="Telefone" required>
                <input type="text" name="descricao" placeholder="Descrição do Problema" required>
                <input type="text" name="foto" placeholder="Imagem" required>
                <button class="btn-departamento">Anexar</button>
                <button class="btn-departamento">Abrir Ticket</button>
            </form>
        </div>
    </main>
    <aside id="sidebar">
        <a href="#" id="fechar-sidebar">🡸</a>
        <ul>
            <li><a href="desktops.php">Desktops</a></li>
            <li><a href="monitores.php">Monitores</a></li>
            <li><a href="notebooks.php">Notebooks</a></li>
            <li><a href="hardwares.php">Hardwares</a></li>
        </ul>
        <div class="suporte">
            <a href="suporte.php">Suporte</a>
        </div>
    </aside>
</body>
</html>