<?php 
if (isset($_GET['pagina'])) {
    $pagina = $_GET["pagina"];
} else {
    $pagina = 'home';
}

/* retorna erros do banco*/
ini_set('display_errors', 1);
error_reporting(E_ALL);

switch ($pagina) {
    case "home":
        include("app/views/home.php");
        break;

    case "leitores":
        require_once "app/controllers/LeitorController.php";
        $controller = new LeitorController();
        $controller->listarLeitores();
        break;

    case "leitor":
        require_once "app/controllers/LeitorController.php";
        $controller = new LeitorController();
        $controller->mostrarLeitor();
        break;
    
    case "editar_leitor":
        require_once "app/controllers/LeitorController.php";
        $controller = new LeitorController();
        $controller->editarLeitor();
        break;
    
    case "atualizar_leitor":
        require_once "app/controllers/LeitorController.php";
        $controller = new LeitorController();
        $controller->atualizarLeitor();
        break;
    
    case "adicionar_leitor":
        require_once "app/controllers/LeitorController.php";
        $controller = new LeitorController();
        $controller->exibirFormulario(); 
        break;
    
    case "salvar_leitor": 
        require_once "app/controllers/LeitorController.php";
        $controller = new LeitorController();
        $controller->adicionarLeitor();
        break;
    
    case "emprestimo":
        require_once "app/controllers/EmprestimoController.php";
        $controller = new EmprestimoController();
        $controller->listarEmprestimo();
        break;

    case "renovar_emprestimo":
        require_once "app/controllers/EmprestimoController.php";
        $controller = new EmprestimoController();
        if (isset($_GET['id'])) {
            $controller->renovarEmprestimo($_GET['id']);
        }
        break;

    case "finalizar_emprestimo":
        require_once "app/controllers/EmprestimoController.php";
        $controller = new EmprestimoController();
        if (isset($_GET['id'])) {
            $controller->finalizarEmprestimo($_GET['id']);
        }
        break;
    
    case "novo_emprestimo":
        require_once "app/controllers/EmprestimoController.php";  
        $controller = new EmprestimoController();
        $controller->novoEmprestimo();  
        break;
        

    default:
        include("app/views/login.php");
        break;
}
?>
