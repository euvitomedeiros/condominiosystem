<?php
session_start();

include_once '../Model/db_connect.php';
include_once '../includes/auth.php';
require_once '../Model/MoradorModel.php';

class MoradorController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function cadastrarMorador() {
        if (isset($_POST['btn-cadastrar'])) {
            $nome = $_POST['nomeMorador'];
            $sobrenome = $_POST['sobrenomeMorador'];
            $num_apartamento = $_POST['num_apartamento'];
            $bloco = $_POST['blocoMorador'];
            $telefone = $_POST['telefoneMorador'];

            if ($this->model->createMorador($nome, $sobrenome, $num_apartamento, $bloco, $telefone)) {
                $_SESSION['mensagem'] = "Cadastrado com sucesso!";
                header('Location: ../moradores.php');
            } else {
                $_SESSION['mensagem'] = "Erro ao cadastrar";
                header('Location: ../moradores.php');
            }
        }
    }
}

$model = new MoradorModel($connect);
$controller = new MoradorController($model);
$controller->cadastrarMorador();
?>
