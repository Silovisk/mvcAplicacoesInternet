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

    public function index()
    {
        $lista = $this->produtoService->index();
        $categorias = $this->produtoService->getcategories();

        $this->produtoView->index($lista, $categorias);
    }

    public function create()
    {
        $this->produtoView->create();
    }

    public function store()
    {
        $response = $this->produtoService->store();
        header('Content-Type: application/json');
        echo $response;
    }

    public function edit($id)
    {
        $produto = $this->produtoService->edit($id);
        $this->produtoView->edit($produto);
    }

    public function update()
    {
        $response = $this->produtoService->update();
        header('Content-Type: application/json');
        echo $response;
    }

    public function destroy()
    {
        $response = $this->produtoService->destroy();
        header('Content-Type: application/json');
        echo $response;
    }
}
