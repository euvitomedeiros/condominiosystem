<?php 
    include_once 'includes/header.php';
    include_once 'menu.php';
    include_once 'includes/auth.php';
    require_once 'Model/ComunicacaoModel.php';
    verificarLogin();
?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h4 class="light">Inserir Aviso</h4>
        <form action="Controller/ComunicacaoController.php" method="POST">
            <div class="input-field col s12">
                <input type="text" name="titulo" id="titulo" required>
                <label for="titulo">Título</label>
            </div>
            <div class="input-field col s12">
                <textarea name="mensagem" id="mensagem" class="materialize-textarea" required></textarea>
                <label for="mensagem">Mensagem</label>
            </div>
            <button type="submit" name="btn-postarAviso" class="btn">Postar</button>
            <a href="comunicacao_interna.php" class="btn green">Ver Postagens</a>
        </form>
    </div>
</div>
<?php
include_once 'includes/footer.php';
?>
