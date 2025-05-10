<?php include 'app/core/auth.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Gerenciamento de Conta</h2>

    <?php if (isset($conta)): ?>
        <div class="card mb-4">
            <div class="card-header">
                Dados Pessoais
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($conta['id']) ?>">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        
                        <input type="text"
                        class="form-control"
                        id="nome"
                        name="nome"
                        maxlength="60"
                        pattern="^[A-Za-zÀ-ÿ\s]+$"
                        oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')"
                        value="<?= htmlspecialchars($conta['nome']) ?>"
                        required>
                    </div>

                    <button type="submit" class="btn btn-dark">Salvar Alterações</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Sua Senha
            </div>
            <div class="card-body">
                <a href="?pagina=alterar_senha" class="btn btn-dark">Alterar Senha</a>
            </div>
        </div>

    <?php else: ?>
        <p><strong>Usuario não encontrado.</strong></p>
    <?php endif; ?>
</div>

<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<?php 
    include 'modals/statusModal.php';
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    <?php if ($status == 'success' || $status == 'fail' || $status == 'senha'): ?>
        var myModal = new bootstrap.Modal(document.getElementById('statusModal'));
        myModal.show();
    <?php endif; ?>
    });
</script>