<?php 

use Model\Usuario\Usuario;
use Model\Usuario\UsuarioDAO;
use Model\Usuario\UsuaarioFilters;

/**
 * Classe responsavel por centralizar as regras e 
 * realizar os testes e validacoes da entidade usuario
 */
class UsuarioService{

    /** @var UsuarioDAO $oUsuarioDAO*/
    private $oUsuarioDAO;

    /**
     * Construtor
     */
    public function __construct(UsuarioDAO $oUsuarioDAO)
    {
        $this->oUsuarioDAO = $oUsuarioDAO;     
    }

    /**
     * Responsavel por realizar o cadastro do usuario passando por validacao e regra de negocio
     * 
     * @param array $aDados
     * @return void
     */
    public function cadastrarNovoUsuario(array $aDados = []) : void {
        $this->validarDadosCadastroUsuario($aDados);
        $aDados['senha'] = password_hash($aDados['senha'],PASSWORD_DEFAULT);
        $oUsuario = Usuario::createFromArray($aDados);
        $oUsuario->cadastrar();
    }

    /**
     * Responsavel por realizar a edicao do usuario passando por validacao e regra de negocio 
     * 
     * @param array $aDados
     * @return void
     */
    public function editarUsuario(array $aDados = []) : Usuario {
        $this->validarAcaoEditarDeletarUsuario($aDados);
        $oUsuario = $this->oUsuarioDAO->findById($aDados['id']);
        return $oUsuario;
    }

    /**
     * Responsavel por realizar a atualizacao de um usuario passando por validacao e regra de negocio 
     * 
     * @param array $aDados
     * @return void
     */
    public function atualizarCadastroUsuario(array $aDados = []) : void {
        $this->validarAcaoEditarDeletarUsuario($aDados);
        if(empty($aDados['username'])){
            throw new InvalidArgumentException("O nome do usuario é obrigatorio");
        }
        if(empty($aDados['tipo_usuario'])){
            throw new InvalidArgumentException("O tipo de usuario é obrigatorio");
        }
        $oUsuario = Usuario::createFromArray($aDados);
        $oUsuario->atualizar();
    }

    /**
     * Responsavel por autenticar os dados de login
     * 
     * @param string $sUserName
     * @param string $sSenha
     */
    public function autenticarUsuario(string $sUserName, string $sSenha){
        $oUsuario = $this->oUsuarioDAO->findByUserName($sUserName);
        if(!password_verify($sSenha,$oUsuario->getSenhaCriptografada())){
            throw new InvalidArgumentException("Usuario ou Senha Inválidos!");
        }

        //Salva na sessao (Criar uma classe para ter essa responsabilidade de salvar e remover)
    }

    /**
     * Responsavel por realizar a listagem dos usuarios
     * 
     * @param UsuarioFilters $oUsuarioFilters
     * @return array
     */
    public function listarUsuarios(UsuarioFilters $oUsuarioFilter) : array {
        $aoUsuarios = $this->oUsuarioDAO->findByFilters($oUsuarioFilter);
        return $aoUsuarios;
    }

    /**
     * Responsavel por realizar a delecao logica de um usuario passando por validacao e regra de negocio 
     * 
     * @param array $aDados
     * @return void
     * 
     */
    public function deletarCadastroUsuario(array $aDados = []) : void {
        $this->validarAcaoEditarDeletarUsuario($aDados);
        $oUsuario = $this->oUsuarioDAO->findById($aDados['id']);
        $oUsuario->deletar();
    } 


     /**
     * Responsavel por realizar a validacao dos campos de cadastro
     * 
     * @param array $aDados
     * @return void
     */
    private function validarDadosCadastroUsuario(array $aDados = []) : void {
        if(!empty($aDados)){
            
            if(empty($aDados['username'])){
                throw new InvalidArgumentException("O nome é obrigatorio");  
            }

            if(empty($aDados['tipo_usuario'])){
                throw new InvalidArgumentException("O tipo de usuario é obrigatorio");
            }

            if(empty($aDados['senha'])){
                throw new InvalidArgumentException("A senha é obrigatoria");
            }

        }
    }


    /**
     * Responsavel por realizar validacao da edicao/delecao de um usuario
     * 
     * @param array $aDados
     * @return void
     */
    private function validarAcaoEditarDeletarUsuario(array $aDados = []) : void {
        if(!empty($aDados)){
            if(empty($aDados['id'])){
               throw new InvalidArgumentException("O identificador do usuario não foi encontrado");
            }
        }
    }

}