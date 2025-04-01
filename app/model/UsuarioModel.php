<?php
require_once 'app/config/Database.php';

class UsuarioModel {
    private $conexao;

    public function __construct() {
        $db = new Database();
        $this->conexao = $db->getConnection();
    }

    public function listarUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $result = $this->conexao->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsuarioPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc(); 
    }

    public function autenticarUsuario($user, $senha) {
        $sql = "SELECT * FROM usuarios WHERE usuario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        } else {
            return false;
        }
    }
}
?>