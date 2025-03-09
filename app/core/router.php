<?php 
    if(isset($_GET['pagina'])){
        $pagina = $_GET["pagina"];
    }
    else{
        $pagina = 'home';
    }




    switch ($pagina){
        case "login": include("views/login.php"); break;      

        default: include("views/home.php"); break;
    } 
        
?>