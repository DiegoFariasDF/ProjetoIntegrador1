<?php

namespace app\controllers;

use app\model\GoogleBooksModel;

require_once __DIR__ . '/../model/GoogleBooksModel.php';

class GoogleBooksController
{
    public function index()
    {
        $livros = [];
        $termo = '';

        if (isset($_POST['q']) && $_POST['q'] !== '') {
            $termo = trim($_POST['q']);
            $model = new GoogleBooksModel();
            $livros = $model->buscarLivros($termo);
        }

        require_once __DIR__ . '/../Views/googlebooks.php';
    }
}