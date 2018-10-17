<?php 
	
if (!isset($_POST['id'])) exit('No se Recibio POST');

	function update()
	{	

		$cuenta=new Cuenta(new Connexion);
		$cuenta->setpkcobropago($_POST['id']);
		$cuenta->setnombre($_POST['nombre']);
		$cuenta->setmonto($_POST['monto']);
		$cuenta->setcomentario($_POST['comentario']);
		$cuenta->settype($_POST['tipo']);

		return $cuenta->update();

		

	}

	echo update();
 ?>