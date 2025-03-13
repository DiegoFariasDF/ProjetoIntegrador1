<div class="container mt-5">
    <h2 class="mb-4">Editar Informações do Leitor</h2>

    <?php if (isset($leitor)): ?>
        <form action="?pagina=atualizar_leitor" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($leitor['id']) ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($leitor['nome']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($leitor['telefone']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="?pagina=leitor&id=<?= $leitor['id'] ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <p><strong>Leitor não encontrado.</strong></p>
    <?php endif; ?>
</div>
