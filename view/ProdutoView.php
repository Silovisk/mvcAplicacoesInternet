<?php

namespace view;

use generic\View;

class ProdutosView extends View
{
    public function listaProdutos($lista)
    {
        $param = [
            'lista' => $lista,
        ];
        $this->conteudo('public/ListaProdutos.php', $param);
    }
}
