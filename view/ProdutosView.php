<?php

namespace view;

use generic\View;

class ProdutosView extends View
{
    public function index($lista, $categorias)
    {
        $param = [
            'lista' => $lista,
            'categorias' => $categorias,
        ];
        $this->conteudo('public/produto/index.php', $param);
    }

    public function create()
    {
        $this->conteudo('public/produto/create.php');
    }

    public function edit($produto)
    {
        $param = [
            'produto' => $produto,
        ];

        $this->conteudo('public/produto/edit.php', $param);
    }
}
