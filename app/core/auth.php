<?php

$tempo_limite = 14400; 

if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    die('
<div class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f8f9fa;">
    <div class="text-center">
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Erro 401</h4>
            <p>Você não está logado. Por favor, faça login para acessar a página.</p>
            <hr>
            <p class="mb-0">Clique <a href="?pagina=login">aqui</a> para entrar.</p>
        </div>
    </div>
</div>');
}

if (isset($_SESSION['ultimo_acesso'])) {
    $tempo_decorrido = time() - $_SESSION['ultimo_acesso'];

    if ($tempo_decorrido > $tempo_limite) {
        session_unset();
        session_destroy();
        header("Location: ?pagina=login");
        exit();
    }
}

$_SESSION['ultimo_acesso'] = time();

$tipo_usuario = $_SESSION['usuario_permissao'] ?? ''; 
$pagina_atual = $_GET['pagina'] ?? '';

$permissoes = [
    'admin' => ['home', 'leitores', 'adicionar_leitor', 'editar_leitor', 'leitor', 'emprestimo', 'novo_emprestimo', 'painel'],
    'padrao' => ['home', 'leitores', 'adicionar_leitor', 'editar_leitor', 'leitor', 'emprestimo', 'novo_emprestimo', 'painel']
];


if (!isset($permissoes[$tipo_usuario]) || !in_array($pagina_atual, $permissoes[$tipo_usuario])) {
    die('
<div class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f8f9fa;">
    <div class="text-center">
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Erro 403</h4>
            <p>Você não tem permissão para acessar esta página.</p>
            <hr>
            <p class="mb-0">Clique <a href="javascript:history.back()">aqui</a> para voltar.</p>
        </div>
    </div>
</div>');
}
?>
