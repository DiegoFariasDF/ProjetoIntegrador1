<?php
require_once 'app/model/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

    public function listarUsuarios() {
        $usuarios = $this->model->listarUsuarios(); // Busca os usuários
        require 'app/views/usuarios.php'; // Chama a view correta e passa os dados
    }
}
?>
