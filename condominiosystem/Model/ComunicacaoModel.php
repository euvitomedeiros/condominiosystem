<?php
include_once 'db_connect.php';

class ComunicacaoModel {
    private $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function criarAviso($titulo, $mensagem) {
        $stmt = $this->connect->prepare("INSERT INTO comunicacao (data_criacao, titulo, mensagem) VALUES (NOW(), ?, ?)");
        $stmt->bind_param('ss', $titulo, $mensagem);
        return $stmt->execute();
    }

    public function listarAvisos() {
        $sql = "SELECT * FROM comunicacao ORDER BY data_criacao DESC";
        $result = $this->connect->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
