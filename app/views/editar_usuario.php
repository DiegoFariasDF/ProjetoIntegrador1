<?php include 'app/core/auth.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Editar Informações do Usuario</h2>

    <?php if (isset($usuario)): ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text"
                class="form-control"
                id="nome"
                name="nome"
                maxlength="60"
                pattern="^[A-Za-zÀ-ÿ\s]+$"
                oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')"
                value="<?= htmlspecialchars($usuario['nome']) ?>"
                required>
            </div>
			<div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>

                <input type="text"
                class="form-control"
                id="usuario"
                name="usuario"
                maxlength="60"
                pattern="^[A-Za-zÀ-ÿ\s.]+$"
                oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s.]/g, '')"
                value="<?= htmlspecialchars($usuario['usuario']) ?>"
                required>
            </div>
			<div class="mb-3">
				<label for="permissao" class="form-label">Permissão</label>
				<select class="form-select" id="permissao" name="permissao" required>
                    <option value="admin" <?= $usuario['permissao'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="padrao" <?= $usuario['permissao'] === 'padrao' ? 'selected' : '' ?>>Padrão</option>
                </select>
            </div>

            <button type="submit" class="btn btn-dark">Salvar Alterações</button>
            <a href="?pagina=painel" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <p><strong>Usuario não encontrado.</strong></p>
    <?php endif; ?>
</div>