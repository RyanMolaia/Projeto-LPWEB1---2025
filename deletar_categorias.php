<?php

    include("banco.php");

    $id = @$_GET['id'];

    $sql = "DELETE FROM categorias WHERE id='$id'";

    if($conexao->query($sql) == TRUE){
        echo "<script>alert('Categoria deletada!');
        window.location.href = 'categorias.php';
        </script>";
    }

?>