<?php 
	
if (empty($_POST['monto'])) exit('No se recibio POST');
	
function insert()
	{

    $mensualidad=new Mensualidad(new Connexion);
    $mensualidad->setnombre($_POST['nombre']);
    $mensualidad->setfkusuario($_SESSION['id']);
    $mensualidad=$mensualidad->getAllByName();

   if ($mensualidad) {
			exit('EL NOMBRE DIGITADO YA ESTA REGISTRADO - ELIMINE PARA USARLO NUEVAMENTE');
	}
	
  	  $cuenta=new Mensualidad(new Connexion);
		$cuenta->setnombre($_POST['nombre']);
		$cuenta->setmonto($_POST['monto']);
		$cuenta->setcomentario($_POST['comentario']);
		$cuenta->setfechapagomes($_POST['fecha_pago']);
		$cuenta->setaudanulado($_POST['anulado']);
		$cuenta->setfkusuario($_SESSION['id']);

		return $cuenta->insert();

	}

	echo insert();
 ?>