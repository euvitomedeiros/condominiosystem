<?php

require_once 'db_connect.php';

class UserModel {
    private $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function obterUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = mysqli_prepare($this->connect, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($resultado);
    }

    public function registrarUsuario($nome, $email, $telefone, $cpf, $rg, $senha_hash) {
        $sql = "INSERT INTO usuario (nome_usuario, email, telefone, cpf, rg, senha_usuario) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->connect, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $nome, $email, $telefone, $cpf, $rg, $senha_hash);
        return mysqli_stmt_execute($stmt);
    }

    public function getUltimoUsuarioInserido() {
        return mysqli_insert_id($this->connect);
    }

    public function getAllUsuarios() {
        $sql = "SELECT * FROM usuario";
        $resultado = mysqli_query($this->connect, $sql);
        $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        return $usuarios;
    }
}
?>
