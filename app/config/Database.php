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
        $this->atualizarEstrutura();
        $this->inserirUsuarioAdmin();
        $this->atualizarQtdAtrasos();
    }

    private function criarTabelas() {
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
                permissao VARCHAR(30) NOT NULL,
                senha VARCHAR(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",

            "CREATE TABLE IF NOT EXISTS emprestimo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                leitor_id INT NOT NULL,
                data_emprestimo DATE NOT NULL,
                livro VARCHAR(60) NOT NULL,
                qtd_renovacao INT NOT NULL DEFAULT 0,
                status ENUM('emprestado', 'devolvido') NOT NULL DEFAULT 'emprestado',
                atraso TINYINT(1) DEFAULT 0,
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
            if (!$this->conexao->query($sql)) {
                die("Erro ao criar tabela: " . $this->conexao->error);
            }
        }
    }

    private function atualizarEstrutura() {
        $resultado = $this->conexao->query("SHOW COLUMNS FROM emprestimo LIKE 'atraso'");
        if ($resultado->num_rows == 0) {
            $this->conexao->query("ALTER TABLE emprestimo ADD COLUMN atraso TINYINT(1) DEFAULT 0");
        }

        $resultado = $this->conexao->query("SHOW COLUMNS FROM usuarios LIKE 'permissao'");
        if ($resultado->num_rows == 0) {
            $this->conexao->query("ALTER TABLE usuarios ADD COLUMN permissao VARCHAR(30) NOT NULL DEFAULT 'padrao'");
        }
    }

    private function atualizarQtdAtrasos() {
        $sql = "
            UPDATE leitores l
            SET qtd_atrasos = (
                SELECT COUNT(*)
                FROM emprestimo e
                WHERE e.leitor_id = l.id AND e.atraso = 1
            )
        ";
    
        if (!$this->conexao->query($sql)) {
            die("Erro ao atualizar quantidade de atrasos: " . $this->conexao->error);
        }
    }

    private function inserirUsuarioAdmin() {
        $usuario = 'admin';
        $resultado = $this->conexao->query("SELECT id FROM usuarios WHERE usuario = '$usuario'");

        if ($resultado->num_rows == 0) {
            $senhaCriptografada = '$2y$10$H4GFGilPmJs5IS0Y2CjaLerY0Vq1THalwhEsShwlLf5qOOKPkPbZ.';
            $this->conexao->query("INSERT INTO usuarios (nome, usuario, permissao, senha) VALUES ('Administrador', 'admin', 'admin', '$senhaCriptografada')");
        }
    }

    public function getConnection() {
        return $this->conexao;
    }
}
?>
