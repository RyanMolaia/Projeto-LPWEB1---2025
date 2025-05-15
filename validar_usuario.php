<?php

include("banco.php");



$user= $_POST['user'] ?? '';
$senha = $_POST['password'] ?? '';

if($conexao->connect_error){
    die ("falha na conexão : ".$conexao->connect_error ); //encerra imediatamente e mostra a mensagem antes
}

$statement = $conexao->prepare("SELECT senha from usuarios WHERE usuario = ?"); //ele vai preparar
$statement->bind_param("s",$user); //joga o valor $username no lugar do ?
$statement->execute(); //esta eniando o valor 
$result = $statement->get_result(); // pea o resultado


if($result->num_rows === 1){
    $usuario = $result->fetch_assoc();

    if(password_verify($senha, $usuario['senha'])) {
        header("Location: menu_cliente.php"); 
        exit;
    }
    else{
        echo "Senha errada";
    }
}
else{
    echo "Usuario errado";
}
$statement->close();
$conexao->close();
?>