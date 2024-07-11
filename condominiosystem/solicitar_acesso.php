<?php
 include_once 'includes/header.php';
 
?>
<div class="row">
    <div class="col s12 m6 push-m3">
        <h4 class="light"> Solicitação de Acesso ao Sistema </h4>
        <form action="Controller/SolicitacaoAcessoController.php" method="POST">
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome" required>
                <label for="nome">Nome Completo</label>
            </div>
            <div class="input-field col s12">
                <input type="email" name="email" id="email" required>
                <label for="email">E-mail</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="telefone" id="telefone" required>
                <label for="telefone">Telefone</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="cpf" id="cpf" required>
                <label for="cpf">CPF</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="rg" id="rg" required>
                <label for="rg">RG</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="senha" id="senha" required>
                <label for="senha">Senha</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="confirma_senha" id="confirma_senha" required>
                <label for="confirma_senha">Confirme a Senha</label>
            </div>
            <br>
            <button type="submit" name="btn-solicitar" class="btn"> Solicitar Acesso </button>
            <a href="login.php" class="btn green"> Voltar </a>
        </form>
    </div>
</div>
<?php
include_once 'includes/footer.php';
?>
