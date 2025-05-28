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
                <h3>Produtos StoreComp</h>
        </div>
            <div class="direita">
                <a href="menu_administrativo.php">👤 Conta</a>
                <a href="logout_adm.php">🚪 Sair</a>
            </div>
        </div>
            <aside id="sidebar">
                <a href="#" id="fechar-sidebar">🡸</a>
                    <ul>
                        <li><a href="categorias.php">Categorias</a></li>
                        <li><a href="funcionarios.php">Funcionários</a></li>
                        <li><a href="relatorios.php">Relatórios</a></li>
                    </ul>
            <div class="voltar">
                <a href="menu_administrativo.php">Voltar</a>
            </div>
            <div class="suporte">
                <a href="suporte.php">Suporte</a>
            </div>
        </aside>
    </header
        <main class="tabela-main">
            <div class="busca">
                <form action="produtos.php" method="POST">
                    <input type="text" name="buscar" placeholder="Buscar">
                    <button class="pesquisa">🔍</button>
                    <div class="cat">
                        <select name="categoria">
                            <option value="">Categorias</option>
                            <?php
                            $cats = $conexao->query("SELECT id, nome FROM categorias");
                            foreach ($cats as $cat) {
                                $selected = (isset($_POST['categoria']) && $_POST['categoria'] == $cat['id']) ? 'selected' : '';
                                echo "<option value='{$cat['id']}' $selected>{$cat['nome']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
                    <a href="adicionar_produto.php"><button class="adicionarproduto">Adicionar Produto</button></a>
            </div>
            <table class="tabela">
                <thead>
                    <tr class="cabecalho">
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Qtd Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            <?php

                $busca = isset($_POST['buscar']) ? trim($_POST['buscar']) : '';
                $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';

                $sql = "SELECT produtos.*, categorias.nome AS nome_categoria FROM produtos 
                        LEFT JOIN categorias ON produtos.categorias_id = categorias.id";


                if(!empty($busca)){
                $sql .= " WHERE LOWER(produtos.nome) LIKE LOWER('%$busca%')";
                }

                if(!empty($categoria)){
                    $sql .= " WHERE categorias_id LIKE '%$categoria%'";
                }
                
                $retorno = $conexao->query($sql);
                foreach($retorno as $linha){
                    echo "<tr>
                        <td>" . $linha['id'] . "</td>
                        <td>" . $linha['nome'] . "</td>
                        <td>" . $linha['preco'] . "</td>
                        <td>" . $linha['nome_categoria'] . "</td>
                        <td>" . $linha['qtd_estoque'] . "</td>
                        <td class='linhas'>
                            <a href='editar_produto.php?id=". $linha['id']."' class='editar'>✏️</a>
                            <a href='deletar_produto.php?id=". $linha['id'] ."' class='excluir' onclick=\"return confirm('Tem certeza?')\">🗑️</a>
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