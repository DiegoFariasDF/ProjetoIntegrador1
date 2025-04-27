<?php
require_once 'app/model/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

    public function listarUsuarios() {
        $usuarios = $this->model->listarUsuarios();
        require 'app/views/painel.php'; 
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

    public function exibirFormulario() {
        require_once "app/views/adicionar_usuario.php"; 
    }

    public function adicionarUsuario() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = $_POST['nome'];
            $permissao = $_POST['permissao'];
            //criando o nome de usuario
            $partesNome = explode(" ", trim($nome));
            $primeiro = $partesNome[0];
            $ultimo = end($partesNome);
            $usuario = strtolower($primeiro . "." . $ultimo);
            // Senha padrao 1 ao 7
            $senha = '$2y$10$zJkEssRWCH9DTeSh.3sXl.Yd11P658Bf0pZ7ZPDyDw/8JRw.LaDoa';
    
            if (!empty($nome) && !empty($permissao)) {
                $this->model->adicionarUsuario($nome, $permissao, $usuario, $senha);
                header("Location: ?pagina=painel");
                exit();
            } else {
                echo "<p><strong>Todos os campos são obrigatórios.</strong></p>";
            }
        }
    }

    public function editarConta() {
        if (isset($_SESSION['usuario_id']) && is_numeric($_SESSION['usuario_id'])) {
            $idConta = $_SESSION['usuario_id'];
            $conta = $this->model->getUsuarioPorId($idConta);
    
            if (!$conta) {
                echo "<p><strong>Usuário não encontrado.</strong></p>";
                return;
            }
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome = $_POST['nome'];
    
                $atualizado = $this->model->atualizarConta($idConta, $nome);
    
                if ($atualizado) {
                    header("Location: ?pagina=conta&status=success");
                    exit;
                } else {
                    echo "<p><strong>Erro ao atualizar a conta.</strong></p>";
                }
            } else {
                require 'app/views/conta.php';
            }
        } else {
            echo "<p><strong>ID inválido.</strong></p>";
        }
    }

    public function editarSenha(){
        if (isset($_SESSION['usuario_id']) && is_numeric($_SESSION['usuario_id'])) {
            $idConta = $_SESSION['usuario_id'];
            $conta = $this->model->getUsuarioPorId($idConta);
    
            if (!$conta) {
                echo "<p><strong>Usuário não encontrado.</strong></p>";
                return;
            }
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $senha = $_POST['nova-senha'];
                $confirmarSenha = $_POST['confirmar-senha'];

                if ($senha !== $confirmarSenha) {
                    header("Location: ?pagina=conta&status=senha");
                    return;
                }

                $senhaCripto = password_hash($senha, PASSWORD_DEFAULT);

                $atualizado = $this->model->atualizarSenha($idConta, $senhaCripto);
    
                if ($atualizado) {
                    header("Location: ?pagina=conta&status=success");
                    exit;
                } else {
                    header("Location: ?pagina=conta&status=fail");
                }
            } else {
                require 'app/views/alterarSenha.php';
            }
        } else {
            echo "<p><strong>ID inválido.</strong></p>";
        }
    }
    
    

    public function editarUsuario() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $idUsuario = $_GET['id'];
            $usuario = $this->model->getUsuarioPorId($idUsuario);
    
            if (!$usuario) {
                echo "<p><strong>Usuário não encontrado.</strong></p>";
                return;
            }
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome = $_POST['nome'];
                $user = $_POST['usuario'];
                $permissao = $_POST['permissao'];
    
                $atualizado = $this->model->editarUsuario($idUsuario, $nome, $user, $permissao);
    
                if ($atualizado) {
                    header("Location: ?pagina=painel");
                    exit;
                } else {
                    echo "<p><strong>Erro ao atualizar o usuário.</strong></p>";
                }
            } else {
                require 'app/views/editar_usuario.php';
            }
        } else {
            echo "<p><strong>ID inválido.</strong></p>";
        }
    }

    public function excluirUsuario($id) {
        $resultado = $this->model->excluirUsuario($id);
    
        if ($resultado) {
            header("Location: ?pagina=painel&status=success");
        } else {
            header("Location: ?pagina=painel&status=fail");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ?pagina=login");
        exit();
    }

    public function resetarSenha($id) {
        $resultado = $this->model->resetarSenha($id);
    
        if ($resultado) {
            header("Location: ?pagina=painel&status=success");
        } else {
            header("Location: ?pagina=painel&status=fail");
        }
    }

}
?>
