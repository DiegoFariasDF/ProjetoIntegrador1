<?php include 'app/core/auth.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Lista de Leitores</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-header bg-secondary text-white">
                    <h5>Relatório de Leitores</h5>
                </div>
                <div class="card-body">
                    <p>Total de Leitores Cadastrados: <strong><?= $totalLeitores ?></strong></p>
                    <p>Total de livros sendo alugados: <strong>1</strong></p>
                </div>
            </div>
        </div>
    </div>

    <a href="?pagina=adicionar_leitor" class="btn btn-success mt-3">
        <span class="d-inline-flex align-items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>    
            Adicionar Leitor
        </span>
    </a>

    <div class="mb-3 mt-3">
        <label for="search" class="form-label">Pesquisar Leitor:</label>
        <input type="text" id="search" class="form-control" placeholder="Digite o nome ou telefone">
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd;">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="client-list">
                <?php if (!empty($leitores)): ?>
                    <?php foreach ($leitores as $leitor): ?>
                        <tr>
                            <td class="nome"><?= htmlspecialchars($leitor['nome']) ?></td>
                            <td class="telefone"><?= htmlspecialchars($leitor['telefone']) ?></td>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="?pagina=leitor&id=<?= $leitor['id'] ?>">Visualizar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">Nenhum usuário encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById("search").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll("#client-list tr");

        rows.forEach(row => {
            let nome = row.querySelector(".nome").textContent.toLowerCase();
            let telefone = row.querySelector(".telefone").textContent.toLowerCase();

            row.style.display = (nome.includes(searchValue) || telefone.includes(searchValue)) ? "" : "none";
        });
    });
</script>
