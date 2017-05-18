<?php
	namespace Blog;

	const ROOT = __DIR__;

	$autoloaderClass   = ROOT.'/Components/Autoloader.php';
	include_once($autoloaderClass);

	spl_autoload_register(
		function($className)
		{
			$Autoloader  = new Components\Autoloader($className);			
			$Autoloader->load();
		}
	);

	function pre($var)
	{
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
	/*
	* Testing router
	*
	*

	try {
		$router = new FrontController\FFC\Router();
		pre($router->run());
		$router->run();

	} catch (\Exception $e) {
		echo $e->getMessage();
	}
	/**/


	/*
	* Testing SMART router
	*
	*/

	try {
		$router = new FrontController\SFC\Router();
		pre($router->run());
		$router->run();

	} catch (\Exception $e) {
		echo $e->getMessage();
	}
	/**/
