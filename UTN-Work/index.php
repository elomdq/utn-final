<?php
 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require 'FPDF/fpdf.php';
	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;

	use Config\SystemFunctions as SystemFunctions;
	use Controllers\ViewController as ViewController;
		
	Autoload::start();

	session_start(); //cambiar ubicacion a donde se use

	Router::Route(new Request());
?>