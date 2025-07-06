<?php
require_once "DataBase.php";

$sUrl = parse_url($_SERVER['REQUEST_URI'])['path'];
$aRoutes = [
	'/' => 'src/public/view/home.php',
	'/teste1' => 'src/public/view/teste1.php',
	'/teste2' => 'src/public/view/teste2.php',
];

$sSql = "SELECT * FROM post";
$aDados = DataBase::getInstance()->query($sSql);
var_dump($aDados);

routeToController($sUrl, $aRoutes);

function routeToController($sUrl, $aRoutes){
	if(array_key_exists($sUrl, $aRoutes)){
		require $aRoutes[$sUrl];
		return;
	}

	require 'src/public/view/home.php';
}
?>