<?php

use Model\Usuario\UsuarioDAO;

interface DAOFactoryInterface{

    public function getUsuarioDAO():UsuarioDAO;
}