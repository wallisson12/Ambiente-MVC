<?php

use Model\Usuario\UsuarioDAO;

require_once 'src/DAO/DAOFactoryInterface.php';

class DAOFactory implements DAOFactoryInterface{

    private static $oInstance = null;
    private $oUsuarioDAO;

    public static function getDAOFactory(): DAOFactory
    {
        if(empty(self::$oInstance)){
            self::$oInstance = new DAOFactory;
        }
        return self::$oInstance;
    }

    public function getUsuarioDAO(): UsuarioDAO
    {
        if(empty($oUsuarioDAO)){
            $this->oUsuarioDAO = new UsuarioDAO;
        }
        return $this->oUsuarioDAO;
    }

}