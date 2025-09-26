<?php

use Model\Usuario\UsuarioDAO;

interface DAOFactoryInterface{

    /**
     * Retorna a instancia de usuario DAO
     */
    public function getUsuarioDAO():UsuarioDAO;
}