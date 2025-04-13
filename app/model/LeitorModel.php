<?php
require_once 'app/config/Database.php';

class LeitorModel {
    private $conexao;

    public function __construct() {
        $db = new Database();
        $this->conexao = $db->getConnection();
    }

    public function listarLeitores() {
        $sql = "SELECT * FROM leitores ORDER BY nome ASC";
        $result = $this->conexao->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLeitorPorId($id) {
        $sql = "
            SELECT 
                l.*, 
                COUNT(e.id) AS total_emprestimos,
                SUM(CASE 
                    WHEN e.status = 'emprestado' THEN 1 
                    ELSE 0 
                END) AS emprestimos_ativos,
                SUM(CASE 
                    WHEN e.atraso = 1 THEN 1 
                    ELSE 0 
                END) AS emprestimos_atrasados
            FROM 
                leitores l
            LEFT JOIN 
                emprestimo e ON l.id = e.leitor_id
            WHERE 
                l.id = ?
            GROUP BY 
                l.id
        ";
    
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_assoc();
    }
    
    
    

    public function contarLeitores() {
        $sql = "SELECT COUNT(*) AS total FROM leitores";
        $result = $this->conexao->query($sql);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function atualizarLeitor($id, $nome, $telefone) {
        $sql = "UPDATE leitores SET nome = ?, telefone = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ssi", $nome, $telefone, $id);
        return $stmt->execute();
    }    

    public function adicionarLeitor($nome, $telefone) {
        $sql = "INSERT INTO leitores SET nome = ?, telefone = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ss", $nome, $telefone);
        return $stmt->execute();
    }
    

}
?>