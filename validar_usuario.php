<?php

include("banco.php");

$user = $_POST['user'];
$password = $_POST['password'];


$conexao = mysqli("127.0.0.1", "root", "", "storecomp");

if($conexao->conect_error){
    die ("falha na conexão: ".conect_error )
}





?>