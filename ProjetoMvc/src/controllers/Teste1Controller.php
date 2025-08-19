<?php
namespace src\controllers;

class Teste1Controller{

    /**
     * Metodo responsavel por carregar a index da view teste1
     * 
     * @param array $aDados
     * 
     */
    public function index(array $aDados = []){
        include_once __DIR__.'/../public/view/teste1/teste1.php';
    }

}

?>