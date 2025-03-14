<?php
require_once 'app/model/LeitorModel.php';

class LeitorController {
    private $model;

    public function __construct() {
        $this->model = new LeitorModel();
    }

    public function listarLeitores() {
        $leitores = $this->model->listarLeitores(); // Obtém a lista de leitores
        $totalLeitores = $this->model->contarLeitores(); // Conta o total de leitores
        require 'app/views/usuarios.php'; // Passa os dados para a view
    }

    public function mostrarLeitor() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $idLeitor = $_GET['id'];
            $leitor = $this->model->getLeitorPorId($idLeitor);

            if ($leitor) {
                require 'app/views/usuario.php'; // Envia $leitor para a view
            } else {
                echo "<p><strong>Leitor não encontrado.</strong></p>";
            }
        } else {
            echo "<p><strong>ID inválido.</strong></p>";
        }
    }

    public function editarLeitor() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $idLeitor = $_GET['id'];
            $leitor = $this->model->getLeitorPorId($idLeitor);
    
            if ($leitor) {
                require 'app/views/editar_leitor.php'; // Envia $leitor para a view
            } else {
                echo "<p><strong>Leitor não encontrado.</strong></p>";
            }
        } else {
            echo "<p><strong>ID inválido.</strong></p>";
        }
    }
    
    public function atualizarLeitor() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
    
            if (!empty($id) && !empty($nome) && !empty($telefone)) {
                $this->model->atualizarLeitor($id, $nome, $telefone);
                header("Location: ?pagina=leitor&id=$id");
                exit();
            } else {
                echo "<p><strong>Todos os campos são obrigatórios.</strong></p>";
            }
        }
    }
    
    public function exibirFormulario() {
        require_once "app/views/adicionar_leitor.php"; // Garante que o formulário é carregado
    }
    

    public function adicionarLeitor() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
    
            if (!empty($nome) && !empty($telefone)) {
                $this->model->adicionarLeitor($nome, $telefone);
                header("Location: ?pagina=leitores");
                exit();
            } else {
                echo "<p><strong>Todos os campos são obrigatórios.</strong></p>";
            }
        }
    }
    
}
?>
