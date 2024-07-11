<?php
session_start();
require_once '../Model/db_connect.php';
require_once '../Model/ReservaAreaComumModel.php';

$model = new ReservaModel($connect);

// Operação para criar uma nova reserva
if(isset($_POST['btn-postar'])) {
    $moradorId = $_POST['moradorId'];
    $area = $_POST['reservaArea'];
    $dataReserva = $_POST['dataReserva'];
    $horaReserva = $_POST['horaReserva'];

    if($model->criarReserva($usuarioId, $moradorId, $area, $dataReserva, $horaReserva)) {
        $_SESSION['mensagem'] = "Reserva realizada com sucesso!";
        header('Location: ../View/listar_reservas.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao realizar reserva.";
        header('Location: ../View/listar_reservas.php');
        exit();
    }
}

// Operação para obter todas as reservas
$reservas = $model->obterTodasReservas();

// Operação para obter uma reserva específica para edição
if(isset($_GET['reserva_id'])) {
    $reservaId = $_GET['reserva_id'];
    $reserva = $model->obterReservaPorId($reservaId);
}

// Operação para atualizar uma reserva existente
if(isset($_POST['btn-atualizar'])) {
    $reservaId = $_POST['reservaId'];
    $area = $_POST['reservaArea'];
    $dataReserva = $_POST['dataReserva'];
    $horaReserva = $_POST['horaReserva'];

    if($model->atualizarReserva($reservaId, $moradorId, $area, $dataReserva, $horaReserva)) {
        $_SESSION['mensagem'] = "Reserva atualizada com sucesso!";
        header('Location: ../View/listar_reservas.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar reserva.";
        header('Location: ../View/listar_reservas.php');
        exit();
    }
}

// Operação para excluir uma reserva
if(isset($_GET['excluir_id'])) {
    $reservaId = $_GET['excluir_id'];

    if($model->excluirReserva($reservaId)) {
        $_SESSION['mensagem'] = "Reserva excluída com sucesso!";
        header('Location: ../View/listar_reservas.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir reserva.";
        header('Location: ../View/listar_reservas.php');
        exit();
    }
}
?>
