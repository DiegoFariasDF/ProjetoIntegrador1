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

    case "usuarios":
        require_once "app/controllers/UsuarioController.php";
        $controller = new UsuarioController();
        $controller->listarUsuarios(); // Chama a função que carrega a view com os dados
        break;

    case "usuario":
        include("app/views/usuario.php");
        break;

    default:
        include("app/views/login.php");
        break;
}
?>
