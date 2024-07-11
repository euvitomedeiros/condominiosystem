<?php
require_once 'db_connect.php';

class ReservaModel {
    private $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function criarReserva($usuarioId, $moradorId, $area, $dataReserva, $horaReserva) {
        $stmt = $this->connect->prepare("INSERT INTO reservas (usuario_id, morador_id, area, data_reserva, hora_reserva) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('iisss', $usuarioId, $moradorId, $area, $dataReserva, $horaReserva);
        return $stmt->execute();
    }

    public function obterTodasReservas() {
        $sql = "SELECT * FROM reservas";
        $result = $this->connect->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function verificarConflitoReserva($dataReserva, $horaReserva) {
        $stmt = $this->connect->prepare("SELECT * FROM reservas WHERE data_reserva = ? AND hora_reserva = ?");
        $stmt->bind_param('ss', $dataReserva, $horaReserva);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function obterReservaPorId($reservaId) {
        $stmt = $this->connect->prepare("SELECT * FROM reservas WHERE reserva_id = ?");
        $stmt->bind_param('i', $reservaId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function atualizarReserva($reservaId, $moradorId, $area, $dataReserva, $horaReserva) {
        $stmt = $this->connect->prepare("UPDATE reservas SET morador_id = ?, area = ?, data_reserva = ?, hora_reserva = ? WHERE reserva_id = ?");
        $stmt->bind_param('isssi', $moradorId, $area, $dataReserva, $horaReserva, $reservaId);
        return $stmt->execute();
    }

    public function excluirReserva($reservaId) {
        $stmt = $this->connect->prepare("DELETE FROM reservas WHERE reserva_id = ?");
        $stmt->bind_param('i', $reservaId);
        return $stmt->execute();
    }

    public function obterNomeMoradorPorReservaId($reservaId) {
        $stmt = $this->connect->prepare("SELECT m.nome FROM moradores m INNER JOIN reservas r ON m.morador_id = r.morador_id WHERE r.reserva_id = ?");
        $stmt->bind_param('i', $reservaId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $dados = $result->fetch_assoc();
            return $dados['nome'];
        }
        return null;
    }

    public function obterReservas() {
        $sql = "SELECT reservas.*, 
                       moradores.nome AS nome_morador, 
                       moradores.sobrenome AS sobrenome_morador,
                       u.nome_usuario AS usuario_reserva
                FROM reservas 
                LEFT JOIN moradores ON reservas.morador_id = moradores.morador_id 
                LEFT JOIN usuario u ON reservas.usuario_id = u.usuario_id
                ORDER BY reservas.data_reserva DESC";
        return $this->connect->query($sql);
    }
}
?>
