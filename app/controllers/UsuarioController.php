<?php
require_once 'app/model/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

    public function listarUsuarios() {
        $usuarios = $this->model->listarUsuarios();
        require 'app/views/usuarios.php'; 
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['user'];
            $senha = $_POST['senha'];

            $usuario = $this->model->autenticarUsuario($user, $senha);

            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_permissao'] = $usuario['permissao'];
                $_SESSION['ultimo_acesso'] = time(); 

                if ($_SESSION['usuario_permissao'] == 'admin') {
                    header("Location: ?pagina=home"); 
                    exit();
                } elseif ($_SESSION['usuario_permissao'] == 'padrao') {
                    header("Location: ?pagina=home"); 
                    exit();
                }

            } else {
                header("Location: ?pagina=login&erro=1"); 
                exit();
            }
        }
        require 'app/views/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: ?pagina=login");
        exit();
    }
}
?>
