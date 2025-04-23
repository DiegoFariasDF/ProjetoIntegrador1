<?php 
if (isset($_GET['pagina'])) {
    $pagina = $_GET["pagina"];
} else {
    $pagina = 'login';
}

/* retorna erros do banco*/
ini_set('display_errors', 1);
error_reporting(E_ALL);

switch ($pagina) {
    case "home":
        require_once "app/controllers/EmprestimoController.php";
        $controller = new EmprestimoController();
        $dados = $controller->listarEmprestimoGrafico(); 
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

    case "adicionar_usuario":
        require_once "app/controllers/UsuarioController.php";
        $controller = new UsuarioController();
        $controller->exibirFormulario(); 
        break;

    case "salvar_usuario": 
        require_once "app/controllers/UsuarioController.php";
        $controller = new UsuarioController();
        $controller->adicionarUsuario();
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
    
    case "login":
        require_once "app/controllers/UsuarioController.php";  
        $controller = new UsuarioController();
        $controller->login();  
        break;
    
    case "logout":
        require_once "app/controllers/UsuarioController.php"; 
        $controller = new UsuarioController();
        $controller->logout();  
        break;
    
    case "painel":
        require_once "app/controllers/UsuarioController.php";
        $controller = new UsuarioController();
        $controller->listarUsuarios();
        break;        

    case "editar_usuario":
        require_once "app/controllers/UsuarioController.php";
        $controller = new UsuarioController();
        $controller->editarUsuario();
        break;

    case "excluir_usuario":
        require_once "app/controllers/UsuarioController.php";
        $controller = new UsuarioController();
        if (isset($_GET['id'])) {
            $controller->excluirUsuario($_GET['id']);
        }
        break;


    default:
        include("app/views/login.php");
        break;
}
?>
