<?php
include_once 'db_connect.php';

class ReclamacaoModel {
    private $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function criarReclamacao($usuario_id, $tipoPostagem, $titulo, $mensagem) {
        $stmt = $this->connect->prepare("INSERT INTO reclamacao (usuario_id, data_criacao, tipoPostagem, titulo, mensagem) VALUES (?, NOW(), ?, ?, ?)");
        $stmt->bind_param('isss', $usuario_id, $tipoPostagem, $titulo, $mensagem);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Erro ao criar reclamação: " . $this->connect->error;
            return false;
        }
    }

    public function obterReclamacoes() {
        $sql = "SELECT r.*, u.nome_usuario AS nome_usuario FROM reclamacao r JOIN usuario u ON r.usuario_id = u.usuario_id ORDER BY r.data_criacao DESC";
        $result = $this->connect->query($sql);

        if (!$result) {
            die("Erro na consulta: " . $this->connect->error);
        }

        return $result;
    }
}
?>
