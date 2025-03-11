<div class="container mt-5">
    <h2 class="mb-4">Perfil do Usuário</h2>

    <!-- Dados do Usuário -->
    <div class="card mb-5">
        <div class="card-header">
            <h5>Informações do Usuário</h5>
        </div>
        <div class="card-body">
            <?php
                include "app/controllers/UsuarioModel.php";

                $usuarioModel = new UsuarioModel();
                $idUsuario = $_GET['id']; 
                $usuario = $usuarioModel->getUsuarioPorId($idUsuario);

                $nome = $usuario['nome'];
                $telefone = $usuario['id'];

                if ($usuario) {
                    echo "<p><strong>Nome:</strong> $nome </p>";
                    echo "<p><strong>Telefone:</strong> $telefone </p>";
                } else {
                    echo "<p><strong>Usuário não encontrado.</strong>";
                }

            ?>
            <button class="btn btn-secondary">Editar Dados</button>
        </div>
    </div>

    <!-- Relatório de Estatísticas -->
    <div class="card">
        <div class="card-header">
            <h5>Relatório do usuario</h5>
        </div>
        <div class="card-body">
            <p><strong>Livros Emprestados:</strong> 3</p>
            <p><strong>Quantidade de Aluguéis já realizados:</strong> 8</p>
            <p><strong>Quantidade de Atrasos:</strong> 2</p>
        </div>
    </div>
</div>