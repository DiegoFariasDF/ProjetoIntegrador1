<div class="container mt-5">
    <h2 class="mb-4 text-center">🔎 Pesquisa de Livros (Google Books)</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Digite o nome do livro ou autor" value="<?= htmlspecialchars($termo) ?>" required>
                    <button type="submit" class="btn btn-dark">Pesquisar</button>
                </div>
            </form>
        </div>
    </div>

    <?php if ($termo && !empty($livros)): ?>
        <h5 class="mb-3">Resultados para: <b><?= htmlspecialchars($termo) ?></b></h5>
    <?php endif; ?>

    <div class="row">
        <?php if (!empty($livros)): ?>
            <?php foreach ($livros as $livro): ?>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="<?= htmlspecialchars($livro['thumbnail']) ?>" class="card-img-top book-img" alt="<?= htmlspecialchars($livro['titulo']) ?>">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title"><?= htmlspecialchars($livro['titulo']) ?></h6>
                            <p class="text-muted mb-2"><small><b>Autor(es):</b> <?= htmlspecialchars($livro['autores']) ?></small></p>
                            <p class="descricao"><?= mb_strimwidth(strip_tags($livro['descricao']), 0, 120, '...') ?></p>
                            <a href="<?= htmlspecialchars($livro['link']) ?>" target="_blank" class="btn btn-outline-dark btn-sm mt-auto">Ver no Google Books</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php elseif ($termo): ?>
            <div class="alert alert-warning">Nenhum livro encontrado para "<b><?= htmlspecialchars($termo) ?></b>".</div>
        <?php endif; ?>
    </div>
</div>