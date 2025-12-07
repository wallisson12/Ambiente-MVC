<?php 

/**
 * Realiza o controle do login
 */
class LoginController{


    /**
     * Carrega a view de login
     */
    public function index(array $aDados = []){
        $oView = new View(__DIR__."/../public/view/login/login.php");
        $oView->render();
    }
    
}