<?php
class DataBase
{
	private static ?DataBase $oInstance = null;
	private Pdo $oPDO;
	private function __construct(){
		$this->oPDO = new Pdo('mysql:host=db;dbname=banco_teste', 'user', 'password');
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