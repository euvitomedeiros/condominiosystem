<?php
session_start();

include_once '../Model/db_connect.php';
include_once '../Model/SolicitacaoAcessoModel.php';

$model = new SolicitacaoAcessoModel($connect);

if (isset($_POST['btn-solicitar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    if ($senha !== $confirma_senha) {
        $_SESSION['mensagem'] = "As senhas não coincidem.";
        header('Location: ../solicitar_acesso.php');
        exit;
    }

    if ($model->createAccessRequest($nome, $email, $telefone, $cpf, $rg, $senha)) {
        $_SESSION['mensagem'] = "Solicitação enviada com sucesso!";
        header('Location: ../solicitacao_realizada.php');
    } else {
        $_SESSION['mensagem'] = "Erro ao enviar solicitação.";
        header('Location: ../solicitar_acesso.php');
    }
    exit;
}


if (isset($_GET['approve'])) {
    $requestId = $_GET['approve'];

    if ($model->approveAccessRequest($requestId)) {
        $_SESSION['mensagem'] = "Solicitação aprovada com sucesso!";
    } else {
        $_SESSION['erro'] = "Erro ao aprovar solicitação: " . $_SESSION['mensagem'];
    }

    header('Location: ../solicitacoes_acesso.php');
    exit;
}
?>
