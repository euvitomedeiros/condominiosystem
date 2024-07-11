<?php
include_once 'Model/db_connect.php';
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'includes/auth.php';
require_once 'Model/PagamentosModel.php';

verificarLogin();

$user_id = $_SESSION['usuario_id']; 

$model = new PagamentosModel($connect);
$result = $model->obterPagamentosPendentes($user_id);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal do Condomínio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>
<body>
    <div class="container mt-5">
        <h1>Pagamentos a Fazer</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID de Pagamento</th>
                    <th>Valor do Condomínio</th>
                    <th>Data de Vencimento</th>
                    <th>Status do Pagamento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['pagamento_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ValorCondominio']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['data_vencimento']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status_pagamento']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum pagamento pendente encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzS0Pp3FL9E7YtL8VFE1F/nB+m0O/ZxCJFMQe0Y6E8D5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93qcnDQZBv0a0MJw6BiqVMR3V605wH2rdG2Bz5iETEVk5KS6foIlKI7gG1HAeB" crossorigin="anonymous"></script>
</body>
</html>

<?php
$connect->close();
?>
