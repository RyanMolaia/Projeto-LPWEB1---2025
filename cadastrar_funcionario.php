<?php
include("banco.php");


$user = $_POST['user'] ?? '';
$senha = $_POST['password'] ?? ''; 
$senha_conf = $_POST['password_confirm'] ?? ''; 
$email = $_POST['e-mail'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$adm = 1;



$statement = $conexao->prepare("SELECT * from usuarios WHERE usuario = ? AND adm = '1'"); //ele vai preparar
$statement->bind_param("s",$user); //joga o valor $username no lugar do ?
$statement->execute(); //esta eniando o valor 
$result = $statement->get_result(); // pea o resultado


$usuario = $result->fetch_assoc();
if($user == $usuario["usuario"]){
    echo "
        <script>
                alert('Nome de usuario já existente');
                window.location.href = 'adicionar_funcionario.php';
        </script>
    ";    
}else{
if($senha != $senha_conf){
    echo "
        <script>
                alert('Senhas diferentes!');
                window.location.href = 'adicionar_funcionario.php';
        </script>
    ";
}
else{
        $sql = "INSERT INTO usuarios(usuario, senha, email, telefone, adm) VALUES (?,?,?,?,?)";
       if($resultado = $conexao->prepare($sql)){
        $resultado->bind_param("sssii", $user, $senha, $email, $telefone, $adm);
        $resultado->execute();
        echo "
            <script>
                alert('Cadastro realizado com sucesso!');
                window.location.href = 'funcionarios.php';
            </script>
        ";
}
else {
        echo "Erro ao preparar a consulta: " . $conexao->error;
    }}}
?>