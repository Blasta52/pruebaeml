<?php  

	/*
		ARCHIVO INDEX DE RUTAS

		- Este archivo se encarga de manejar la ruta que consulta el cliente
	*/

	// Array para guardar las rutas
	$routes = array();
	// Ruta por defecto
	$routes['/'] = 'home/home';
	// Carga las rutas del módulo de usuarios
	require('usuarios.php');

	// Función que se encarga de manejar las rutas y llamar el controlador
	function routeHandler($url, $method){

		// Se define la variable global de rutas
		global $routes;

		// Se valida si es la ruta por defecto
		if($url == '/')
		{
			$route = $routes['/'];
			callControllerFunction($route);
		}
		else
		{
			// Valida y separa la ruta para llamar el controlador
			if (isset($routes[$method.'_'.$url])) 
			{	
				$route = $routes[$method.'_'.$url];
				callControllerFunction($route);
			}
			else
			{	
				http_response_code(404);
				require('./views/404.view.php');
			}
		}
	}

	// Llama el controlador de acuerdo a la ruta
	function callControllerFunction($route){

		$controller = explode('/', $route)[0];
		$func = explode('/', $route)[1];

		require('./controllers/'.$controller.'.php');
		$func();
	}
?>