<div class="container mt-5">
    <h2 class="mb-4">Perfil do Leitor</h2>

    <!-- Dados do Leitor -->
    <div class="card mb-5">
        <div class="card-header">
            <h5>Informações do Leitor</h5>
        </div>
        <div class="card-body">
            <?php if (isset($leitor)): ?>
                <p><strong>Nome:</strong> <?= htmlspecialchars($leitor['nome']) ?> </p>
                <p><strong>Telefone:</strong> <?= htmlspecialchars($leitor['telefone']) ?> </p>
            <?php else: ?>
                <p><strong>Leitor não encontrado.</strong></p>
            <?php endif; ?>
            <button class="btn btn-secondary">Editar Dados</button>
        </div>
    </div>

    <!-- Relatório de Estatísticas -->
    <div class="card">
        <div class="card-header">
            <h5>Relatório do Leitor</h5>
        </div>
        <div class="card-body">
            <p><strong>Livros Emprestados:</strong> 3</p>
            <p><strong>Quantidade de Aluguéis já realizados:</strong> 8</p>
            <p><strong>Quantidade de Atrasos:</strong> 2</p>
        </div>
    </div>
</div>
