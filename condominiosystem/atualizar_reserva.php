<?php
include_once 'includes/header.php';
include_once 'menu.php';
require_once 'Model/ReservaAreaComumModel.php';
include_once 'includes/auth.php';

// Verificar se o ID da reserva foi enviado através do parâmetro GET
if(isset($_GET['reserva_id'])) {
    $reservaId = $_GET['reserva_id'];
    
    // Obter os detalhes da reserva pelo ID
    $resultado = $model->obterReservas();

    
}

if($reserva !== null) {
    // Obter o nome do morador correspondente ao ID da reserva
    $moradorNome = $model->obterNomeMoradorPorReservaId($reservaId);

}
?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h5 class="light">Editar Reserva para <strong><?php echo $moradorNome; ?></strong></h5>
        <form action="editar_reserva.php" method="POST">
            <input type="hidden" name="reservaId" value="<?php echo $reserva['reserva_id']; ?>">
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
                <input type="text" name="dataReserva" id="dataReserva" class="datepicker" value="<?php echo $reserva['data_reserva']; ?>">
                <label for="dataReserva">Data da Reserva</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="horaReserva" id="horaReserva" class="timepicker" value="<?php echo $reserva['hora_reserva']; ?>">
                <label for="horaReserva">Hora da Reserva</label>
            </div>
            <button type="submit" name="btn-atualizar" class="btn">Atualizar Reserva</button>
            <a href="listadereservas.php" class="btn red">Cancelar</a>
        </form>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>
