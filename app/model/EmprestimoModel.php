<?php
require_once 'app/config/Database.php';

class UsuarioModel {
    private $conexao;

    public function __construct() {
        $db = new Database();
        $this->conexao = $db->getConnection();
    }

    public function listarEmprestimos() {
        $sql = "SELECT * FROM emprestimo";
        $result = $this->conexao->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEmprestimoPorId($id) {
        $sql = "SELECT * FROM emprestimo WHERE leitor_id = ?";
        $stmt = $this->conexao->prepare($sql); // Prepara a query
        $stmt->bind_param("i", $id); // "i" significa inteiro
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc(); // Retorna um único usuário como array associativo
    }
}
?>