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
}
?>
