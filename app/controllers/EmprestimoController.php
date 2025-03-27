<?php 
require_once 'app/model/EmprestimoModel.php';

class EmprestimoController {
    private $model;
    public function __construct() {
        $this->model = new EmprestimoModel();
    }
    public function listarEmprestimo(){
        $totalEmprestimos = $this->model->contarEmprestimos();
        $emprestimos = $this->model->listarEmprestimo();
        $emprestimosVencidos = 0;

        foreach ($emprestimos as &$emprestimo) {
            $dataEmprestimo = new DateTime($emprestimo['data_emprestimo']);
            $dataEmprestimo->modify('+15 days');
            $emprestimo['data_devolucao'] = $dataEmprestimo->format('d/m/Y');
            $dataAtual = new DateTime();

            if ($dataEmprestimo < $dataAtual) {
                $emprestimosVencidos++;
            }
        }

        require 'app/views/emprestimo.php';
    }

    public function renovarEmprestimo($id_emprestimo) {
        $resultado = $this->model->renovarEmprestimo($id_emprestimo);
    
        if ($resultado) {
            header("Location: ?pagina=emprestimo&status=success");
        } else {
            header("Location: ?pagina=emprestimo&status=fail");
        }
    }

    public function finalizarEmprestimo($id_emprestimo) {
        $resultado = $this->model->finalizarEmprestimo($id_emprestimo);
    
        if ($resultado) {
            header("Location: ?pagina=emprestimo&status=success");
        } else {
            header("Location: ?pagina=emprestimo&status=fail");
        }
    }
    
    
}