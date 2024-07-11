<?php
include_once 'Model/db_connect.php';
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'Model/ReservaAreaComumModel.php';
include_once 'includes/auth.php';

verificarLogin();

$userId = $_SESSION['usuario_id'];
$model = new ReservaModel($connect);
$resultado = $model->obterReservas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal do Condomínio - Lista de Reservas</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>
<body>
    <div class="container my-4">
        <h4 class="light text-center">Lista de Reservas</h4>
        <div class="text-end mb-3">
            <a href="reservar_areas.php" class="btn btn-success">Adicionar Reserva</a>
        </div>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Área</th>
                    <th>Data da Reserva</th>
                    <th>Hora da Reserva</th>
                    <th>Nome do Morador</th>
                    <th>Reserva feita por</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($dados = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars(ucfirst($dados['area'])); ?></td>
                    <td><?php echo $dados['data_reserva']; ?></td>
                    <td><?php echo $dados['hora_reserva']; ?></td>
                    <td><?php echo htmlspecialchars($dados['nome_morador'] . ' ' . $dados['sobrenome_morador']); ?></td>
                    <td><?php echo htmlspecialchars($dados['usuario_reserva']); ?></td>
                    <td>
                        <?php if ($dados['usuario_id'] == $userId): ?>
                            <a href="atualizar_reserva.php?reserva_id=<?php echo $dados['reserva_id']; ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                            <a href="excluir_reserva.php?id=<?php echo $dados['reserva_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta reserva?');"><i class="bi bi-trash"></i></a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include_once 'includes/footer.php'; ?>
</body>
</html>

<?php
$connect->close();
?>
