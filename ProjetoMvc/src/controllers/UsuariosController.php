<?php

namespace src\controllers;

use Exception;
use InvalidArgumentException;
use Model\Usuario\Usuario;
use DAOFactory;
use UsuarioFilters;

require_once 'src/config/DataBase.php';
require_once 'src/Model/Usuario/Usuario.php';
require_once 'src/Model/Usuario/UsuarioFilters.php';

/**
 * Classe UsuariosController
 */
class UsuariosController {

    /**
     * Carrega a view de cadastro usuario
     * 
     * @param array $aDados
     */
    public function indexCadastrar(array $aDados = []) : void {
        include_once __DIR__ . '/../public/view/usuarios/CadastroUsuarios.php';
    }

    /**
     * Carrega a view de listagem usuarios
     * 
     * @param array $aDados
     */
    public function indexListar(array $aDados = []) : void {
        include_once __DIR__ . '/../public/view/usuarios/ListaUsuarios.php';
    }

    /**
     * Carrega a view de editar usuario
     */
    public function indexAtualizar(array $aDados = []){
        include_once __DIR__ . '/../public/view/usuarios/EditarUsuarios.php';
    }

    /**
     * Metodo responsavel por cadastrar um usuario
     * 
     * @param array $aDados
     */
    public function cadastar(array $aDados = []): void {
        try{
            if(isset($aDados['cadastrarUsuario'])){
                $this->validarCadastro($aDados);
                $oUsuario = Usuario::createFromArray($aDados);
                $oUsuario->cadastrar();
                header('Location: /usuarios/indexCadastrar');
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
     */
    public function atualizar(): void {
        try{

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
    public function deletar(array $aDados = []) : void{
        try{
            $this->validarDeletar($aDados);
            $oUsuario = Usuario::createFromArray($aDados);
            $oUsuario->deletar();
            header('Location: /home/indexListar');
        }catch(Exception $oException){
            $oException->getMessage();
            header('Location: /home/indexListar');
            exit();
        }

    }


//////////////Depois criar um service para encapsular a responsabilidade///////////////

    /**
     * Responsavel por realizar a validacao dos campos de cadastro
     * 
     * @param array $aDados
     * @return void
     */
    private function validarCadastro(array $aDados): void {
        if(empty($aDados['nome'])){
            throw new InvalidArgumentException("O nome é obrigatorio");
        }
        if(empty($aDados['tipoUsuario'])){
            throw new InvalidArgumentException("O tipo de usuario é obrigatorio");
        }
    }

    private function validarDeletar(array $aDados){
        if(empty($aDados['id'])){
            throw new InvalidArgumentException("O identificador não encontrado");
        }
    }
}