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
		if(self::$oInstance == null){
			self::$oInstance = new DataBase();
		}
		return self::$oInstance;
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