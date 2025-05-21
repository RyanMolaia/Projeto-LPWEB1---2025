<?php

    include("banco.php");

    $id = @$_POST['id'];
    $nome = @$_POST['nome'];
    $preco = @$_POST['preco'];
    $categoria = @$_POST['categoria'];
    $qtd_estoque = @$_POST['qtd_estoque'];

    $sql = "UPDATE produtos
            SET categorias_id='$categoria',
            nome='$nome',
            preco='$preco',
            qtd_estoque='$qtd_estoque'
            WHERE id='$id'";

    $conexao->query($sql);
    header("location:/Projetos/StoreComp/produtos.php");

?>