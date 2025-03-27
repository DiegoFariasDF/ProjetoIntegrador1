<div class="container mt-5">
    <h2 class="mb-4">Novo Empréstimo</h2>

    <form action="?pagina=novo_emprestimo" method="POST">
        <div class="mb-3">
            <label for="leitor_id" class="form-label">Leitor:</label>
            <select class="form-control" id="leitor_id" name="leitor_id" required>
                <option value="">Selecione um leitor</option>
                <?php
                require_once 'app/model/LeitorModel.php';
                $leitorModel = new LeitorModel();
                $leitores = $leitorModel->listarLeitores();
                foreach ($leitores as $leitor) {
                    echo "<option value='{$leitor['id']}'>{$leitor['nome']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="livro" class="form-label">Livro:</label>
            <input type="text" class="form-control" id="livro" name="livro" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Empréstimo</button>
    </form>
</div>
