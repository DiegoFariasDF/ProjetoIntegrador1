<?php 
if (isset($_GET['pagina'])) {
    $pagina = $_GET["pagina"];
} else {
    $pagina = 'home';
}

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

    default:
        include("app/views/login.php");
        break;
}
?>
