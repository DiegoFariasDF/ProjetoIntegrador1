<?php include 'app/core/auth.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Editar Informações do Usuario</h2>

    <?php if (isset($usuario)): ?>
        <form action="?pagina=atualizar_leitor" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="?pagina=leitor&id=<?= $usuario['id'] ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <p><strong>Usuario não encontrado.</strong></p>
    <?php endif; ?>
</div>
