<?php
require_once "BaseDataBase.php";
class DataBase extends BaseDatabase
{
	private static ?DataBase $oInstance = null;
	private Pdo $oPDO;

	private function __construct(){
		parent::__construct();
		$sDns = 'mysql:'. http_build_query(parent::getConfig(),'',';');
		$this->oPDO = new Pdo($sDns);
	}
	
	public static function getInstance(): DataBase {
		if(self::$oInstance == null){
			self::$oInstance = new DataBase();
		}
		return self::$oInstance;
	}

	public function query(string $sSql) : array {
		$oStatement = $this->oPDO->prepare($sSql);
		$oStatement->execute();
		return $oStatement->fetchAll(PDO::FETCH_ASSOC);
	}

}