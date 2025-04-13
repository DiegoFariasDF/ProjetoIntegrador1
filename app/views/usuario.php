<?php include 'app/core/auth.php'; ?>
<div class="container mt-5">
    <a href="?pagina=leitores" class="btn btn-dark mb-3">
    <span class="d-inline-flex align-items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
        Voltar
    </span>
    </a>
    
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
            <a href="?pagina=editar_leitor&id=<?= $leitor['id'] ?>" class="btn btn-secondary">Editar Dados</a>
        </div>
    </div>

    <!-- Relatório de Estatísticas -->
    <div class="card">
        <div class="card-header">
            <h5>Relatório do Leitor</h5>
        </div>
        <div class="card-body">
            <p><strong>Livros Emprestados:</strong> <?= htmlspecialchars($leitor['emprestimos_ativos']) ?></p>
            <p><strong>Quantidade de Aluguéis já realizados:</strong> <?= htmlspecialchars($leitor['total_emprestimos']) ?> </p>
            <p><strong>Quantidade de Atrasos:</strong> <?= htmlspecialchars($leitor['emprestimos_atrasados']) ?> </p>
        </div>
    </div>
</div>
