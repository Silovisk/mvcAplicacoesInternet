<?php

namespace generic;

class View
{
    private function cabecalho()
    {
        // return include ROOT_PATH.'\public\cabecalho.php';
    }

    private function rodape()
    {
        // return include ROOT_PATH.'\public\rodape.php';
    }

    public function conteudo($caminho, $param = [], $script = '')
    {
        echo $this->cabecalho();
        include $caminho;
        echo $this->rodape();
        echo $script;
    }
}
