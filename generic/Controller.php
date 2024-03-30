<?php
namespace generic;

class Controller{
    private static $instancia;
    private $arrChamadas=[];
    
    private function __construct(){
        $this->arrChamadas = [
            "professores/lista" => new Acao("controller\ProfessorController","listarProfessores"),
        ];
    }

    public static function getInstance(){
        if(self::$instancia==null){
            self::$instancia = new Controller();

        }
        return self::$instancia;
    }

    public function verificarCaminho($rota){
        if(isset($this->arrChamadas[$rota])){
             $this->arrChamadas[$rota]->executar();
             return;
        }

            include "public/NaoExiste.php";
        

        
    }




}