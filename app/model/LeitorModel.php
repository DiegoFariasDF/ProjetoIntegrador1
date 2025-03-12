<?php
require_once 'app/config/Database.php';

class LeitorModel {
    private $conexao;

    public function __construct() {
        $db = new Database();
        $this->conexao = $db->getConnection();
    }

    public function listarLeitores() {
        $sql = "SELECT * FROM leitores";
        $result = $this->conexao->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLeitorPorId($id) {
        $sql = "SELECT * FROM leitores WHERE id = ?";
        $stmt = $this->conexao->prepare($sql); // Prepara a query
        $stmt->bind_param("i", $id); // "i" significa inteiro
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

}
?>