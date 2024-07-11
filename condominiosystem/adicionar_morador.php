<?php
    
    include_once 'includes/header.php';
    include_once 'menu.php';
    include_once 'includes/auth.php';
    verificarLogin();
?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h4 class="light"> Informações de Morador:  </h4>
        <form action="Controller/MoradorController.php" method="POST">
            <div class="input-field col s12">
                <input type="text" name="nomeMorador" id="nomeMorador">
                <label for="nome">Nome</label>
            </div>  
            <div class="input-field col s12">
                <input type="text" name="sobrenomeMorador" id="sobrenomeMorador">
                <label for="nome">Sobrenome</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="num_apartamento" id="num_apartamento">
                <label for="nome">Nº Apartamento</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="blocoMorador" id="blocoMorador">
                <label for="nome">Bloco</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="telefoneMorador" id="telefoneMorador">
                <label for="nome">Telefone</label>
            </div>
            <br>
            <button type="submit" name="btn-cadastrar" class="btn"> Cadastrar </button>
            <a href="moradores.php" class="btn green"> Lista de Moradores</a>
        </form>
    </div>
</div>
<?php
include_once 'includes/footer.php';
?>



