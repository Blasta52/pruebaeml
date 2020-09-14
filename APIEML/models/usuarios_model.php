<?php 
	
	/*
		MODELO DE USUARIOS
	*/

	// Consulta los usuarios en la DB
	function getUsuariosDB(){

		$query = 'SELECT * FROM usuarios ORDER BY nombres ASC';

		$result = array();

		$consulta = query($query);

		// Recorre las filas consultadas
		while($row = mysqli_fetch_array($consulta))
		{
			// Se crea una arreglo para responder los datos y se guardan en la variable result
			$user = array(
					
					'id' => $row['id'],
					'nombres' => $row['nombres'],
					'apellidos' => $row['apellidos'],
					'cedula' => $row['cedula'],
					'correo' => $row['correo'],
					'telefono' => $row['telefono'],
					'fecha_de_registro' => $row['fecha_de_registro'],
					'fecha_de_modificacion' => $row['fecha_de_modificacion']
				);
			
			$result[] = $user;

		}

		return $result;
	}
	// Crea un usuario en la DB
	function CrearUsuarioDB($nombres,$apellidos,$cedula,$correo,$telefono){

		// Variable que contiene el query a ejecutar
		$query = "INSERT INTO  `usuarios`(nombres,apellidos,cedula,correo,telefono) VALUES('".$nombres."', '".$apellidos."','".$cedula."','".$correo."','".$telefono."')";

		// Ejecuta el query en la base de datos
		query($query); 

	}
	// Actualiza un usuario en la DB
	function ActualizarUsuarioDB($nombres,$apellidos,$cedula,$correo,$telefono,$id){

		// Variable que contiene el query a ejecutar
		$query = "UPDATE `usuarios` Set nombres='".$nombres."',apellidos='".$apellidos."',cedula='".$cedula."', correo='".$correo."',telefono='".$telefono."' where id='".$id."'";

		// Ejecuta el query en la base de datos
		query($query);
	}
	// Elimina un usuario en la DB
	function DeleteUsuarioDB($id)
	{
		// Variable que contiene el query a ejecutar
		$query = "DELETE FROM `usuarios` WHERE id = '".$id."'";

		// Ejecuta el query en la base de datos
		query($query);
	}
	// Consulta un usuario por su email y contraseña
	function loginDB($email,$password)
	{
		// Variable que contiene el query a ejecutar
		$query = "SELECT * from cuentas 
				  WHERE email = '".addcslashes($email,"W")."' 
				  AND password = '".md5($password)."'";


		// Ejecuta el query en la base de datos y se guarda el reusltado en la variable $resultado
		$resultado = query($query);

		// Se valida si el usuario existió si no se retorna un false
		if($resultado->num_rows > 0)
		{
			while($row = mysqli_fetch_array($resultado))
			{	
				$user = array(
					'email' => $row['email'],
					'fullname' => $row['fullname'],
					'id' => $row['id']
				);

				return $user;
			}
		}

		return false;
	}
	// Consulta si un correo se encuentra registrado
	function CorreoRegistrado($correo){

		// Variable que contiene el query a ejecutar
		$query = "SELECT COUNT(id) as total
		FROM usuarios
		WHERE correo = '".$correo."'";


		// Ejecuta el query en la base de datos y se guarda el reusltado en la variable $consulta
		$consulta= query($query);
		$total = 0;

		while($row = mysqli_fetch_array($consulta)){
			$total = $row['total'];
		}

		// Valida el total y repsonde true o false
		if ($total > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	// Valida si una cedula se encuentra refistrada
	function CedulaRegistrada($cedula){

		// Variable que contiene el query a ejecutar
		$query = "SELECT COUNT(id) as total
		FROM usuarios
		WHERE cedula = '".$cedula."'";

		// Ejecuta el query en la base de datos y se guarda el reusltado en la variable $consulta
		$consulta= query($query);
		$total = 0;

		while($row = mysqli_fetch_array($consulta)){

			$total = $row['total'];
		}

		// Valida el total y repsonde true o false
		if ($total > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	function CorreoRegistradoButUser($correo,$id){

		// Variable que contiene el query a ejecutar
		$query = "SELECT COUNT(id) as total
		FROM usuarios
		WHERE correo = '".$correo."'
		AND id != ".$id;


		// Ejecuta el query en la base de datos y se guarda el reusltado en la variable $consulta
		$consulta= query($query);
		$total = 0;

		while($row = mysqli_fetch_array($consulta)){
			$total = $row['total'];
		}

		// Valida el total y repsonde true o false
		if ($total > 0) {
			return true;
		}
		else {
			return false;
		}
	}
	function CedulaRegistradaButUser($cedula,$id){


		// Variable que contiene el query a ejecutar
		$query = "SELECT COUNT(id) as total
		FROM usuarios
		WHERE cedula = '".$cedula."'
		AND id != ".$id;

		// Ejecuta el query en la base de datos y se guarda el reusltado en la variable $consulta
		$consulta= query($query);
		$total = 0;

		while($row = mysqli_fetch_array($consulta)){

			$total = $row['total'];
		}

		// Valida el total y repsonde true o false
		if ($total > 0) {
			return true;
		}
		else {
			return false;
		}
	}

?>