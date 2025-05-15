<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos</title>
    <link rel="stylesheet" href="suporte.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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
                <h3>Produtos</h3>
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
        <main class="table-responsive">
            <table class=" table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
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

                $nome = "";
                if (isset($_GET['nome'])){
                    $nome = $_GET["nome"];
                }

                $sql = "SELECT * FROM produtos WHERE nome like '%$nome%'";

                $retorno = $conexao->query($sql);

                foreach($retorno as $linha){
                    echo "<tr>
                        <td>" . $linha['id'] . "</td>
                        <td>" . $linha['nome'] . "</td>
                        <td>" . $linha['preco'] . "</td>
                        <td>" . $linha['categorias_id'] . "</td>
                        <td>" . $linha['qtd_estoque'] . "</td>
                        <td class='text-center'>
                            <a href='editar_cliente.php?id=".$linha['id']."' class='btn btn-warning'>✏️</a>
                            <a href='deletar_cliente.php?id=".$linha['id']."' class='btn btn-danger' onclick=\"return confirm('Tem certeza?')\">🗑️</a>
                    </td>
                    </tr>";
                }
                ?>
                </d>
            </tbody>
            </table>
        </main>
</body>
</html>