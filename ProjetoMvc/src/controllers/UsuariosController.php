<?php

namespace src\controllers;

use src\config\DataBase;
use Exception;

require_once 'src/config/DataBase.php';

/**
 * Classe UsuariosController
 */
class UsuariosController {

    /**
     * Metodo responsavel por retornar a view de cadastro usuario
     * 
     * @param array $aDados
     */
    public function indexCadastrar(array $aDados = []) : void{
        include_once __DIR__ . '/../public/view/usuarios/CadastroUsuarios.php';
    }

    /**
     * Metodo responsavel por retornar a view de lsitagem usuarios
     * 
     * @param array $aDados
     */
    public function indexListar(array $aDados = []) : void{
        include_once __DIR__ . '/../public/view/usuarios/ListaUsuarios.php';
    }

    /**
     * Metodo responsavel por cadastrar um usuario
     * 
     * @param array $aDados
     */
    public function cadastar(array $aDados = []){
        try{
            if(isset($aDados['cadastrarUsuario'])){
                $sNome = $aDados['nome'];
                $iTipoUsuario = (int)$aDados['tipoUsuario'];
                if(!empty($sNome) || !empty($iTipoUsuario)){
                    DataBase::getInstance()->salvaUsuario($sNome,$iTipoUsuario);
                    header('Location: /usuarios/indexCadastrar');
                    exit();
                }
            }

            header('Location: /home/index');

        }catch(Exception $e){
            $e->getMessage();
            header('Location: /home/index');
        }
    }

    public function listar(array $aDados = []){

    }

    public function deletar() : void{

    }
}