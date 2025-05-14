<?php

include("banco.php");

sesson_start();

$_SESSION['usuario'] = $_POST['user'];
$_SESSION['password'] = $_POST['password'];




if($conexao->connect_error){
    die ("falha na conexão 2 : ".connect_error );
}

?>