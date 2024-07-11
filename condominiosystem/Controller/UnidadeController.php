<?php
session_start();

include_once '../Model/db_connect.php';
include_once '../Model/UnidadeModel.php';
include_once '../includes/auth.php';

verificarLogin();

$model = new UnidadeModel($connect);

// Criação de Unidade
if (isset($_POST['btn-addUnidade'])) {
    $moradorId = $_POST['moradorId'];
    $numUnidade = $_POST['num_unidade'];
    $andar = $_POST['andar'];
    $numApartamento = $_POST['num_apartamento'];
    $numQuarto = $_POST['num_quarto'];
    
    if ($model->criarUnidade($moradorId, $numUnidade, $andar, $numApartamento, $numQuarto)) {
        $_SESSION['mensagem'] = "Unidade criada com sucesso!";
        header('Location: ../unidades.php');
    } else {
        $_SESSION['mensagem'] = "Erro ao criar unidade.";
        header('Location: ../unidades.php');
    }
    exit;
}

// Edição de Unidade
if (isset($_POST['btn-editarUnidade'])) {
    $id = $_POST['unidade_id'];
    $moradorId = $_POST['moradorId'];
    $numUnidade = $_POST['num_unidade'];
    $andar = $_POST['andar'];
    $numApartamento = $_POST['num_apartamento'];
    $numQuarto = $_POST['num_quarto'];
    
    if ($model->editarUnidade($id, $moradorId, $numUnidade, $andar, $numApartamento, $numQuarto)) {
        $_SESSION['mensagem'] = "Unidade editada com sucesso!";
        header('Location: ../unidades.php');
    } else {
        $_SESSION['mensagem'] = "Erro ao editar unidade.";
        header('Location: ../unidades.php');
    }
    exit;
}

// Exclusão de Unidade
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if ($model->deletarUnidade($id)) {
        $_SESSION['mensagem'] = "Unidade deletada com sucesso!";
        header('Location: ../unidades.php');
    } else {
        $_SESSION['mensagem'] = "Erro ao deletar unidade.";
        header('Location: ../unidades.php');
    }
    exit;
}
?>
