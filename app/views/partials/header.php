<!DOCTYPE HTML>
<html lang="pt-br">
    <title>Livro em Dia</title>
    <link rel="stylesheet" href="public/css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/public/js/index.js"></script>
    <link rel="icon" href="public/img/logoRedondoDark48.png" type="image/png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<header class="navbar navbar-expand-xl navbar-dark bg-dark fixed-top sticky-top">
    <div class="container">
    
        <a class="navbar-brand fs-2 fw-bold" href="<?php
                session_start(); 

                if (!isset($_SESSION['usuario_nome'])) {
                    echo "?pagina=login";
                } else {                    
                    echo "?pagina=home";
                }
            ?>"><img src="public/img/logo.png" alt="Logo" height="50px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDark" aria-controls="navbarDark" aria-expanded="false" aria-label="Toggle navigation">
        
        <img src="public/img/hamburger.png" alt="">
        
        </button>
        <div class="collapse navbar-collapse" id="navbarDark">
            <ul class="navbar-nav ms-auto mb-2 mb-xl-0 fs-5 ms-auto p-2 text-center">
            
            <?php
                if (!isset($_SESSION['usuario_nome'])) {
                    
                    echo "<li class=\"nav-item me-3\">
                            <a class=\"nav-link\" href=\"?pagina=login\">Login</a>
                          </li>";
                } else {
                    
                    $id = md5($_SESSION['usuario_id']); 
                    $tipo_usuario = strtolower($_SESSION['usuario_nome']); 
                    echo "<li class=\"nav-item me-3\"><a href=\"?pagina=home\" class=\"nav-link\">Home</a></li>";
                    echo "<li class=\"nav-item me-3\"><a href=\"?pagina=leitores\" class=\"nav-link\">Leitores</a></li>";
                    echo "<li class=\"nav-item me-3\"><a href=\"?pagina=emprestimo\" class=\"nav-link\">Emprestimo</a></li>";
                    echo "<li class=\"nav-item me-3\"><a href=\"?pagina=painel\" class=\"nav-link\">Painel</a></li>";
                    echo "<li class=\"nav-item me-3\"><a href=\"?pagina=logout\" class=\"nav-link\">Sair</a></li>";
                }
            ?>
            
            </ul>
        </div>
    </div>
</header>