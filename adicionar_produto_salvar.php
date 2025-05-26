<?php

    include("banco.php");

    $nome = @$_POST['nome'];
    $preco = str_replace(',','.',@$_POST['preco']);
    $categoria = @$_POST['categoria'];
    $qtd_estoque = @$_POST['qtd_estoque'];

    $imagem = $_FILES['imagem'];
    $nomeimagem = $imagem['name'];
    $caminhotemp = $imagem['tmp_name'];

    $pastadestino = "img/";
    $caminhodestino = $pastadestino . basename($nomeimagem);

    if($nome == ''){
        echo "Nome é obrigatório";
    }
    if($preco == '' && $preço < 0){
        echo "Preço é obrigatório";
    }
    if($categoria == ''){
        echo "Categoria é obrigatória";
    }
    if($qtd_estoque == ''){
        echo "Quantidade em estoque é obrigatório";
    }
    if($imagem == ''){
        echo "Imagem é obrigatório";
    }

    if(move_uploaded_file($caminhotemp, $caminhodestino)){
        $sql = "INSERT INTO produtos(nome, preco, categorias_id, imagem, qtd_estoque) VALUES (?,?,?,?,?)";
        $resultado = $conexao->prepare($sql);
        $resultado->bind_param("sdssi", $nome, $preco, $categoria, $caminhodestino, $qtd_estoque);

        if($resultado->execute()){
            echo "
                <script>
                    alert('✅ Produto cadastrado com sucesso!');
                    window.location.href = 'produtos.php';
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('❌ Ocorreu um erro ao cadastrar o produto.');
                    window.history.back();
                </script>
                ";
        }
        $resultado->close();
    }else{
            echo "
                <script>
                    alert('❌ Ocorreu um erro ao carregar a imagem.');
                    window.history.back();
                </script>
                ";
        }
?>