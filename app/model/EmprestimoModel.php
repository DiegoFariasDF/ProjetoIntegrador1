<?php
require_once 'app/config/Database.php';

class EmprestimoModel{
    private $conexao;

    public function __construct(){
        $db = new Database();
        $this->conexao = $db->getConnection();
    }

    public function listarEmprestimo(){
        $sql = "
        SELECT e.*, l.nome AS nome
        FROM emprestimo e
        INNER JOIN leitores l ON e.leitor_id = l.id
        WHERE e.status = 'emprestado'  -- Filtra apenas os empréstimos com status 'emprestado'
        ";
        $result = $this->conexao->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function contarEmprestimos() {
        $sql = "SELECT COUNT(*) AS total FROM emprestimo";
        $result = $this->conexao->query($sql);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function renovarEmprestimo($id_emprestimo) {
        $data_renovacao = date('Y-m-d');
        $sql = "UPDATE emprestimo SET data_emprestimo = ?, qtd_renovacao = qtd_renovacao + 1 WHERE id = ?";

        // Preparando e executando a query
        if ($stmt = $this->conexao->prepare($sql)) {
            $stmt->bind_param("si", $data_renovacao, $id_emprestimo);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function finalizarEmprestimo($id_emprestimo) {
        $sql = "UPDATE emprestimo SET status = 'devolvido' WHERE id = ?";
    
        if ($stmt = $this->conexao->prepare($sql)) {
            $stmt->bind_param("i", $id_emprestimo);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>