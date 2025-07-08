<?php

abstract class BaseDataBase
{
	private array $aConfig;

	protected function __construct(){
		$this->aConfig = json_decode(file_get_contents(__DIR__.'/dataBaseConfig.json'),true);
	}

	protected function getConfig() : array {
		return $this->aConfig["dataBase"];
	}
}