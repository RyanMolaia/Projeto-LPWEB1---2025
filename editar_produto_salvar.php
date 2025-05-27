<?php

    include("banco.php");

    $id = isset($_POST['id']) ? trim($_POST['id']) : '';
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $preco = isset($_POST['preco']) ? trim($_POST['preco']) : '';
    $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';
    $qtd_estoque = isset($_POST['qtd_estoque']) ? trim($_POST['qtd_estoque']) : '';
    $imagem = isset($_POST['imagem']);

    $erros = [];


    if(empty($nome)){
        $erros[] = "Nome é obrigatório";
    }

    if(empty($preco)){
        $erros[] = "Preço é obrigatório";
    }elseif(!is_numeric($preco) || $preco <= 0){
        $erros[] = "Preço inválido. Digite um valor maior que 0.";
    }

    if(empty($categoria)){
        $erros[] = "Categoria é obrigatória";
    }
    if($qtd_estoque === '' || !is_numeric($qtd_estoque)){
        $erro[] = "Quantidade em estoque é obrigatório";
    }elseif($qtd_estoque <= 0){
        $erros[] = "Quantidade inválida. Digite um valor maior que 0.";
    }

    if(count($erros) == 0){
        $sql = "UPDATE produtos
                    SET categorias_id='$categoria',
                        nome='$nome',
                        preco='$preco',
                        qtd_estoque='$qtd_estoque'
                    WHERE id='$id'";
        $conexao->query($sql);
        header("location:/Projetos/StoreComp/produtos.php");
    }else{
        foreach($erros as $linha){
            echo "<li>$linha</li>";
        }
    }
?>