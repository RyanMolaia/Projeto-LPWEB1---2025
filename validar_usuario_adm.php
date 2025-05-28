<?php
    session_start();
    include("banco.php");



    $user= $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if($conexao->connect_error){
        die ("falha na conexão : ".$conexao->connect_error ); //encerra imediatamente e mostra a mensagem antes
    }

    $statement = $conexao->prepare("SELECT * from usuarios WHERE usuario = ? AND adm = '1'"); //ele vai preparar
    $statement->bind_param("s",$user); //joga o valor $username no lugar do ?
    $statement->execute(); //esta enviando o valor
    $result = $statement->get_result(); // pega o resultado


    if($result->num_rows === 1){
        $usuario = $result->fetch_assoc();

        if($senha == $usuario['senha']) {
            $_SESSION['usuario'] = $user;
            header("Location: menu_administrativo.php"); 
            exit;
        }
        else{
        echo "
        <script>
                alert('Senha Incorreta');
                window.location.href = 'tela_login_adm.php';
            </script>
            ";
        }
    }
    else{
            echo "
            <script>
                alert('Usuário desconhecido!');
                window.location.href = 'tela_login_adm.php';
            </script>
                    ";
    }

    $statement->close();
    $conexao->close();
?>
