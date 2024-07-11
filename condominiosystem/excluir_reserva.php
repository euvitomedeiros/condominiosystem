// excluir_reserva.php
<?php
session_start();
require_once 'Model/db_connect.php';
require_once 'Model/ReservaModel.php';

// Inicializa a classe ReservaModel
$model = new ReservaModel($connect);

// Verifica se o usuário está logado e se o ID da reserva foi passado na URL
if(isset($_SESSION['usuario_id']) && isset($_GET['id'])) {
    $reservaId = $_GET['id'];

    // Tenta excluir a reserva do banco de dados
    if($model->excluirReserva($reservaId)) {
        // Redireciona de volta para a página de listagem de reservas
        header('Location: listadereservas.php');
    } else {
        // Emite mensagem de erro e redireciona de volta para a página de listagem de reservas
        echo "<script>alert('Erro ao excluir a reserva.'); window.location.href = 'listadereservas.php';</script>";
    }
} else {
    // Emite mensagem de erro e redireciona para a página de login caso o usuário não esteja logado
    echo "<script>alert('Você precisa estar logado para excluir uma reserva.'); window.location.href = 'login.php';</script>";
}

$connect->close();
?>
