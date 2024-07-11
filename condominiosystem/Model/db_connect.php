<?php

class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "bd_condominio";
    private $connect;

    // Construtor para inicializar a conexão
    public function __construct() {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);

        // Verificar conexão
        if (mysqli_connect_error()) {
            die("Erro na conexão: " . mysqli_connect_error());
        }

        // Definir o charset
        mysqli_set_charset($this->connect, "utf8");
    }

    // Método para obter a conexão
    public function getConnection() {
        return $this->connect;
    }

    // Método para fechar a conexão
    public function closeConnection() {
        mysqli_close($this->connect);
    }
}

$database = new Database();
$connect = $database->getConnection();

?>
