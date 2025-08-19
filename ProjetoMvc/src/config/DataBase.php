<?php
namespace src\config;

use PDO;

require_once 'src/config/BaseDataBase.php';

class DataBase extends BaseDatabase
{
	private static ?DataBase $oInstance = null;
	private Pdo $oPDO;

	private function __construct(){
		parent::__construct();
		$sDns = 'mysql:'. http_build_query(parent::getConfig(),'',';');
		$this->oPDO = new Pdo($sDns);
	}

	/**
	 * Metodo responsavel por acessar a unica instancia para o banco de dados
	 * 
	 */
	public static function getInstance(): DataBase {
		if(self::$oInstance == null){
			self::$oInstance = new DataBase();
		}
		return self::$oInstance;
	}

	/**
	 * Metodo responsavel por executar a query no banco
	 * 
	 * @param string $sSql
	 */
	public function query(string $sSql) : array {
		$oStatement = $this->oPDO->prepare($sSql);
		$oStatement->execute();
		return $oStatement->fetchAll(PDO::FETCH_ASSOC);
	}

}