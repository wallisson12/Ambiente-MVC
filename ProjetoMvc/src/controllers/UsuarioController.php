<?php

namespace src\controllers;

use Exception;
use InvalidArgumentException;
use Model\Usuario\Usuario;
use DAOFactory;
use Model\Usuario\UsuarioDAO;
use src\config\DataBase;
use UsuarioFilters;
use UsuarioService;
use View;

require_once 'src/config/DataBase.php';
require_once 'src/Model/Usuario/Usuario.php';
require_once 'src/Model/Usuario/UsuarioFilters.php';
require_once 'src/Services/UsuarioService.php';
require_once 'src/Utils/CarregarViews/View.php';

/**
 * Classe UsuariosController
 */
class UsuarioController {

    private $oUsuarioService;

    /**
     * Construtor
     */
    public function __construct()
    {
        $this->oUsuarioService = new UsuarioService(
            DAOFactory::getDAOFactory()->getUsuarioDAO()
        );
    }

    /**
     * Carrega a view de cadastro usuario
     * 
     * @param array $aDados
     */
    public function indexCadastrar(array $aDados = []) : void {
        $oView = new View(__DIR__ .'/../public/view/usuario/CadastroUsuarios.php');
        $oView->render();
    }

    /**
     * Carrega a view de listagem usuarios
     * 
     * @param array $aDados
     */
    public function indexListar(array $aDados = []) : void {
        $oView = new View(__DIR__ .'/../public/view/usuario/ListaUsuarios.php');
        $oView->render();
    }

    /**
     * Carrega a view de editar usuario ja com os dados do usuario
     */
    public function editar(array $aDados = []){
        try{
            $oUsuario = $this->oUsuarioService->editarUsuario($aDados);
            $oView = new View("src/public/view/usuario/EditarUsuario.php");
            $oView->adicionarDado("oUsuario",$oUsuario);
            $oView->render();
        }catch(Exception $oException){
            $oException->getMessage();
            header('Location: /home/indexListar');
            exit();
        }
    }

    /**
     * Metodo responsavel por cadastrar um usuario
     * 
     * @param array $aDados
     */
    public function cadastar(array $aDados = []): void {
        try{
            if(isset($aDados['cadastrarUsuario'])){
                $this->oUsuarioService->cadastrarNovoUsuario($aDados);
                header('Location: /usuario/indexCadastrar');
            }else{
                header('Location: /home/index');
                exit();
            }
        }catch(Exception $e){
            $e->getMessage();
            header('Location: /home/index');
        }
    }

    /**
     * Responsavel por listar os usuarios por requisicao ajax
     * 
     * @param array $aDados
     */
    public function listarAjax(array $aDados = []){
        try {
            $oUsuarioFilters = UsuarioFilters::creatFromArray($aDados);
            $aUsuarios = DAOFactory::getDAOFactory()->getUsuarioDAO()->findByFilters($oUsuarioFilters);
            echo json_encode($aUsuarios);
         } catch (Exception $oException) {
            echo json_encode([
                "error" => true,
                "message" => $oException->getMessage()
            ]);
            header('Location: /home/indexListar');
            exit;
        }
    }

    /**
     * Responsavel por atualizar um cadastro
     * 
     * @param array $aDados
     */
    public function atualizar(array $aDados = []): void {
        try{
            $this->oUsuarioService->atualizarCadastroUsuario($aDados);    
            header('Location: /usuario/indexListar');
        }catch(Exception $oException){
            $oException->getMessage();
            header('Location: /home/indexListar');
            exit();
        }
    }

    /**
     * Responsavel por apagar um usuario
     * 
     * @param array $aDados
     * @return void
     */
    public function deletar(array $aDados = []) : void {
        try{
            $this->oUsuarioService->deletarCadastroUsuario($aDados);
            header('Location: /usuario/indexListar');
        }catch(Exception $oException){
            $oException->getMessage();
            header('Location: /home/indexListar');
            exit();
        }

    }
}