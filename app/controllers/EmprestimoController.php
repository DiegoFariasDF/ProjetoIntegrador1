<?php 
require_once 'app/model/EmprestimoModel.php';

class EmprestimoController {
    private $model;
    public function __construct() {
        $this->model = new EmprestimoModel();
    }
    public function listarEmprestimo(){
        $this->model->verificarEAtribuirAtrasos();

        $totalEmprestimos = $this->model->contarEmprestimos();
        $totalEmprestimosRegular = $this->model->contarEmprestimosRegular();
        $totalAtrasos = $this->model->contarAtrasos();
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

    public function listarEmprestimoGrafico() {
        $totalEmprestimosAnual = $this->model->contarEmprestimosTotalAnual();
        $totalEmprestimosAtivos = $this->model->contarEmprestimos();
        $totalEmprestimosRegular = $this->model->contarEmprestimosRegular();
        $totalAtrasos = $this->model->contarAtrasos();
        $emprestimos = $this->model->listarEmprestimo();
        $ultimosEmprestimos = $this->model->buscarUltimosEmprestimos();
    
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
    
        return [
            'totalEmprestimosAnual' => $totalEmprestimosAnual,
            'totalEmprestimosAtivos' => $totalEmprestimosAtivos,
            'totalEmprestimosRegular' => $totalEmprestimosRegular,
            'totalAtrasos' => $totalAtrasos,
            'emprestimosVencidos' => $emprestimosVencidos,
            'emprestimos' => $emprestimos,
            'ultimosEmprestimos' => $ultimosEmprestimos
        ];
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

    public function novoEmprestimo(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $leitor_id = $_POST['leitor_id'];
            $livro = $_POST['livro'];

            if (!empty($leitor_id) && !empty($livro)) {
                $this->model->novoEmprestimo($leitor_id, $livro);
                header("Location: ?pagina=emprestimo");
                exit();
            } else {
                echo "<p><strong>Todos os campos são obrigatórios.</strong></p>";
            }
        } 
        require 'app/views/novo_emprestimo.php';
    }
    
    
}