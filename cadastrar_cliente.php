<?php

$user = $_POST['user'] ?? '';
$senha = $_POST['password'] ?? ''; 
$senha_conf = $_POST['password_confirm'] ?? ''; 
$email = $_POST['e-mail'] ?? '';
$telefone = $_POST['telefone'] ?? '';

echo $user;
echo $senha;
echo $senha_conf;
echo $email;
echo $telefone;




?>