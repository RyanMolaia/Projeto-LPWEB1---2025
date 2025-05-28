<?php

include("banco.php");
session_start();

$mensagem_sucesso = '';
if (isset($_SESSION['sucesso'])) {
    $mensagem_sucesso = $_SESSION['sucesso'];
    unset($_SESSION['sucesso']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos</title>
    <link rel="stylesheet" href="produtos.css">
</head>
<body>
        <?php if (!empty($mensagem_sucesso)): ?>
            <div class="alerta alerta-sucesso" id="mensagem-sucesso">
                ✅ <?php echo htmlspecialchars($mensagem_sucesso); ?>
            </div>
        <?php endif; ?>
    <header>
        <div class="topo">
            <div class="esquerda">
                <a href="#sidebar" id="btn-departamento">☰</a>
                <a href="menu_administrativo.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <div class="meio">
                <h3>Categorias StoreComp</h>
        </div>
            <div class="direita">
                <a href="tela_login.php">👤 Conta</a>
            </div>
        </div>
            <aside id="sidebar">
                <a href="#" id="fechar-sidebar">🡸</a>
                    <ul>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="cadastro_usuarios_adm.php">Cadastro de Usuários</a></li>
                        <li><a href="relatorios.php">Relatórios</a></li>
                    </ul>
            <div class="voltar">
                <a href="">Voltar</a>
            </div>
            <div class="suporte">
                <a href="suporte.php">Suporte</a>
            </div>
        </aside>
    </header
        <main class="tabela-main">
            <div class="busca">
                <form action="categorias.php" method="POST">
                    <input type="text" name="buscar" placeholder="Buscar">
                    <button class="pesquisa">🔍</button>
                </form>
                    <a href="adicionar_categorias.php"><button class="adicionarproduto">Adicionar Categoria</button></a>
            </div>
            <table class="tabela">
                <thead>
                    <tr class="cabecalho">
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            <?php

                $busca = isset($_POST['buscar']) ? trim($_POST['buscar']) : '';
                $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';

                $sql = "SELECT * FROM categorias";

                if(!empty($busca)){
                $sql .= " WHERE LOWER(nome) LIKE LOWER('%$busca%')";
                }
                
                $retorno = $conexao->query($sql);
                foreach($retorno as $linha){
                    echo "<tr>
                        <td>" . $linha['id'] . "</td>
                        <td>" . $linha['nome'] . "</td>
                        <td class='linhas'>
                            <a href='editar_categorias.php?id=". $linha['id']."' class='editar'>✏️</a>
                            <a href='deletar_categorias.php?id=". $linha['id'] ."' class='excluir' onclick=\"return confirm('Tem certeza?')\">🗑️</a>
                    </td>
                    </tr>";
                }
                ?>
                </div>
            </tbody>
            </table>
        </main>
</body>
</html>