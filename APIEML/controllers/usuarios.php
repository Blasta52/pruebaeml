<?php 

	/*
		CONTROLADOR DE USUARIOS
	*/

	// Importar Librería JWT para utilizar el Token
	use \Firebase\JWT\JWT;

	// Muestra los errores de php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);

	// Incluye el modelo de usuarios
	require("./models/usuarios_model.php");

	// Función principal, se utilizar para validar el token
	init();

	function init(){

		// Llave para firmar el token
		$key = "p&ZGmFYvJA!~sf2&";

		// Validación del token JWT
		if($_GET['url'] != 'login')
		{
			if (!isset($_SERVER['HTTP_AUTHORIZATION']))
			{
				echo "No Token";
				http_response_code(401);
				die();
			}
			else
			{		
				try
				{	
				   	// Code that may throw an Exception or Error.
					$jwt = $_SERVER['HTTP_AUTHORIZATION'];

					$decoded = JWT::decode($jwt, $key, array('HS256'));

				}
				catch (Throwable $t)
				{	
					echo $t . ' Date: ' + strtotime(date('Y-m-d H:i:s'));
				   	// Executed only in PHP 7, will not match in PHP 5
					http_response_code(401);
					die();
				}
				
			}
		}
	}

	// Función que lista los usuarios
	function getUsuarios(){
		// Consulta los usuarios del modelo
		$usuarios = getUsuariosDB();

		// Retorna la información en formato JSON
		echo json_encode($usuarios);
	}

	function crearUsuario()
	{	
		// Consulta y valida si el correo ya está creado
		if (CorreoRegistrado($_POST['correo'])) {
			
			$response = array('ok' => false,'message' => "Correo Ingresado Ya Se Encuentra Registrado" );

			echo json_encode($response);

			http_response_code(422);
		}
		// Consulta y valida si la cédula ya está creada
		elseif(CedulaRegistrada($_POST['cedula'])){

			$response = array('ok' => false,'message' => "Cedula Ingresada Ya Se Encuentra Registrada" );

			echo json_encode($response);

			http_response_code(422);

		}
		// Si todo es correcto crea el usuario y genera la respuesta
		else {

			CrearUsuarioDB($_POST['nombres'],$_POST['apellidos'],$_POST['cedula'],$_POST['correo'],$_POST['telefono']);

			$response = array('ok' => true, 'message' => "El Usuario a Sido Creado Correctamente" );

			echo json_encode($response);

		}
	}

	// Función para actualizar un usuario
	function ActualizarUsuario()
	{
		// Consulta y valida si el correo ya está creado
		if (CorreoRegistradoButUser($_POST['correo'],$_POST['id'])) {
			
			$response = array('ok' => false,'message' => "Correo Ingresado Ya Se Encuentra Registrado" );

			echo json_encode($response);

			http_response_code(422);
		}
		// Consulta y valida si la cédula ya está creada
		elseif(CedulaRegistradaButUser($_POST['cedula'],$_POST['id'])){

			$response = array('ok' => false,'message' => "Cedula Ingresada Ya Se Encuentra Registrada" );

			echo json_encode($response);

			http_response_code(422);

		}
		// Si todo es correcto crea el usuario y genera la respuesta
		else {

			ActualizarUsuarioDB($_POST['nombres'],$_POST['apellidos'],$_POST['cedula'],$_POST['correo'],$_POST['telefono'],$_POST['id']);

			$response = array('ok' => true, 'message' => "El Usuario a Sido Creado Correctamente" );

			echo json_encode($response);

		}
	}

	// Función para eliminar un usuario
	function DeleteUsuario()
	{
		// Elimina el usuario en la bd
		DeleteUsuarioDB($_POST['id']);
	}

	// Función para crear la sesión del usuario
	function Login()
	{	
		// Palabra clave para firmar el token
		$key = "p&ZGmFYvJA!~sf2&";

		// Valida en la DB el usuario y la contraseña
		$login = loginDB($_POST['email'],$_POST['password']);

		if($login){

			// Obtiene el TIMESTAMP
			$time = time();

			// Arreglo con los datos del token
			$payload = array(
			    "id" => $login['id'],
			    "iat" => $time,
			    "exp" => $time + (60*10)
			);

			// Se crea el token JWT
			$jwt = JWT::encode($payload, $key);

			// Se crea el arreglo de respuesta
			$response = array('ok' => true, 'data'=> $login, 'token' => $jwt );

			// Se responde en formato json
			echo json_encode($response);

		} 
		else{

			// Si el usuario no existe responde error, con el status code 422
			$response = array('ok' => false,'message' => "Usuario o contraseña incorrecta" );

			echo json_encode($response);

			http_response_code(422);
		}
	}
 ?>