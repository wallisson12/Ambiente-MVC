<?php

/**
 * Classe responsavel por centralizar a logica de renderizacao de views
 */
class View{

    /* @var array $aDados */
    private $aDados;

    /* @var string $sViewPatch */
    private $sViewPatch;


    /**
     * Construtor
     */
    public function __construct(string $sPatch)
    {
        if(!file_exists($sPatch)){
            throw new Exception("Caminho para o arquivo não encontrado:{$sPatch}");
        }
        $this->sViewPatch = $sPatch;
    }


    /**
     * Responsavel por adicionar os dados que vao ser acessiveis na view, em um array associativo
     * 
     * @var $chave
     * @var $valor
     * @return self
     */
    public function adicionarDado($chave,$valor) : self {
        $this->aDados[$chave] = $valor;
        return $this;
    }


    /**
     * Responsavel por renderizar a view e injetar os dados que vao ser utilizados
     */
    public function render() : void {
        if(!empty($this->aDados)){
            extract($this->aDados);
        }
        
        ob_start();

        include $this->sViewPatch;
        
        $output = ob_get_clean();
        echo $output;
    }

}