<?php
include_once 'Model/db_connect.php';
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'includes/auth.php';
require_once 'Model/UnidadeModel.php';

verificarLogin();

$model = new UnidadeModel($connect);
$unidades = $model->getAllUnidades();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal do Condomínio - Lista de Unidades</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>
<body>
    <div class="container my-4">
        <h4 class="light text-center">Lista de Unidades</h4>
        <div class="text-end mb-3">
            <a href="gestao_unidades.php" class="btn btn-success">Adicionar Unidade</a>
        </div>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Morador</th>
                    <th>Nº Unidade</th>
                    <th>Andar</th>
                    <th>Nº Apartamento</th>
                    <th>Nº Quartos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($unidades as $unidade): ?>
                <tr>
                    <td><?php echo $unidade['nome_morador'] . ' ' . $unidade['sobrenome_morador']; ?></td>
                    <td><?php echo $unidade['num_unidade']; ?></td>
                    <td><?php echo $unidade['andar']; ?></td>
                    <td><?php echo $unidade['num_apartamento']; ?></td>
                    <td><?php echo $unidade['num_quarto']; ?></td>
                    <td>
                        <a href="atualizar_unidade.php?unidade_id=<?php echo $unidade['unidade_id']; ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                        <a href="Controller/UnidadeController.php?id=<?php echo $unidade['unidade_id']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include_once 'includes/footer.php'; ?>
</body>
</html>
