<?php 
	
	function getUsuariosDB(){

		$query = 'SELECT * FROM usuarios ORDER BY nombres ASC';

		$result = array();

		$consulta = query($query);



		while($row = mysqli_fetch_array($consulta))
		{

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
	function CrearUsuarioDB($nombres,$apellidos,$cedula,$correo,$telefono){

		$query = "INSERT INTO  `usuarios`(nombres,apellidos,cedula,correo,telefono) VALUES('".$nombres."', '".$apellidos."','".$cedula."','".$correo."','".$telefono."')";

		query($query); 

	}
	function ActualizarUsuarioDB($nombres,$apellidos,$cedula,$correo,$telefono,$id){

		$query = "UPDATE `usuarios` Set nombres='".$nombres."',apellidos='".$apellidos."',cedula='".$cedula."', correo='".$correo."',telefono='".$telefono."' where id='".$id."'";

		query($query);
	}
	function DeleteUsuarioDB($id)
	{
		$query = "DELETE FROM `usuarios` WHERE id = '".$id."'";

		query($query);
	}
	function loginDB($email,$password)
	{
		$query = "SELECT * from cuentas 
				  WHERE email = '".addcslashes($email,"W")."' 
				  AND password = '".md5($password)."'";


		$resultado = query($query);

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

	function CorreoRegistrado($correo){

		$query = "SELECT COUNT(id) as total
		FROM usuarios
		WHERE correo = '".$correo."'";


		$consulta= query($query);
		$total = 0;

		while($row = mysqli_fetch_array($consulta)){
			$total = $row['total'];
		}

		if ($total > 0) {
			return true;
		}
		else {
			return false;
		}
	}
	function CedulaRegistrada($cedula){


		$query = "SELECT COUNT(id) as total
		FROM usuarios
		WHERE cedula = '".$cedula."'";

		$consulta= query($query);
		$total = 0;

		while($row = mysqli_fetch_array($consulta)){

			$total = $row['total'];
		}

		if ($total > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	function CorreoRegistradoButUser($correo,$id){

		$query = "SELECT COUNT(id) as total
		FROM usuarios
		WHERE correo = '".$correo."'
		AND id != ".$id;


		$consulta= query($query);
		$total = 0;

		while($row = mysqli_fetch_array($consulta)){
			$total = $row['total'];
		}

		if ($total > 0) {
			return true;
		}
		else {
			return false;
		}
	}
	function CedulaRegistradaButUser($cedula,$id){


		$query = "SELECT COUNT(id) as total
		FROM usuarios
		WHERE cedula = '".$cedula."'
		AND id != ".$id;

		$consulta= query($query);
		$total = 0;

		while($row = mysqli_fetch_array($consulta)){

			$total = $row['total'];
		}

		if ($total > 0) {
			return true;
		}
		else {
			return false;
		}
	}

?>