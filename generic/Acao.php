<?php

namespace generic;

class Acao
{
    private $classe;
    private $metodo;

    public function __construct($classe, $metodo)
    {
        $this->classe = $classe;
        $this->metodo = $metodo;
    }

    public function executar($id = null)
    {
        $obj = new $this->classe();
        if ($id) {
            $obj->{$this->metodo}($id);
        } else {
            $obj->{$this->metodo}();
        }
    }
}
