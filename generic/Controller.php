<?php

namespace generic;

class Controller
{
    private static $instancia;
    private $arrChamadas = [];

    private function __construct()
    {
        $actions = ['index', 'create', 'store', 'update', 'destroy'];
        // $this->arrChamadas = [
        //         'produtos/index' => new Acao('controller\ProdutoController', 'index'),
        //         'produtos/create' => new Acao('controller\ProdutoController', 'create'),
        //         'produtos/store' => new Acao('controller\ProdutoController', 'store'),
        //         'produtos/destroy' => new Acao('controller\ProdutoController', 'destroy'),
        //         'produtos/edit' => new Acao('controller\ProdutoController', 'edit'),
        //         ];
        foreach ($actions as $action) {
            $this->arrChamadas["produtos/$action"] = new Acao('controller\ProdutoController', $action);
        }

        $this->arrChamadas['produtos/edit/:id'] = new Acao('controller\ProdutoController', 'edit');
    }

    public static function getInstance()
    {
        if (self::$instancia == null) {
            self::$instancia = new Controller();
        }

        return self::$instancia;
    }

    public function verificarCaminho($rota)
    {
        foreach ($this->arrChamadas as $pattern => $acao) {
            $pattern = str_replace(':id', '(\d+)', $pattern);
            if (preg_match('#^'.$pattern.'$#', $rota, $matches)) {
                array_shift($matches);
                call_user_func_array([$acao, 'executar'], $matches);

                return;
            }
        }

        include 'public/NaoExiste.php';
    }
}
