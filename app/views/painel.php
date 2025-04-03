<?php 
// demonstração
$usuarios = [
    ["id" => 1, "nome" => "Diego Farias", "usuario" => "dfarias", "permissao" => "Administrador"],
    ["id" => 2, "nome" => "Ana Souza", "usuario" => "asouza", "permissao" => "Editor"],
    ["id" => 3, "nome" => "Carlos Lima", "usuario" => "clima", "permissao" => "Usuário"],
];
?>
<div class="container mt-5">
    <h2 class="mb-4">Gerenciamento de Usuários</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="?pagina=adicionar_usuario" class="btn btn-dark">
            <span class="d-inline-flex align-items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>    
                Adicionar Usuário
            </span>
        </a>
        <input type="text" id="search" class="form-control w-25" placeholder="Buscar usuário...">
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd;">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>Permissão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="user-list">
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td class="nome"> <?= htmlspecialchars($usuario['nome']) ?> </td>
                            <td class="usuario"> <?= htmlspecialchars($usuario['usuario']) ?> </td>
                            <td class="permissao"> <?= htmlspecialchars($usuario['permissao']) ?> </td>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="?pagina=editar_usuario&id=<?= $usuario['id'] ?>">Editar</a>
                                <a class="btn btn-danger btn-sm" href="?pagina=excluir_usuario&id=<?= $usuario['id'] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">Nenhum usuário encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById("search").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll("#user-list tr");

        rows.forEach(row => {
            let nome = row.querySelector(".nome").textContent.toLowerCase();
            let usuario = row.querySelector(".usuario").textContent.toLowerCase();
            let permissao = row.querySelector(".permissao").textContent.toLowerCase();

            row.style.display = (nome.includes(searchValue) || usuario.includes(searchValue) || permissao.includes(searchValue)) ? "" : "none";
        });
    });
</script>
