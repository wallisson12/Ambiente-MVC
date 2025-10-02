<?php

namespace src\config;

//Uma forma de nao precisar passar o caminho
use src\controllers\HomeController;
use src\controllers\UsuarioController;

//Inclui o arquivo
require_once 'src/controllers/HomeController.php';
require_once 'src/controllers/UsuarioController.php';

$aDados = array_merge($_POST,$_GET);
routeToController($aDados);


/**
 * Metodo responsavel por fazer o roteamento
 * 
 * @param array $aDados (Merge das super globais $_POST, $_GET)
 */
function routeToController(array $aDados){
	//Acessa a variavel url da requisicao
	$aUrl = filter_input(INPUT_GET,'url',FILTER_DEFAULT);

	//Remove as tags html e php da variavel
	$aUrl = !empty($aUrl) ? strip_tags($aUrl) : '';

	$aUrl = !empty($aUrl) ? $aUrl : 'home/index' ;

	$aUrl = array_filter(explode('/',$aUrl));

	//Separa em Controller e Metodo	
	$sController = "src\\controllers\\" . ucfirst($aUrl[0]) . "Controller";

	$sMetodo = $aUrl[1];

	carregaControllerMetodo($sController,$sMetodo,$aDados);
}

/**
 * Metodo responsavel por chamar a classe e seu metodo
 * 
 * @param string $sController
 * @param string $sMetodo
 * @param array $aDados
 */
function carregaControllerMetodo(?string $sController, ?string $sMetodo,$aDados){
	if(class_exists($sController) && method_exists($sController,$sMetodo)){
		$oController = new $sController();
		$oController->$sMetodo($aDados);
		return;
	}
	
	$oController = new HomeController();
	$oController->index($aDados);
}

?>