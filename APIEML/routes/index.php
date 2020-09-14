<?php  
	$routes = array();
	$routes['/'] = 'home/home';
	
	require('usuarios.php');

	function routeHandler($url, $method){

		global $routes;

		if($url == '/')
		{
			$route = $routes['/'];
			callControllerFunction($route);
		}
		else
		{
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

	function callControllerFunction($route){

		$controller = explode('/', $route)[0];
		$func = explode('/', $route)[1];

		require('./controllers/'.$controller.'.php');
		$func();
	}
?>