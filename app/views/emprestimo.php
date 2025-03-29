<div class="container mt-5">
    <h2 class="mb-4">Empréstimos de Livros</h2>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-header bg-secondary text-white">
                    <h5>Relatório de Empréstimos</h5>
                </div>
                <div class="card-body">
                    <p>Total de Empréstimos Ativos: <strong><?= $totalEmprestimos ?></strong></p>
                    <p>Empréstimos vencidos: <strong><?= $emprestimosVencidos ?></strong></p>
                </div>
            </div> 
        </div>
    </div>
    
    <a href="?pagina=novo_emprestimo" class="btn btn-success mt-3">
        <span class="d-inline-flex align-items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>    
            Novo Empréstimo
        </span>
    </a>
    
    <div class="mb-4 mt-3">
        <label for="search" class="form-label">Pesquisar Empréstimo:</label>
        <input type="text" id="search" class="form-control" placeholder="Digite o nome do usuário ou livro">
    </div>
    
    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Leitor</th>
                    <th>Livro</th>
                    <th>Prazo de Devolução</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="loan-list">
                <?php if (!empty($emprestimos)): ?>
                <?php foreach ($emprestimos as $emprestimos): ?>
                    <tr>
                        <td><?= htmlspecialchars($emprestimos['id']) ?></td>
                        <td><?= htmlspecialchars($emprestimos['nome']) ?></td>
                        <td><?= htmlspecialchars($emprestimos['livro']) ?></td>
                        <td><?= htmlspecialchars($emprestimos['data_devolucao']) ?></td>
                        <td>
                            <a class="btn btn-secondary btn-sm btn-renovar" 
                            href="?pagina=renovar_emprestimo&id=<?= $emprestimos['id'] ?>" 
                            data-id="<?= $emprestimos['id'] ?>">
                                Renovar
                            </a>
                            <a href="?pagina=finalizar_emprestimo&id=<?= $emprestimos['id'] ?>" 
                            class="btn btn-dark btn-sm btn-finalizar">
                                Finalizar Empréstimo
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php else: ?>
                    <tr><td colspan="4">Nenhum usuário encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<?php 
    include 'modals/statusModal.php';
    include 'modals/confirmRenovacao.php'; 
    include 'modals/confirmFinalizacao.php';
?>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    let renovarLink = null;
    let finalizarLink = null;

    // Captura o link de renovação
    document.querySelectorAll(".btn-renovar").forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            renovarLink = this.getAttribute("href");
            let modal = new bootstrap.Modal(document.getElementById("confirmRenovacaoModal"));
            modal.show();
        });
    });

    document.getElementById("confirmRenovar").addEventListener("click", function() {
        if (renovarLink) {
            window.location.href = renovarLink;
        }
    });

    // Captura o link de finalização
    document.querySelectorAll(".btn-finalizar").forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            finalizarLink = this.getAttribute("href");
            let modal = new bootstrap.Modal(document.getElementById("confirmFinalizacaoModal"));
            modal.show();
        });
    });

    document.getElementById("confirmFinalizar").addEventListener("click", function() {
        if (finalizarLink) {
            window.location.href = finalizarLink;
        }
    });

    <?php if ($status == 'success' || $status == 'fail'): ?>
        var myModal = new bootstrap.Modal(document.getElementById('statusModal'));
        myModal.show();
    <?php endif; ?>

    // Filtragem da tabela de empréstimos
    document.getElementById("search").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll("#loan-list tr");

        rows.forEach(row => {
            let usuario = row.children[1].textContent.toLowerCase();
            let livro = row.children[2].textContent.toLowerCase();

            if (usuario.includes(searchValue) || livro.includes(searchValue)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});
</script>
