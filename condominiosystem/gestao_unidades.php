<?php
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'includes/auth.php';
require_once 'Model/MoradorModel.php';

verificarLogin();
$model = new MoradorModel($connect);
$moradores = $model->getAllMoradores();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro de Unidades</title>
    
</head>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h4 class="light">Registro de Unidades</h4>
        <form action="Controller/UnidadeController.php" method="POST">
            <div class="input-field col s12">
                <select name="moradorId" id="moradorId" class="browser-default">
                    <option value="" disabled selected>Selecione o Morador</option>
                    <?php foreach($moradores as $morador): ?>
                        <option value="<?php echo $morador['morador_id']; ?>">
                            <?php echo $morador['nome'] . ' ' . $morador['sobrenome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-field col s12">
                <input type="text" name="num_unidade" id="num_unidade">
                <label for="nome">Nº Unidade</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="andar" id="andar">
                <label for="nome">Andar</label>
            </div>
            
            <div class="input-field col s12">
                <input type="text" name="num_apartamento" id="blocoMorador">
                <label for="nome">Nº Apartamento</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="num_quarto" id="num_quarto">
                <label for="nome">Nº Quartos</label>
            </div>
            <br>
            <button type="submit" name="btn-addUnidade" class="btn">Adicionar</button>
            <a href="unidades.php" class="btn green">Unidades</a>
        </form>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>

</body>
</html>
