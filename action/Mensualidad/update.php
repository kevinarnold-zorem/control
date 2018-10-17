<?php 
	
if (empty($_POST['monto'])) exit('No se recibio POST');

	function update()
	{
  	  $cuenta=new Mensualidad(new Connexion);
  	  $cuenta->setpkmensualidad($_POST['id']);
		$cuenta->setnombre($_POST['nombre']);
		$cuenta->setmonto($_POST['monto']);
		$cuenta->setcomentario($_POST['comentario']);
		$cuenta->setfechapagomes($_POST['fecha_pago']);
		$cuenta->setaudanulado($_POST['anulado']);
		$cuenta->setfkusuario($_SESSION['id']);

		return $cuenta->update();

	}

	echo update();
 ?>