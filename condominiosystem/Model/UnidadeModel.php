<?php
include_once 'db_connect.php';

class UnidadeModel {
    private $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function getAllUnidades() {
        $sql = "SELECT u.*, m.nome AS nome_morador, m.sobrenome AS sobrenome_morador 
                FROM Unidade u 
                LEFT JOIN moradores m ON u.morador_id = m.morador_id";
        $resultado = mysqli_query($this->connect, $sql);
        $unidades = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        return $unidades;
    }

    public function getUnidadeById($id) {
        $sql = "SELECT * FROM Unidade WHERE unidade_id = ?";
        $stmt = mysqli_prepare($this->connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $unidade = mysqli_fetch_assoc($resultado);
        return $unidade;
    }

    public function criarUnidade($moradorId, $numUnidade, $andar, $numApartamento, $numQuarto) {
        $sql = "INSERT INTO Unidade (morador_id, num_unidade, andar, num_apartamento, num_quarto) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->connect, $sql);
        mysqli_stmt_bind_param($stmt, "isssi", $moradorId, $numUnidade, $andar, $numApartamento, $numQuarto);
        return mysqli_stmt_execute($stmt);
    }

    public function editarUnidade($id, $moradorId, $numUnidade, $andar, $numApartamento, $numQuarto) {
        $sql = "UPDATE Unidade SET morador_id = ?, num_unidade = ?, andar = ?, num_apartamento = ?, num_quarto = ? WHERE unidade_id = ?";
        $stmt = mysqli_prepare($this->connect, $sql);
        mysqli_stmt_bind_param($stmt, "isssii", $moradorId, $numUnidade, $andar, $numApartamento, $numQuarto, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function deletarUnidade($id) {
        $sql = "DELETE FROM Unidade WHERE unidade_id = ?";
        $stmt = mysqli_prepare($this->connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}

?>
