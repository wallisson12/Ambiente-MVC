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
	 *
	 * @param string $sSql query sql
	 * @param array $aParams array onde pode ou nao ter parametros do sql
	 * @return void
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
	 * Responsavel por realizar consultas no banco de dados
	 *
	 * @param string $sSql query sql
	 * @param array $aParams array onde pode ou nao ter parametros do sql
	 * @return array
	 *
	 */
	public function query(string $sSql, array $aParams = []): array {
		try {
			$PDOStatement = $this->oPDO->prepare($sSql);

			if (!empty($aParams)) {
				foreach ($aParams as $sKey => $sValue) {
					$PDOStatement->bindValue($sKey + 1, $sValue, is_int($sValue) ? PDO::PARAM_INT : PDO::PARAM_STR);
				}
			}

			$PDOStatement->execute();
			return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $oException) {
			echo $oException->getMessage();
			return [];
		}

	}

}