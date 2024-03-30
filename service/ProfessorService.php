<?php
namespace service;

use dao\mysql\ProfessorDAO;

class ProfessorService extends ProfessorDAO{
    public function listar(){
       $retorno= parent::listar();
       return $retorno;
    }
}
?>