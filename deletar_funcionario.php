<?php

    include("banco.php");

    $id = @$_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id='$id'";

    if($conexao->query($sql) == TRUE){
        echo "<script>alert('Usuário deletado!');
        window.location.href = 'funcionarios.php';
        </script>";
    }

?>