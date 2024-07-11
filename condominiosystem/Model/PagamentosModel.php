<?php
include_once 'db_connect.php';

class PagamentosModel {
    private $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function obterUsuarios() {
        $sql = "SELECT usuario_id FROM usuario";
        return $this->connect->query($sql);
    }

    public function obterPagamentosPendentes($user_id) {
        if (empty($user_id)) {
            throw new Exception("ID do usuário não pode estar vazio.");
        }

        $stmt = $this->connect->prepare("SELECT * FROM pagamentos WHERE usuario_id = ? AND status_pagamento = 'Pendente'");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function salvarPagamento($userId, $valorCondominio, $dataVencimento, $statusPagamento) {
        $stmt = $this->connect->prepare("INSERT INTO pagamentos (usuario_id, ValorCondominio, data_vencimento, status_pagamento) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('idss', $userId, $valorCondominio, $dataVencimento, $statusPagamento);

        if ($stmt->execute()) {
            return "Guia de pagamento gerada para o morador ID: $userId<br>";
        } else {
            return "Erro ao gerar guia para o morador ID: $userId. Erro: " . $this->connect->error . "<br>";
        }
    }

    public function gerarSegundaViaPagamento($pagamentoId) {
        $stmt = $this->connect->prepare("SELECT * FROM pagamentos WHERE pagamento_id = ?");
        $stmt->bind_param('i', $pagamentoId);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $dados = $resultado->fetch_assoc();

            // Clona o pagamento existente para gerar a segunda via
            $valorCondominio = $dados['ValorCondominio'];
            $dataVencimento = $dados['data_vencimento'];
            $statusPagamento = 'Pendente';

            // Insere a segunda via no banco de dados
            $stmtSegundaVia = $this->connect->prepare("INSERT INTO pagamentos (usuario_id, ValorCondominio, data_vencimento, status_pagamento) VALUES (?, ?, ?, ?)");
            $stmtSegundaVia->bind_param('idss', $dados['usuario_id'], $valorCondominio, $dataVencimento, $statusPagamento);

            if ($stmtSegundaVia->execute()) {
                return "Segunda via gerada com sucesso para o Pagamento ID: $pagamentoId<br>";
            } else {
                return "Erro ao gerar segunda via para o Pagamento ID: $pagamentoId. Erro: " . $this->connect->error . "<br>";
            }
        } else {
            return "Pagamento ID: $pagamentoId não encontrado.<br>";
        }
    }
}
?>
