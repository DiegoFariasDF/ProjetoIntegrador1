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

    public function adicionarUsuario($nome, $permissao, $usuario, $senha) {
        $sql = "INSERT INTO usuarios SET nome = ?, usuario = ?, permissao = ?, senha = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ssss", $nome, $usuario, $permissao, $senha);
        return $stmt->execute();
    }

    public function editarUsuario($id, $nome, $usuario, $permissao) {
        $sql = "UPDATE usuarios SET nome = ?, usuario = ?, permissao = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("sssi", $nome, $usuario, $permissao, $id);
        return $stmt->execute();
    }

    public function atualizarConta($id, $nome) {
        $stmt = $this->conexao->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
        $stmt->bind_param("si", $nome, $id);
        return $stmt->execute();
    }

    public function atualizarSenha($id, $senhaCripto) {
        $stmt = $this->conexao->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->bind_param("si", $senhaCripto, $id); 
        return $stmt->execute();
    }

    public function excluirUsuario($id) {
        $sql = "DELETE from usuarios WHERE id = ?";
    
        if ($stmt = $this->conexao->prepare($sql)) {
            $stmt->bind_param("i", $id);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function resetarSenha($id) {
        $senha = '1234567';
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET senha = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("si", $senhaHash, $id);
        return $stmt->execute();
    }
}
?>