<?php
namespace src\config;

use PDO;
use PDOException;

require_once 'src/config/BaseDataBase.php';

class DataBase extends BaseDatabase
{
	private static ?DataBase $oInstance = null;
	private Pdo $oPDO;

	private function __construct(){
		parent::__construct();
		$sDns = 'mysql:'. http_build_query(parent::getConfig(),'',';');
		$this->oPDO = new Pdo($sDns);

		//Configurando o pdo para exibir os errors
		$this->oPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

	/**
	 * Metodo responsavel por acessar a unica instancia para o banco de dados
	 * 
	 */
	public static function getInstance(): DataBase {
		if(empty(self::$oInstance)){
			self::$oInstance = new DataBase();
		}
		return self::$oInstance;
	}


	/**
	 * Responsavel por inserir e atualizar
	 * No array passar os valores dos paramentos da query que esta sendo realizada
	 * Percorrer o arry e colocar em cada '?' no sql o valor que esta no array
	 * Na parte de +1 esse mais 1, eh so para o bindvalue, mas o valor do array ja esta sendo passado na posicao certa
	 *
	 * @param string $sSql query sql
	 * @param array $aParams array onde pode ou nao ter parametros do sql
	 * @return void
	 * @author Wallisson De Jesus wallissondejesus@moobi.com.br
	 *
	 */
	public function execute(string $sSql, array $aParams = []): void {
		try {
			$PDOStatement = $this->oPDO->prepare($sSql);

			if (!empty($aParams)) {
				foreach ($aParams as $sKey => $sValue) {
					$PDOStatement->bindValue($sKey + 1, $sValue);
				}
			}

			$PDOStatement->execute();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * Metodo responsavel por executar a query para salvar um usuario
	 * 
	 * @param string $sSql
	 */
	public function salvaUsuario(string $sNome,int $iTipoUsuario): void {
		try{
			$sSql = "INSERT INTO users (username,admin) VALUES ('{$sNome}',{$iTipoUsuario})";
			$oStatement = $this->oPDO->prepare($sSql);
			$oStatement->execute();
		}catch(PDOException $e){		
			echo $e->getMessage();
			die();
		}
	}

}