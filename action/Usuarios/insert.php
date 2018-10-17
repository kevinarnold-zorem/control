<?php 
	
if (empty($_POST['nombre'])) exit('No se recibio POST');

	function insertUsuario()
	{	


			  $login=new Usuario(new Connexion);
		$login->setnombre($_POST['nombre']);
		$login->setpasword($_POST['pasword']);
		$login->setemail($_POST['correo']);
		$login->setaudanulado($_POST['anulado']);

		return $login->insert();

	}

	echo insertUsuario();
 ?>