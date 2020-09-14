<?php 
	
	use \Firebase\JWT\JWT;

	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);


	require("./models/usuarios_model.php");

	init();

	function init(){

		$key = "p&ZGmFYvJA!~sf2&";

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

	function getUsuarios(){
		$usuarios = getUsuariosDB();

		echo json_encode($usuarios);
	}

	function crearUsuario()
	{	
		if (CorreoRegistrado($_POST['correo'])) {
			
			$response = array('ok' => false,'message' => "Correo Ingresado Ya Se Encuentra Registrado" );

			echo json_encode($response);

			http_response_code(422);
		}
		elseif(CedulaRegistrada($_POST['cedula'])){

			$response = array('ok' => false,'message' => "Cedula Ingresada Ya Se Encuentra Registrada" );

			echo json_encode($response);

			http_response_code(422);

		}
		else {

			CrearUsuarioDB($_POST['nombres'],$_POST['apellidos'],$_POST['cedula'],$_POST['correo'],$_POST['telefono']);

			$response = array('ok' => true, 'message' => "El Usuario a Sido Creado Correctamente" );

			echo json_encode($response);

		}
	}
	function ActualizarUsuario()
	{
		if (CorreoRegistradoButUser($_POST['correo'],$_POST['id'])) {
			
			$response = array('ok' => false,'message' => "Correo Ingresado Ya Se Encuentra Registrado" );

			echo json_encode($response);

			http_response_code(422);
		}
		elseif(CedulaRegistradaButUser($_POST['cedula'],$_POST['id'])){

			$response = array('ok' => false,'message' => "Cedula Ingresada Ya Se Encuentra Registrada" );

			echo json_encode($response);

			http_response_code(422);

		}
		else {

			ActualizarUsuarioDB($_POST['nombres'],$_POST['apellidos'],$_POST['cedula'],$_POST['correo'],$_POST['telefono'],$_POST['id']);

			$response = array('ok' => true, 'message' => "El Usuario a Sido Creado Correctamente" );

			echo json_encode($response);

		}


		
	}
	function DeleteUsuario()
	{
		DeleteUsuarioDB($_POST['id']);
	}

	function Login()
	{		
		$key = "p&ZGmFYvJA!~sf2&";

		$login = loginDB($_POST['email'],$_POST['password']);

		if($login){

			$time = time();

			$payload = array(
			    "id" => $login['id'],
			    "iat" => $time,
			    "exp" => $time + (60*10)
			);

			$jwt = JWT::encode($payload, $key);

			$response = array('ok' => true, 'data'=> $login, 'token' => $jwt );

			echo json_encode($response);

		} 
		else{

			$response = array('ok' => false,'message' => "Usuario o contraseña incorrecta" );

			echo json_encode($response);

			http_response_code(422);
		}
	}
 ?>