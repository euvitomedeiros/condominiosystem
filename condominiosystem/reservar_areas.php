<?php
    include_once 'includes/header.php';
    include_once 'menu.php';
    include_once 'includes/auth.php';
    require_once 'Model/MoradorModel.php';

    verificarLogin();

    $moradores = $model->getAllMoradores();
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Áreas Comuns</title>
</head>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h4 class="light">Reserve a área desejada:</h4>
        <form action="Controller/ReservarAreaController.php" method="POST">
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
                <select name="reservaArea" id="reservaArea" class="browser-default">
                    <option value="" disabled selected>Escolha a área para reserva</option>
                    <option value="churrasqueira">Churrasqueira</option>
                    <option value="salao_de_festas">Salão de Festas</option>
                    <option value="piscina">Piscina</option>
                    <option value="quadra">Quadra de Futebol</option>
                </select>
            </div>
            <div class="input-field col s12">
                <input type="text" name="dataReserva" id="dataReserva" class="datepicker">
                <label for="dataReserva">Data da Reserva</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="horaReserva" id="horaReserva" class="timepicker">
                <label for="horaReserva">Hora da Reserva</label>
            </div>

            <br>
            <button type="submit" name="btn-reservar" class="btn">Confirmar Reserva</button>
            <a href="listadereservas.php" class="btn green">Lista de Reservas</a>
        </form>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>

</body>
</html>
