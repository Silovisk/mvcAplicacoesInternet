<?php

namespace generic;

class Controller
{
    private static $instancia;
    private $arrChamadas = [];

    private function __construct()
    {
    
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
    public function addRoute($route, $action) {
        $this->arrChamadas[$route] = $action;
    }
}
