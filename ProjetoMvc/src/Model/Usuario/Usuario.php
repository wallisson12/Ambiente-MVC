<?php
namespace Model\Usuario;

use BooleanEnum;
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
        $this->iStatus = BooleanEnum::SIM;
    }
  
    /**
     * Retorna o id do usuario
     * 
     * @return int
     */
    public function getId(): ?int {
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
     * Retorna o status do usuario
     * 
     * @return int
     */
    public function getStatusUsuario(): int{
        return $this->iStatus;
    }

    /**
     * Define o id do usuario
     * 
     * @param int null $iId
     */
    public function setId(?int $iId): void{
        $this->iIdUsuario = $iId;
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
     * Responsavel por atualizar um usuario
     * 
     * @return void
     */
    public function atualizar() : void {
        DAOFactory::getDAOFactory()->getUsuarioDAO()->atualizar($this);
    }

    /**
     * Responsavel por deletar logicamente um usuario
     * 
     * @return void
     */
    public function deletar(): void {
        DAOFactory::getDAOFactory()->getUsuarioDAO()->deletar($this->getId());
    }

    /**
     * Responsavel por criar um objeto usuario dado um array
     * 
     * @param array $aDados
     * @return Usuario
     */
    public static function createFromArray(array $aDados): Usuario{
        $oUsuario = new Usuario($aDados['username'],(int)$aDados['admin']);
        $oUsuario->setId($aDados['id']);
        return $oUsuario;
    }
}