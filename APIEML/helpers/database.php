<?php 

	/*
		HELPER DE BASE DE DATOS
	*/

	// Importa la configuración de la base de datos
	require('./config/database.php');

	// Función que ejecuta los queries y devuelve el resultado
	function query($consulta){
		$conexion = getConnection();

		$result = $conexion->query($consulta);

		if(!$result)
		{
			$response = array( 'ok' => false, 'error' => $conexion->error );
			echo json_encode($response);
			http_response_code(500);
			closeConnection($conexion);
			die();
		}

		closeConnection($conexion);

		return $result;
	}

	// Función para obtener la conexión a la base de datos
	function getConnection(){
		global $config;

		@ $conexion = new mysqli($config['hostname'],$config['user'],$config['password'],$config['database']);
		if ($conexion->connect_error)
		die('Error de Conexion ('.$conexion->connect_errno.')'.$conexion->connect_error);

		return $conexion;
	}

	// Función para cerrar la conexión de la base de datos
	function closeConnection($conexion){
		mysqli_close($conexion);
	}


 ?>