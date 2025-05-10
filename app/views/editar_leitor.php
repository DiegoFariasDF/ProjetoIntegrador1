<?php include 'app/core/auth.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Editar Informações do Leitor</h2>

    <?php if (isset($leitor)): ?>
        <form action="?pagina=atualizar_leitor" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($leitor['id']) ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text"
                class="form-control"
                id="nome"
                name="nome"
                maxlength="60"
                pattern="^[A-Za-zÀ-ÿ\s]+$"
                oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')"
                value="<?= htmlspecialchars($leitor['nome']) ?>"                    
                required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                
                <input type="tel"
                    class="form-control"
                    id="telefone"
                    name="telefone"
                    pattern="^[0-9]{11}$"
                    maxlength="11"
                    inputmode="numeric"
                    value="<?= htmlspecialchars($leitor['telefone']) ?>"
                    required
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>

            <button type="submit" class="btn btn-dark">Salvar Alterações</button>
            <a href="?pagina=leitor&id=<?= $leitor['id'] ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <p><strong>Leitor não encontrado.</strong></p>
    <?php endif; ?>
</div>
