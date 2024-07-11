<?php
session_start();

include_once '../Model/db_connect.php';
include_once '../includes/auth.php';
require_once '../Model/PagamentosModel.php';

class PagamentosController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function gerarGuiasPagamento() {
        $diaAtual = date("d");
        $dataAtual = date("Y-m-d");

        if ($diaAtual == 2) {
            $resultMoradores = $this->model->obterUsuarios();

            if ($resultMoradores->num_rows > 0) {
                $dataVencimento = date("Y-m-10", strtotime("+1 month", strtotime($dataAtual)));

                while ($row = $resultMoradores->fetch_assoc()) {
                    $userId = $row['usuario_id'];
                    $valorCondominio = 0; // Defina o valor do condomínio conforme necessário
                    $statusPagamento = 'Pendente';

                    echo $this->model->salvarPagamento($userId, $valorCondominio, $dataVencimento, $statusPagamento);
                }
            } else {
                echo "Nenhum morador encontrado.<br>";
            }
        } else {
            echo "Hoje não é dia 2. Nenhuma guia foi gerada.<br>";
        }
    }
}

$model = new PagamentosModel($connect);
$controller = new PagamentosController($model);
$controller->gerarGuiasPagamento();

$conn->close();
?>
