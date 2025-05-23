<?php include 'app/core/auth.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Adicionar Novo Leitor</h2>
    
    <div class="card">
        <div class="card-header">
            <h5>Preencha os dados do novo leitor</h5>
        </div>
        <div class="card-body">
            <form action="?pagina=salvar_leitor" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text"
                    class="form-control"
                    id="nome"
                    name="nome"
                    maxlength="60"
                    pattern="^[A-Za-zÀ-ÿ\s]+$"
                    oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')"
                    placeholder="Digite o nome completo"
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
                    placeholder="Ex: 11987654321"
                    required
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="?pagina=leitores" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
