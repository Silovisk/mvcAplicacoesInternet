<?php

namespace dao\mysql;

use dao\interface\IProdutoDAO;
use generic\MysqlFactory;

class ProdutoDAO extends MysqlFactory implements IProdutoDAO
{
    public function listar()
    {
        $sql = 'SELECT * FROM produto';
        return  $this->banco->executar($sql);
    }
}
