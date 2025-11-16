<?php

/*
 * Entidade FIltro Uusario 
 */
class UsuarioFilters{

    /** @var int iIdUsuario */
    private $iIdUsuario;

    /** @var string sNomeUsuario */
    private $sUserName;

    /** @var int iTipoUsuario */
    private $iTipoUsuario;

    /** @var int iStatusUsuario*/
    private $iStatusUsuario;


    /**
     * Retorna o Id do usuario
     */
    public function getIdUsuario(): int {
        return $this->iIdUsuario;
    }

    /**
     * Retorna o Nome do usuario
     */
    public function getNomeUsuario(): string {
        return $this->sUserName;
    }

    /**
     * Retorna o Tipo de usuario
     */
    public function getTipoUsuario() : int {
        return $this->iTipoUsuario;
    }   

    /**
     * Retorna o status do usuario
     */
    public function getStatusUsuario() : int {
        return $this->iStatusUsuario;
    }

    /**
     * Responsavel por criar uma instacia de usuario filters atraves do array passado
     */
    public static function creatFromArray(array $aDados) : UsuarioFilters{
      $oUsuarioFilters = new UsuarioFilters();
      return $oUsuarioFilters;  
    }
    
}