<?php
session_start();

include_once '../Model/db_connect.php';
include_once '../includes/auth.php';
require_once '../Model/ReclamacaoModel.php';

class ReclamacaoController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function criarReclamacao($usuario_id, $tipoPostagem, $titulo, $mensagem) {
        if ($this->model->criarReclamacao($usuario_id, $tipoPostagem, $titulo, $mensagem)) {
            $_SESSION['mensagem'] = "Postagem realizada com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao realizar postagem.";
        }

        header('Location: ../sugestoes_reclamacoes.php');
    }
}

$model = new ReclamacaoModel($connect);
$controller = new ReclamacaoController($model);

if (isset($_POST['btn-postar'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $tipoPostagem = $_POST['tipoPostagem'];
    $titulo = $_POST['titulo'];
    $mensagem = $_POST['mensagem'];

    $controller->criarReclamacao($usuario_id, $tipoPostagem, $titulo, $mensagem);
}

$conn->close();
?>
