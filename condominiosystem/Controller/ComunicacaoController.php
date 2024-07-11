<?php
session_start();

include_once '../Model/db_connect.php';
include_once '../includes/auth.php';
require_once '../Model/ComunicacaoModel.php';

class ComunicacaoController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function postarAviso() {
        if (isset($_POST['btn-postarAviso'])) {
            $titulo = $_POST['titulo'];
           $mensagem = $_POST['mensagem'];

            if ($this->model->criarAviso($titulo, $mensagem)) {
                $_SESSION['mensagem'] = "Aviso postado com sucesso!";
                header('Location: ../comunicacao_interna.php');
            } else {
                $_SESSION['mensagem'] = "Erro ao realizar postagem.";
                header('Location: ../moradores.php');
            }
        }
    }
}

$model = new ComunicacaoModel($connect);
$controller = new ComunicacaoController($model);
$controller->postarAviso();
?>
