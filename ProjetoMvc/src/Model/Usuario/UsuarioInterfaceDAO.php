<?php
namespace Model\Usuario;

use Model\Usuario\Usuario;


interface UsuarioInterfaceDAO{

    public function findById(int $iId): Usuario;
    public function findByFilters(array $aDados): array;
    public function cadastrar(Usuario $oUsuario): void;
    public function atualizar(int $iId): void;
    public function deletar(int $iId): void;
}