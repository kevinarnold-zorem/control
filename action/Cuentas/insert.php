<?php 
	
if (empty($_POST['monto'])) exit('No se recibio POST');

	function insertUsuario()
	{
  	  $cuenta=new Cuenta(new Connexion);
		$cuenta->setnombre($_POST['nombre']);
		$cuenta->setmonto($_POST['monto']);
		$cuenta->setcomentario($_POST['comentario']);
		$cuenta->settype($_POST['tipo']);
		$cuenta->setstatus('activo');
		$cuenta->setfkusuario($_SESSION['id']);

		return $cuenta->insert();

	}

	echo insertUsuario();
 ?>