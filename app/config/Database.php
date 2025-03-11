<?php
class Database {
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $dataBase = "biblioteca";
    private $conexao;

    public function __construct() {
        $this->conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->dataBase);

        if ($this->conexao->connect_error) {
            die("Erro de conexão: " . $this->conexao->connect_error);
        }
    }

    public function getConnection() {
        return $this->conexao;
    }
}
?>
