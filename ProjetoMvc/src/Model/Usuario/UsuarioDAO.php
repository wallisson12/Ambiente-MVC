<?php
namespace Model\Usuario;

use Model\Usuario\Usuario;
use PDOException;
use src\config\DataBase;
use Model\Usuario\UsuarioInterfaceDAO;

require_once 'src/Model/Usuario/UsuarioInterfaceDAO.php';

class UsuarioDAO implements UsuarioInterfaceDAO{
    
    public function findById(int $iId): Usuario {
        return new Usuario('a','i');
    }

    public function findByFilters(array $aDados): array {
        return [];
    }

    /**
     * Responsavel por realizr o cadastro de um usuario no banco
     * 
     * @param Usuario $oUsuario
     * @return void
     */
    public function cadastrar(Usuario $oUsuario): void {
        $sSql = "INSERT INTO users (usrusername,admin) VALUES (?,?)";
        $aParam = [$oUsuario->getNomeUsuario(),$oUsuario->getTipoUsuario()];

        try{
            DataBase::getInstance()->execute($sSql,$aParam);
        }catch(PDOException $e){
            throw new PDOException("Erro ao cadastrar um usuario: " . $e->getMessage());
        }
    }

    public function atualizar(int $iId): void {

    }


    /**
     * Responsavel por deletar um usuario do banco
     * 
     * @param int $iId
     * @return void 
     */
    public function deletar(int $iId): void {
        $sSql = "UPDATE users usr SET usr.status = ? WHERE usr.id = ?";
        $aParam = [2,$iId];
        
        try{
            DataBase::getInstance()->execute($sSql,$aParam);
        }catch(PDOException $e){
            throw new PDOException("Erro ao deletar um usuario: " . $e->getMessage());
        }
    }
}