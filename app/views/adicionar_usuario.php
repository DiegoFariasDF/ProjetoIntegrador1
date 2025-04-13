<?php include 'app/core/auth.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Adicionar Novo Usuario</h2>
    
    <div class="card">
        <div class="card-header">
            <h5>Preencha os dados do novo usuario</h5>
        </div>
        <div class="card-body">
            <form action="?pagina=salvar_usuario" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="permissao" class="form-label">Permissão</label>
                    <select class="form-select" id="permissao" name="permissao" required>
                        <option value="admin">Admin</option>
                        <option value="padrao">Padrão</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="?pagina=painel" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
