<?php include 'app/core/auth.php'; ?>
<div class="container mt-5">

    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-md-3 p-3">
            <div class="card text-white bg-primary shadow rounded">
                <div class="card-body">
                    <h5 class="card-title">Total de Emprestimo no Ano</h5>
                    <p class="card-text fs-4"><?= $dados['totalEmprestimosAnual'] ?? 0?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-3">
            <div class="card text-white bg-success shadow rounded">
                <div class="card-body">
                    <h5 class="card-title">Emprestados Regulares</h5>
                    <p class="card-text fs-4"><?= $dados['totalEmprestimosRegular'] ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-3">
            <div class="card text-white bg-danger shadow rounded">
                <div class="card-body">
                    <h5 class="card-title">Emprestados Atrasados</h5>
                    <p class="card-text fs-4"><?= $dados['totalAtrasos'] ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <?php include 'app/views/graphic/grafico_emprestimo.php'; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 p-3">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <strong>Leiores com mais atrasos</strong>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> user5 <span class="badge bg-secondary float-end">38</span></li>
                    <li class="list-group-item"> user4 <span class="badge bg-secondary float-end">32</span></li>
                    <li class="list-group-item"> user3 <span class="badge bg-secondary float-end">29</span></li>
                    <li class="list-group-item"> user2 <span class="badge bg-secondary float-end">25</span></li>
                    <li class="list-group-item"> user1 <span class="badge bg-secondary float-end">22</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-6 p-3">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <strong>Últimos Empréstimos</strong>
                </div>
                <ul class="list-group list-group-flush">
                    <?php if (!empty($dados['ultimosEmprestimos'])): ?>
                        <?php foreach ($dados['ultimosEmprestimos'] as $emprestimo): ?>
                            <li class="list-group-item">
                                <?= htmlspecialchars($emprestimo['nome']) ?> - 
                                "<?= htmlspecialchars($emprestimo['livro']) ?>" - 
                                <?= date('d/m/Y', strtotime($emprestimo['data_emprestimo'])) ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-muted">Nenhum empréstimo recente.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </div>

</div>
