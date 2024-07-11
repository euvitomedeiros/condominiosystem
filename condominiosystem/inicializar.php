<?php
require_once 'Model/db_connect.php';
require_once 'Model/UserModel.php';

$nome = 'Usuario admin';
$email = 'admin@administrador.com.br';
$telefone = '1234567890';
$cpf = '11111';
$rg = '111111';
$senha = 'senha2024';
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$tipo_usuario = 'administrador';

$sql = "INSERT INTO usuario (nome_usuario, email, telefone, cpf, rg, senha_usuario, tipo_acesso) VALUES ('$nome', '$email', '$telefone', '$cpf', '$rg', '$senha_hash', '$tipo_usuario')";

if (mysqli_query($connect, $sql)) {
    echo "Usuário criado com sucesso.";
} else {
    echo "Erro ao criar usuário administrador: " . mysqli_error($connect);
}
?>
