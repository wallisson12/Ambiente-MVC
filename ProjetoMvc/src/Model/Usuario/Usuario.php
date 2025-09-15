<?php
namespace Model\Usuario;

use DAOFactory;
use Model\Usuario\UsuarioDAO;

require_once 'src/DAO/DAOFactory.php';
require_once 'src/Model/Usuario/UsuarioDAO.php';

/**
 * Classe da entidade usuario
 */
class Usuario{

    public $iIdUsuario;
    public $sUserName;
    public $iTipoUsuario;
    private $iStatus;

    public function __construct(string $sUserName,int $iTipoUsuario)
    {
        $this->sUserName = $sUserName;
        $this->iTipoUsuario = $iTipoUsuario;
        $this->iStatus = 1;
    }
  
    /**
     * Retorna o id do usuario
     * 
     * @return int
     */
    public function getId(): int {
        return $this->iIdUsuario;
    }
    
    /**
     * Retorna o nome do usuario
     * 
     * @return string
     */
    public function getNomeUsuario(): string {
        return $this->sUserName;
    }
    
    /**
     * Retorna o tipo de usuario
     * 
     * @return int
     */
    public function getTipoUsuario(): int {
        return $this->iTipoUsuario;
    }

    /**
     * Responsavel por cadastrar um usuario
     * 
     * @return void
     */
    public function cadastrar(): void {
        DAOFactory::getDAOFactory()->getUsuarioDAO()->cadastrar($this);
    }

    /**
     * Responsavel por criar um objeto usuario dado um array
     * 
     * @param array $aDados
     * @return Usuario
     */
    public static function createFromArray(array $aDados): Usuario{
        $oUsuario = new Usuario($aDados['nome'],(int)$aDados['tipoUsuario']);
        return $oUsuario;
    }
}