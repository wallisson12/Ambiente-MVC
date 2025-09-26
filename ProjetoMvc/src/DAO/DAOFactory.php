<?php

use Model\Usuario\UsuarioDAO;

require_once 'src/DAO/DAOFactoryInterface.php';

/**
 * Classe responsavel por instanciar os objetos
 */
class DAOFactory implements DAOFactoryInterface{

    private static $oInstance = null;
    private $oUsuarioDAO;

    /**
     * Retorna a instacia da classe
     */
    public static function getDAOFactory(): DAOFactory
    {
        if(empty(self::$oInstance)){
            self::$oInstance = new DAOFactory;
        }
        return self::$oInstance;
    }

    /**
     * Retorna a instancia de usuario DAO
     */
    public function getUsuarioDAO(): UsuarioDAO
    {
        if(empty($oUsuarioDAO)){
            $this->oUsuarioDAO = new UsuarioDAO;
        }
        return $this->oUsuarioDAO;
    }

}