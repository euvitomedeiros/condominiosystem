<?php
include_once 'Model/db_connect.php';
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'Model/SolicitacaoAcessoModel.php';
include_once 'includes/auth.php';

verificarLogin();

$model = new SolicitacaoAcessoModel($connect);
$solicitacoes = $model->getAllAccessRequests();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Solicitações de Acesso</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>
<body>
    <div class="container my-4">
        <h4 class="light text-center">Solicitações de Acesso</h4>
        
        <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['erro']; ?>
        </div>
        <?php unset($_SESSION['erro']); endif; ?>

        <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['mensagem']; ?>
        </div>
        <?php unset($_SESSION['mensagem']); endif; ?>

        <?php if (empty($solicitacoes)): ?>
            <div class="alert alert-info text-center" role="alert">
                Não há solicitações no momento.
            </div>
        <?php else: ?>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($solicitacoes as $solicitacao): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($solicitacao['id']); ?></td>
                        <td><?php echo htmlspecialchars($solicitacao['nome']); ?></td>
                        <td><?php echo htmlspecialchars($solicitacao['email']); ?></td>
                        <td><?php echo htmlspecialchars($solicitacao['telefone']); ?></td>
                        <td><?php echo htmlspecialchars($solicitacao['cpf']); ?></td>
                        <td><?php echo htmlspecialchars($solicitacao['rg']); ?></td>
                        <td>
                            <a href="Controller/SolicitacaoAcessoController.php?approve=<?php echo $solicitacao['id']; ?>" class="btn btn-sm btn-success">Aprovar</a>
                            <a href="Controller/SolicitacaoAcessoController.php?reject=<?php echo $solicitacao['id']; ?>" class="btn btn-sm btn-danger">Rejeitar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <?php include_once 'includes/footer.php'; ?>
</body>
</html>
