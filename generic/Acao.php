<?php
namespace generic;
class Acao{
    private $classe;
    private $metodo;
    
    public function __construct($classe,$metodo){
        $this->classe=$classe;
        $this->metodo = $metodo;
    }

    public function executar(){
        $obj = new $this->classe();
        $obj->{$this->metodo}();
    }


}

?>