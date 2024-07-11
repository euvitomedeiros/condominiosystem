<?php
include_once 'Model/db_connect.php';
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'includes/auth.php';
require_once 'Model/ComunicacaoModel.php';

verificarLogin();

$model = new ComunicacaoModel($connect);
$avisos = $model->listarAvisos();
?>

<div class="row">
    <div class="col s12 m8 offset-m2">
        <h4 class="light center-align">Portal de Comunicação</h4>
        <ul class="collection">
            <?php if (!empty($avisos)): ?>
                <?php foreach ($avisos as $dados): ?>
                    <li class="collection-item">
                        <span class="title"><?php echo htmlspecialchars($dados['titulo']); ?></span>
                        <p><?php echo htmlspecialchars($dados['mensagem']); ?></p>
                        <p class="grey-text"><?php echo date('d/m/Y H:i', strtotime($dados['data_criacao'])); ?></p>
                        <!-- Opções de ação, como editar ou excluir -->
                        <a href="#" class="secondary-content"><i class="material-icons">edit</i></a>
                        <a href="#" class="secondary-content"><i class="material-icons">delete</i></a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="collection-item center-align">
                    <span class="title">Nenhum aviso...</span>
                    <p class="grey-text">Atualmente não há nenhum aviso para visualizar.</p>
                </li>
            <?php endif; ?>
        </ul>
        <div class="center-align">
            <a href="postar_comunicacao.php" class="btn green">Colocar Aviso</a>
        </div>
    </div>
</div>

<?php
include_once 'includes/footer.php';
?>
