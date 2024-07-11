<?php
include_once 'Model/db_connect.php';
include_once 'Model/ReclamacaoModel.php';
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'includes/auth.php';

// Verifica se o usuário está logado
verificarLogin();

$userId = $_SESSION['usuario_id'];

$model = new ReclamacaoModel($connect);
$resultado = $model->obterReclamacoes();

if (!$resultado) {
    echo ("Erro ao obter reclamações.");
}
?>

<div class="row">
    <div class="col s12 m8 offset-m2">
        <h3 class="light center-align">Feed de Sugestões e Reclamações</h3>
        <ul class="collection">
            <?php while ($dados = $resultado->fetch_assoc()): ?>
            <li class="collection-item">
                <div>
                    <span class="title"><b><?php echo ucfirst(htmlspecialchars($dados['tipoPostagem'])); ?></b></span>
                </div>
                <div>
                    <span class="title"><?php echo ucfirst(htmlspecialchars($dados['titulo'])); ?></span>
                </div>
                <div>
                    <p><?php echo htmlspecialchars($dados['mensagem']); ?></p>
                </div>
                <div class="grey-text">
                    <p>
                        <?php echo htmlspecialchars($dados['nome_usuario']); ?> - 
                        <?php echo date('d/m/Y H:i', strtotime($dados['data_criacao'])); ?>
                    </p>
                </div>
                <!-- Opções de ação, como editar ou excluir -->
                <?php if ($dados['usuario_id'] == $userId): ?>
                    <a href="#" class="secondary-content"><i class="material-icons">edit</i></a>
                    <a href="#" class="secondary-content"><i class="material-icons">delete</i></a>
                <?php endif; ?>
            </li>
            <?php endwhile; ?>
        </ul>
        <div class="center-align">
            <a href="postar_reclamacao.php" class="btn green">Adicionar Reclamação</a>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>

<?php
$connect->close();
?>
