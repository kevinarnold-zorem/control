<?php 
	
if (!isset($_POST['id'])) exit('No se Recibio POST');

	function updateUsuario()
	{	

		$login=new Usuario(new Connexion);
		$login->setpkusuario($_POST['id']);
		$login->setnombre($_POST['nombre']);
		$login->setpasword($_POST['pasword']);
		$login->setemail($_POST['correo']);

		return $login->update2();

		

	}

	echo updateUsuario();
 ?>