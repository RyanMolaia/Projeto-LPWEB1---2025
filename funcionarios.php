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
    <title>Gestão de Funcionários</title>
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
                <h3>Funcionários StoreComp</h>
        </div>
            <div class="direita">
                <a href="menu_administrativo.php">👤 Conta</a>
                <a href="logout_adm.php">🚪 Sair</a>
            </div>
        </div>
            <aside id="sidebar">
                <a href="#" id="fechar-sidebar">🡸</a>
                    <ul>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="categorias.php">Produtos</a></li>
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
                <form action="cadastro_funcionario.php" method="POST">
                    <input type="text" name="buscar" placeholder="Buscar">
                    <button class="pesquisa">🔍</button>
                </form>
                    <a href="adicionar_funcionario.php"><button class="adicionarproduto">Adicionar Funcionario</button></a>
            </div>
            <table class="tabela">
                <thead>
                    <tr class="cabecalho">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Permissão ADM</th>
                        <th>Data Criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            <?php

                $busca = isset($_POST['buscar']) ? trim($_POST['buscar']) : '';

                $sql = "SELECT * FROM usuarios WHERE adm = '1'"; 
                        


                if(!empty($busca)){
                $sql .= " AND LOWER(usuario) LIKE LOWER('%$busca%')";
                }
                
                $retorno = $conexao->query($sql);
                foreach($retorno as $linha){
                    echo "<tr>
                        <td>" . $linha['id'] . "</td>
                        <td>" . $linha['usuario'] . "</td>
                        <td>" . $linha['email'] . "</td>
                        <td>" . $linha['telefone'] . "</td>
                        <td>" . $linha['adm'] . "</td>
                        <td>" . $linha['criado_em'] . "</td>
                        <td class='linhas'>
                            <a href='editar_funcionario.php?id=". $linha['id']."' class='editar'>✏️</a>
                            <a href='deletar_funcionario.php?id=". $linha['id'] ."' class='excluir' onclick=\"return confirm('Tem certeza?')\">🗑️</a>
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