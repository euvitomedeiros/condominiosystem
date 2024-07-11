<?php
include_once 'Model/db_connect.php';
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'includes/auth.php';
require_once 'Model/UserModel.php';

verificarLogin();

$isAdmin = ($_SESSION['tipo_acesso'] ?? '') === 'administrador';

$model = new UserModel($connect);
$usuarios = $model->getAllUsuarios();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista de Usuários do Sistema</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>
<body>
    <div class="container my-4">
        <h4 class="light text-center">Lista de Usuários do Sistema</h4>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Tipo de Acesso</th>
                    <?php if ($isAdmin): ?>
                    <th>Ações</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['nome_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['telefone']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['tipo_acesso']); ?></td>
                    <?php if ($isAdmin): ?>
                    <td>
                        <a href="editar_usuario.php?id=<?php echo $usuario['usuario_id']; ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i> Editar</a>
                        <a href="excluir_usuario.php?id=<?php echo $usuario['usuario_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?');"><i class="bi bi-trash"></i> Excluir</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include_once 'includes/footer.php'; ?>
</body>
</html>
