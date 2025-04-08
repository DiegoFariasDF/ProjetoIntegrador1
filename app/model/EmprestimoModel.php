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
        SELECT e.*, l.nome AS nome, l.telefone AS telefone
        FROM emprestimo e
        INNER JOIN leitores l ON e.leitor_id = l.id
        WHERE e.status = 'emprestado'  -- Filtra apenas os empréstimos com status 'emprestado'
        ";
        $result = $this->conexao->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function contarEmprestimos() {
        $sql = "SELECT COUNT(*) AS total FROM emprestimo WHERE status = 'emprestado'";
        $result = $this->conexao->query($sql);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function contarAtrasos(){
        $sql = "SELECT COUNT(*) AS total FROM emprestimo WHERE atraso = 1";
        $result = $this->conexao->query($sql);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function verificarEAtribuirAtrasos() {
        $sql = "SELECT id, data_emprestimo FROM emprestimo WHERE status = 'emprestado'";
        $result = $this->conexao->query($sql);
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $dataEmprestimo = new DateTime($row['data_emprestimo']);
                $dataEmprestimo->modify('+15 days');
                $dataAtual = new DateTime();
    
                $atrasado = ($dataEmprestimo < $dataAtual) ? 1 : 0;
    
                $update = "UPDATE emprestimo SET atraso = ? WHERE id = ?";
                $stmt = $this->conexao->prepare($update);
                $stmt->bind_param("ii", $atrasado, $row['id']);
                $stmt->execute();
            }
        }
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

    public function novoEmprestimo($leitor_id, $livro){
        $data = date('Y-m-d');
        $sql = "INSERT INTO emprestimo SET leitor_id = ?, livro = ?, data_emprestimo = ? ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("iss", $leitor_id, $livro, $data);
        return $stmt->execute();
    }
}

?>