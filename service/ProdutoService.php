<?php

namespace service;

use dao\mysql\ProdutoDAO;

class ProdutoService extends ProdutoDAO
{
    public function listar()
    {
        return parent::listar();
    }
}
