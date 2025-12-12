<?php

namespace src\controllers;

use Model\Usuario\UsuarioDAO;
use Exception;
use InvalidArgumentException;
use Model\Usuario\Usuario;
use DAOFactory;
use View;
use UsuarioService;


require_once 'src/DAO/DAOFactory.php';
require_once 'src/Services/UsuarioService.php';
require_once 'src/Model/Usuario/UsuarioDAO.php';

/**
 * Realiza o controle do login
 */
class LoginController{

    /** @var UsuarioService $oUsuarioService **/
    private $oUsuarioService;

    /**
     * Construtor
     */
    public function __construct(){
        $this->oUsuarioService = new UsuarioService(DAOFactory::getDAOFactory()->getUsuarioDAO());
    }

    /**
     * Carrega a view de login
     */
    public function index(array $aDados = []) : void {
        $oView = new View(__DIR__."/../public/view/login/login.php");
        $oView->render();
    }

    /**
     * Realiza o login do usuario
     */
    public function logar(array $aDados = []) : void {
        try{
            if(empty($aDados['username']) || empty($aDados['senha'])){
                throw new InvalidArgumentException("Login ou senha inválido(s)");
            }
            $this->oUsuarioService->autenticarUsuario($aDados['username'],$aDados['senha']);
            header('Location: /home/index');
        }catch(Exception $oException){
            $oException->getMessage();
            header("Location: /login/index");
            exit();
        }
    }
    
}