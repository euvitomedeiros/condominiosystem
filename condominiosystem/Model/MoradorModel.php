<?php
include_once 'db_connect.php';

class MoradorModel {
    private $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function createMorador($nome, $sobrenome, $num_apartamento, $bloco, $telefone) {
        $stmt = $this->connect->prepare("INSERT INTO moradores (nome, sobrenome, num_apartamento, bloco, telefone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $nome, $sobrenome, $num_apartamento, $bloco, $telefone);
        return $stmt->execute();
    }

    public function getAllMoradores() {
        $sql = "SELECT morador_id, nome, sobrenome, num_apartamento, bloco, telefone FROM moradores";
        $result = $this->connect->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
