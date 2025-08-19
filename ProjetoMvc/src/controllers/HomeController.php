<?php
namespace src\controllers;

class HomeController
{
	/**
	 * Metodo responsavel por carregar a pagina home
	 */
	public function index($aDados = []){
		include __DIR__.'../../public/view/home/home.php';
	}
}