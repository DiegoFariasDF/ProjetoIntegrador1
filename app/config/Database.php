<?php
class Database {
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $dataBase = "biblioteca";
    private $conexao;

    public function __construct() {
        $this->conexao = new mysqli($this->host, $this->usuario, $this->senha);
        
        if ($this->conexao->connect_error) {
            die("Erro de conexão: " . $this->conexao->connect_error);
        }

        $resultado = $this->conexao->query("SHOW DATABASES LIKE '{$this->dataBase}'");
        
        if ($resultado->num_rows == 0) {
            $this->conexao->query("CREATE DATABASE {$this->dataBase} CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
        }

        $this->conexao->select_db($this->dataBase);
        
        $this->criarTabelas();
    }

    public function criarTabelas() {
        $tabelas = [
            "CREATE TABLE IF NOT EXISTS leitores (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(50) NOT NULL,
                telefone VARCHAR(20) NOT NULL,
                qtd_atrasos INT NOT NULL DEFAULT 0
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",

            "CREATE TABLE IF NOT EXISTS usuarios (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(50) NOT NULL,
                usuario VARCHAR(50) NOT NULL UNIQUE,
                senha VARCHAR(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",

            "CREATE TABLE IF NOT EXISTS emprestimo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                leitor_id INT NOT NULL,
                data_emprestimo DATE NOT NULL,
                livro VARCHAR(60) NOT NULL,
                qtd_renovacao INT NOT NULL DEFAULT 0,
                status ENUM('emprestado', 'devolvido') NOT NULL DEFAULT 'emprestado',
                FOREIGN KEY (leitor_id) REFERENCES leitores(id) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",

            "CREATE TABLE IF NOT EXISTS historico_alteracao (
                id INT AUTO_INCREMENT PRIMARY KEY,
                funcionario_id INT NOT NULL,
                acao VARCHAR(255) NOT NULL,
                data_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (funcionario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci"
        ];
    
        foreach ($tabelas as $sql) {
            if ($this->conexao->query($sql) === TRUE) {
                echo "";
            } else {
                die("Erro ao criar tabela: " . $this->conexao->error);
            }
        }
    }

    public function getConnection() {
        return $this->conexao;
    }
}
?>