<div class="container mt-5">
    <h2 class="mb-4">Lista de Clientes</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-header bg-secondary text-white">
                    <h5>Relatório de Clientes</h5>
                </div>
                <div class="card-body">
                    <p>Total de Clientes Cadastrados: <strong><?= $totalLeitores ?></strong></p>
                    <p>Clientes que estão alugando um livro: <strong>3</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <label for="search" class="form-label">Pesquisar Cliente:</label>
        <input type="text" id="search" class="form-control" placeholder="Digite o nome ou telefone">
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="client-list">
                <?php if (!empty($leitores)): ?>
                    <?php foreach ($leitores as $leitores): ?>
                        <tr>
                            <td><?= htmlspecialchars($leitores['id']) ?></td>
                            <td class="nome"><?= htmlspecialchars($leitores['nome']) ?></td>
                            <td class="telefone"><?= htmlspecialchars($leitores['telefone']) ?></td>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="?pagina=leitor&id=<?= $leitores['id'] ?>">Visualizar usuário</a>
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

<script>
    document.getElementById("search").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll("#client-list tr");

        rows.forEach(row => {
            let nome = row.querySelector(".nome").textContent.toLowerCase();
            let telefone = row.querySelector(".telefone").textContent.toLowerCase();

            if (nome.includes(searchValue) || telefone.includes(searchValue)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>


