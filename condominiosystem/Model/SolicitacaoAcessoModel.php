<?php
include_once 'db_connect.php';

class SolicitacaoAcessoModel {
    private $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function createAccessRequest($nome, $email, $telefone, $cpf, $rg, $senha) {
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO solicitacao_acesso (nome, email, telefone, cpf, rg, senha) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->connect, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssss', $nome, $email, $telefone, $cpf, $rg, $hashed_password);
        return mysqli_stmt_execute($stmt);
    }

    public function getAllAccessRequests() {
        $sql = "SELECT * FROM solicitacao_acesso";
        $resultado = mysqli_query($this->connect, $sql);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    public function deleteAccessRequest($id) {
        $sql = "DELETE FROM solicitacao_acesso WHERE id = ?";
        $stmt = mysqli_prepare($this->connect, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }

    public function approveAccessRequest($requestId) {
        // Inicia uma transação
        mysqli_begin_transaction($this->connect);

        try {
            // Busca apenas os dados necessários da solicitação de acesso
            $sql = "SELECT nome, email, telefone, cpf, rg, senha FROM solicitacao_acesso WHERE id = ?";
            $stmt = mysqli_prepare($this->connect, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $requestId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $request = mysqli_fetch_assoc($result);

            if (!$request) {
                throw new Exception("Solicitação não encontrada.");
            }

            // Insere os dados na tabela de usuários
            $sql = "INSERT INTO usuario (nome_usuario, email, telefone, cpf, rg, senha_usuario, tipo_acesso) VALUES (?, ?, ?, ?, ?, ?, 'normal')";
            $stmt = mysqli_prepare($this->connect, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssss', $request['nome'], $request['email'], $request['telefone'], $request['cpf'], $request['rg'], $request['senha']);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Erro ao inserir dados na tabela de usuários.");
            }

            // Marca a solicitação como aprovada
            $sql = "UPDATE solicitacao_acesso SET approved = 1 WHERE id = ?";
            $stmt = mysqli_prepare($this->connect, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $requestId);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Erro ao marcar a solicitação como aprovada.");
            }

            // Deleta a solicitação de acesso
            $sql = "DELETE FROM solicitacao_acesso WHERE id = ?";
            $stmt = mysqli_prepare($this->connect, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $requestId);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Erro ao deletar a solicitação de acesso.");
            }

            // Envia o e-mail de notificação
            $to = $request['email'];
            $subject = "Acesso Aprovado";
            $message = "Olá " . htmlspecialchars($request['nome_usuario']) . ",\n\nSua solicitação de acesso ao sistema foi aprovada. Acesse com a senha que você criou no momento do cadastro e já estará liberado.\n\nAtenciosamente,\nAdministração";
            $headers = "From: freitas.vitor609@gmail.com";

            mail($to, $subject, $message, $headers);

            // Comita a transação
            mysqli_commit($this->connect);

            return true;
        } catch (Exception $e) {
            // Faz o rollback em caso de erro
            mysqli_rollback($this->connect);
            $_SESSION['mensagem'] = $e->getMessage();
            return false;
        }
    }
}
?>
