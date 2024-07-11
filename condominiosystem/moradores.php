<?php
include_once 'Model/db_connect.php';
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'includes/auth.php';
require_once 'Model/MoradorModel.php';

verificarLogin();


$isAdmin = ($_SESSION['tipo_acesso'] ?? '') === 'administrador';

$model = new MoradorModel($connect);
$moradores = $model->getAllMoradores();
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
    <div class="container my-4">
        <h4 class="light text-center">Moradores</h4>
        <p class="text-center mb-4">Esta página serve para você contatar ou pedir algum favor aos moradores. Se você precisar de ajuda ou desejar fazer uma solicitação, utilize os contatos disponíveis.</p>
        <?php if ($isAdmin): ?> 
        <div class="text-end mb-3">
            <a href="adicionar_morador.php" class="btn btn-success">Adicionar Morador</a>
        </div>
        <?php endif; ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Nº do Apartamento</th>
                    <th>Bloco</th>
                    <th>Telefone</th>
                    <?php if ($isAdmin): ?>
                    <th>Ações</th>
                    <?php endif; ?>
                </tr>
            </thead> 
            <tbody>
                <?php foreach ($moradores as $dados): ?>
                <tr>
                    <td><?php echo htmlspecialchars($dados['nome']); ?></td>
                    <td><?php echo htmlspecialchars($dados['sobrenome']); ?></td>
                    <td><?php echo htmlspecialchars($dados['num_apartamento']); ?></td>
                    <td><?php echo htmlspecialchars($dados['bloco']); ?></td>
                    <td><?php echo htmlspecialchars($dados['telefone']); ?></td>
                    <?php if ($isAdmin): ?>
                    <td class="text-center">
                        <a href="editar_morador.php?id=<?php echo $dados['morador_id']; ?>" class="btn btn-sm btn-primary">Editar <i class="bi bi-pencil"></i></a>
                        <a href="deletar_morador.php?id=<?php echo $dados['morador_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar este morador?');">Deletar <i class="bi bi-trash"></i></a>
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
