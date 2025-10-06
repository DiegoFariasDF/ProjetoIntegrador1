<?php

namespace app\model;

class GoogleBooksModel
{
    public function buscarLivros($termo)
    {
        if (empty($termo)) {
            return [];
        }

        $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($termo) . "&maxResults=12";
        $resposta = @file_get_contents($url);

        if ($resposta === false) {
            return [];
        }

        $dados = json_decode($resposta, true);
        if (!isset($dados['items'])) {
            return [];
        }

        $livros = [];
        foreach ($dados['items'] as $item) {
            $info = $item['volumeInfo'];

            $livros[] = [
                'titulo' => $info['title'] ?? 'Título não disponível',
                'autores' => isset($info['authors']) ? implode(', ', $info['authors']) : 'Autor não informado',
                'descricao' => $info['description'] ?? 'Sem descrição disponível.',
                'thumbnail' => $info['imageLinks']['thumbnail'] ?? 'https://via.placeholder.com/128x200?text=Sem+Capa',
                'link' => $info['infoLink'] ?? '#'
            ];
        }

        return $livros;
    }
}
