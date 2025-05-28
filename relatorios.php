<?php

include("banco.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Vendas</title>
    <link rel="stylesheet" href="produtos.css">
</head>
<body>
    <header>
        <div class="topo">
            <div class="esquerda">
                <a href="#sidebar" id="btn-departamento">☰</a>
                <a href="menu_administrativo.php"><img class="logo" src="img/logo.png" alt=""></a>
            </div>
            <div class="meio">
                <h3>Vendas StoreComp</h>
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
                        <li><a href="funcionarios.php">Funcionários</a></li>
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
                <form action="relatorios.php" method="POST">
                    <input type="text" name="buscar" placeholder="Buscar">
                    <button class="pesquisa">🔍</button>
                </form>
            </div>
            <table class="tabela">
                <thead>
                    <tr class="cabecalho">
                        <th>ID Venda</th>
                        <th>Data da Venda</th>
                        <th>Cliente</th>
                        <th>Endereço Entrega</th>
                        <th>Forma de Pagamento</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Total Item</th>
                    </tr>
                </thead>
            <?php

                $busca = isset($_POST['buscar']) ? trim($_POST['buscar']) : '';
                $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';

                $sql = "SELECT 
                            v.id AS vendas_id,
                            v.data_venda,
                            v.endereco_entrega,
                            v.metodo_pagamento,
                            u.usuario AS cliente,
                            p.nome AS produto,
                            vi.quantidade,
                            vi.preco_unitario,
                            (vi.quantidade * vi.preco_unitario) AS total_item
                        FROM vendas v
                        JOIN usuarios u ON v.id_usuario = u.id
                        JOIN vendas_itens vi ON v.id = vi.vendas_id
                        JOIN produtos p ON vi.produtos_id = p.id";


                if(!empty($busca)){
                $sql .= " WHERE LOWER(p.nome) LIKE LOWER('%$busca%') OR LOWER(u.usuario) LIKE LOWER('%$busca%')";
                }

                $sql .= " ORDER BY v.data_venda DESC, v.id";
                
                $retorno = $conexao->query($sql);
                foreach($retorno as $linha){
                    echo "<tr>
                            <td>" . $linha['vendas_id'] . "</td>
                            <td>" . $linha['data_venda'] . "</td>
                            <td>" . $linha['cliente'] . "</td>
                            <td>" . $linha['endereco_entrega'] . "</td>
                            <td>" . $linha['metodo_pagamento'] . "</td>
                            <td>" . $linha['produto'] . "</td>
                            <td>" . $linha['quantidade'] . "</td>
                            <td>" . $linha['preco_unitario'] . "</td>
                            <td>" . $linha['total_item'] . "</td>
                        </tr>";
                }
                ?>
                </div>
            </tbody>
            </table>
        </main>
</body>
</html>