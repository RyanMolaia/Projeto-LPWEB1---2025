<?php

    include("banco.php");

    $id = @$_GET['id'];

    $sql = "DELETE FROM produtos WHERE id='$id'";

    if($conexao->query($sql) == TRUE){
        echo "<script>alert('Produto deletado!');
        window.location.href = 'produtos.php';
        </script>";
    }

?>