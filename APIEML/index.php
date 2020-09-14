<?php 
	
	/*

		INDEX.PHP
		- Archivo principal por donde ingresan los datos del usuario y se encarga de hacer el llamado al manejador de rutas
	
	*/

	// Se definen los headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Content-Type: application/json');

	// Se valida el método OPTIONS que es una petición lanzada por en navegador cuando los dominios son diferentes
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    	die();
    }

	// Se llama el autoload de composer
	require __DIR__ . '/vendor/autoload.php';
	// Se cargan las rutas 
	require('./routes/index.php');
	// Se cargan el helper de base de datos 
	require('./helpers/database.php');

	// Se valida la ruta configurada en el .htaccess
	$url = isset($_GET['url']) ? $_GET['url'] : '/';

	// Se llama la función que maneja las rutas y se envia la ruta y el método
	routeHandler($url, $_SERVER['REQUEST_METHOD']);

?>