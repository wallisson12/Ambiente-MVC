<?php
namespace Model\Usuario;

use BooleanEnum;
use DAOFactory;
use Exception;
use Model\Usuario\Usuario;
use PDOException;
use src\config\DataBase;
use Model\Usuario\UsuarioInterfaceDAO;
use UsuarioFilters;

require_once 'src/Model/Usuario/UsuarioInterfaceDAO.php';
require_once 'src/Utils/Enums/BooleanEnum.php';

class UsuarioDAO implements UsuarioInterfaceDAO{
    
    /**
     * Busca um usuario por seu id
     * 
     * @param int $iId
     */
    public function findById(int $iId): Usuario {
        $sSql = "SELECT * FROM users usr WHERE usr.id = ?";
        $aParam = [$iId];

        try{
            $aaUsuario = DataBase::getInstance()->query($sSql,$aParam);
        }catch(PDOException $oException){
            throw new PDOException("Ocorreu um erro ao buscar um usuario com id: {$iId}");
        }

        if(empty($aaUsuario)){
            throw new Exception("Não existe nemhum usuario com esse id : {$iId}");
        }

        return Usuario::createFromArray($aaUsuario[0]);;
    }

    /**
     * Responsavel por retornar os usuarios baseado nos filtros passados
     * 
     * @var UsuarioFilters $oUsuarioFilters
     */
    public function findByFilters(UsuarioFilters $oUsuarioFilters): array {
        $sSql = "SELECT * FROM users usr 
                 Where usr.status = ? ORDER BY usr.username";

        $aParam = [BooleanEnum::SIM];

        try{
            $aaUsuarios = DataBase::getInstance()->query($sSql,$aParam);
        }catch(PDOException $oException){
            throw new PDOException("Erro ao buscar os usuarios: {$oException->getMessage()}");
        }

        $aUsuariosObj = [];
        foreach($aaUsuarios as $aUsuario){
            $oUsuario = Usuario::createFromArray($aUsuario);
            $aUsuariosObj[] = [
                    'id' => $oUsuario->getId(),
                    'username' => $oUsuario->getNomeUsuario(), 
                    'tipo_usuario' => $oUsuario->getTipoUsuario(),
                    'status' => $oUsuario->getStatusUsuario()
            ];
        }

        return $aUsuariosObj;
    }

    /**
     * Responsavel por realizr o cadastro de um usuario no banco
     * 
     * @param Usuario $oUsuario
     * @return void
     */
    public function cadastrar(Usuario $oUsuario): void {
        $sSql = "INSERT INTO users (username,senha,tipo_usuario,status) VALUES (?,?,?,?)";
        $aParam = [$oUsuario->getNomeUsuario(),'a',$oUsuario->getTipoUsuario(),$oUsuario->getStatusUsuario()];

        try{
            DataBase::getInstance()->execute($sSql,$aParam);
        }catch(PDOException $oException){
            throw new PDOException("Erro ao cadastrar um usuario: {$oException->getMessage()}");
        }
    }

    /**
     * Responsavel por atualiza um usuario
     * 
     * @param Usuario $oUsuario
     */
    public function atualizar(Usuario $oUsuario): void {
        $sSql = "UPDATE users usr
                 SET usr.username = ?, usr.tipo_usuario = ?
                 WHERE usr.id = ?";
        $aParam = [$oUsuario->getNomeUsuario(),$oUsuario->getTipoUsuario(),$oUsuario->getId()];

        try{
            DataBase::getInstance()->execute($sSql,$aParam);
        }catch(PDOException $oException) {
            throw new PDOException("Erro ao atualizar o usuario: {$oException->getMessage()}");
        }
    }


    /**
     * Responsavel por deletar um usuario do banco
     * 
     * @param int $iId
     * @return void 
     */
    public function deletar(Usuario $oUsuario): void {
        $sSql = "UPDATE users usr SET usr.status = ? WHERE usr.id = ?";
        $aParam = [BooleanEnum::NAO,$oUsuario->getId()];
        
        try{
            DataBase::getInstance()->execute($sSql,$aParam);
        }catch(PDOException $e){
            throw new PDOException("Erro ao deletar um usuario: " . $e->getMessage());
        }
    }
}