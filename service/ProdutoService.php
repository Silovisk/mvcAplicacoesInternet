<?php

namespace service;

use dao\mysql\ProdutoDAO;

class ProdutoService extends ProdutoDAO
{
    public function index()
    {
        return parent::index();
    }

    public function store()
    {
        return parent::store();
    }

    public function edit($id)
    {
        return parent::edit($id);
    }

    public function update()
    {
        return parent::update();
    }

    public function destroy()
    {
        return parent::destroy();
    }
}
