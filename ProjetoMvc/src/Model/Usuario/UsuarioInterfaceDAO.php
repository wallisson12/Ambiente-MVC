<?php
namespace Model\Usuario;

use Model\Usuario\Usuario;
use UsuarioFilters;

/**
 * Interface de UsuarioDAO
 */
interface UsuarioInterfaceDAO{

    /**
     * Busca um usuario por Id passado
     * 
     * @param int $iId 
     */
    public function findById(int $iId): Usuario;


    /**
     * Busca varios usuarios por filtros passados
     * 
     * @param UsuarioFilters $oUsuarioFilters
     */
    public function findByFilters(UsuarioFilters $oUsuarioFilters): array;


    /**
     * Cadastra um usuario
     * 
     * @param Usuario $oUsuario
     */
    public function cadastrar(Usuario $oUsuario): void;


    /**
     * Atualiza um Usuario
     * 
     * @param Usuario $oUsuario   
     */
    public function atualizar(Usuario $oUsuario): void;

    /**
     * Deleta logicamente um usuario
     * 
     * @param int $iId
     */
    public function deletar(Usuario $oUsuario): void;
}