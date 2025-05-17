<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos</title>
    <link rel="stylesheet" href="produtos.css">
</head>
<body>
    <header>
        <div class="topo">
            <div class="esquerda">
                <a href="#sidebar" id="btn-departamento">☰</a>
                <a href="loja.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <div class="meio">
                <h3>Produtos StoreComp</h>
        </div>
            <div class="direita">
                <a href="tela_login.php">👤 Conta</a>
            </div>
        </div>
            <aside id="sidebar">
                <a href="#" id="fechar-sidebar">🡸</a>
                    <ul>
                        <li><a href="monitores.php">Cadastro de Funcionário</a></li>
                        <li><a href="notebooks.php">Relatórios</a></li>
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
                <form action="produtos.php" method="POST">
                    <input type="text" name="buscar" placeholder="Buscar">
                    <button class="pesquisa">🔍</button>
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

                include ("banco.php");

                $busca = isset($_POST['buscar']) ? trim($_POST['buscar']) : '';

                $sql = "SELECT * FROM produtos";

                if(!empty($busca)){
                $sql .= " WHERE LOWER(nome) LIKE LOWER('%$busca%')";
                }
                
                $retorno = $conexao->query($sql);

                foreach($retorno as $linha){
                    echo "<tr>
                        <td>" . $linha['id'] . "</td>
                        <td>" . $linha['nome'] . "</td>
                        <td>" . $linha['preco'] . "</td>
                        <td>" . $linha['categorias_id'] . "</td>
                        <td>" . $linha['qtd_estoque'] . "</td>
                        <td class='linhas'>
                            <a href='editar_cliente.php?id=".$linha['id']."' class='editar'>✏️</a>
                            <a href='deletar_cliente.php?id=".$linha['id']."' class='excluir' onclick=\"return confirm('Tem certeza?')\">🗑️</a>
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