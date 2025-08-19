<?php

namespace src\controllers;

class Teste2Controller{

    /**
     * Metodo responsavel por carregar a index de view de teste2
     * 
     * @param array $aDados
     */
    public function index(array $aDados=[]){
        include_once __DIR__.'/../public/view/teste2/teste2.php';
    }
}

?>