<?php
include_once 'Model/db_connect.php';
include_once 'includes/auth.php';



$sql = "SELECT r.*, u.nome_usuario AS nome_usuario 
        FROM reclamacao r 
        JOIN usuario u ON r.usuario_id = u.usuario_id 
        ORDER BY r.data_criacao DESC";

$result = mysqli_query($connect, $sql);

if (!$result) {
    echo "Erro na consulta: " . mysqli_error($connect);
} else {
    echo "Consulta realizada com sucesso. <br>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Nome do Usuário: " . htmlspecialchars($row['nome_usuario']) . "<br>";
        echo "Título: " . htmlspecialchars($row['titulo']) . "<br>";
        echo "Mensagem: " . htmlspecialchars($row['mensagem']) . "<br>";
        echo "Data de Criação: " . htmlspecialchars($row['data_criacao']) . "<br><br>";
    }
}
?>
