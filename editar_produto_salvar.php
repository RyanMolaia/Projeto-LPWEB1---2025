<?php

    include("banco.php");

    $id = @$_POST['id'];
    $nome = @$_POST['nome'];
    $preco = @$_POST['preco'];
    $categoria = @$_POST['categoria'];
    $qtd_estoque = @$_POST['qtd_estoque'];


    if($nome == ''){
        echo "Nome é obrigatório";
    }
    if($preco == ''){
        echo "Preço é obrigatório";
    }
    if($preco <= 0){
        echo "Preço é inválido, digite um valor maior que 0";
    }
    if($categoria == ''){
        echo "Categoria é obrigatória";
    }
    if($qtd_estoque == ''){
        echo "Quantidade em estoque é obrigatório";
    }
    
    $sql = "UPDATE produtos
            SET categorias_id='$categoria',
            nome='$nome',
            preco='$preco',
            qtd_estoque='$qtd_estoque'
            WHERE id='$id'";

    $conexao->query($sql);
    header("location:/Projetos/StoreComp/produtos.php");

?>