<?php 
    include_once 'includes/header.php';
    include_once 'menu.php';
    include_once 'includes/auth.php';
    require_once 'Model/ReclamacaoModel.php';
    require_once 'Model/UserModel.php';
    verificarLogin();
?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h4 class="light center-align">Postar Reclamações, Sugestões e Avisos</h4>
        <form action="Controller/ReclamacoesController.php" method="POST">
            <div class="input-field col s12">
                <select name="tipoPostagem" id="tipoPostagem" class="browser-default" required>
                    <option value="" disabled selected>Escolha o tipo de postagem</option>
                    <option value="reclamacao">Reclamação</option>
                    <option value="sugestao">Sugestão</option>
                    <option value="aviso">Aviso</option>
                </select>
            </div>
            <div class="input-field col s12">
                <input type="text" name="titulo" id="titulo" required>
                <label for="titulo">Título</label>
            </div>
            <div class="input-field col s12">
                <textarea name="mensagem" id="mensagem" class="materialize-textarea" required></textarea>
                <label for="mensagem">Mensagem</label>
            </div>
            <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario_id']; ?>">
            <button type="submit" name="btn-postar" class="btn">Postar</button>
            <a href="sugestoes_reclamacoes.php" class="btn green">Ver Postagens</a>
        </form>
    </div>
</div>
<?php
include_once 'includes/footer.php';
?>
