<?php

namespace controller;

use service\ProdutoService;
use view\ProdutosView;

class ProdutoController
{
    protected $produtoService;
    protected $produtoView;

    public function __construct()
    {
        $this->produtoView = new ProdutosView();
        $this->produtoService = new ProdutoService();
    }

    public function listarProdutos()
    {
        $lista = $this->produtoService->listar();
        $this->produtoView->listaProdutos($lista);
    }
}
