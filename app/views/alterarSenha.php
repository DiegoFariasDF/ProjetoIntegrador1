<?php include 'app/core/auth.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Alterar Senha</h2>

    <?php if (isset($conta)): ?>
        <form action="" method="POST" id="changePasswordForm">
            <input type="hidden" name="id" value="<?= htmlspecialchars($conta['id']) ?>">

            <div class="mb-3">
                <label for="nova-senha" class="form-label">Nova Senha</label>
                <input type="password" class="form-control" id="nova-senha" name="nova-senha" required>
            </div>

            <div class="mb-3">
                <label for="confirmar-senha" class="form-label">Confirmar Nova Senha</label>
                <input type="password" class="form-control" id="confirmar-senha" name="confirmar-senha" required>
                <div id="senha-feedback" class="invalid-feedback">
                    As senhas não coincidem.
                </div>
            </div>

            <button type="submit" class="btn btn-dark">Alterar Senha</button>
            <a href="?pagina=conta&id=<?= $conta['id'] ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <p><strong>Conta não encontrada.</strong></p>
    <?php endif; ?>
</div>
