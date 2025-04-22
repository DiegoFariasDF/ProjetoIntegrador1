<div class="text-center d-flex align-items-center justify-content-center p-3">
    <main class="form-signin w-100 m-auto" style="max-width: 380px;">
        <form action="" method="POST"> 
            <img class="mb-4" src="public/img/logoDark.png" alt="Logo" height="100">
            <h1 class="h3 mb-3 fw-normal">Login</h1>

            <div class="form-floating mb-3">
                <input type="text" class="form-control form-control-lg rounded-3" 
                       id="floatingInput" name="user" placeholder="mario.bros" required>
                <label for="floatingInput">Usuário</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control form-control-lg rounded-3" 
                       id="floatingPassword" name="senha" placeholder="Password" required>
                <label for="floatingPassword">Senha</label>
            </div>

            <button class="w-100 btn btn-lg btn-dark rounded-3" type="submit">Login</button>

            <?php if (isset($_GET['erro'])): ?>
                <p class="text-danger mt-2">Usuário ou senha inválidos!</p>
            <?php endif; ?>

        </form>
    </main>
</div>
