<?php 
	
if (empty($_POST['id'])) exit('No se recibio POST');

	function abonar()
	{	
		$tabla="cobro_pago";//digito el nombre de la tabla ya que se usa solo una tabla transaccion el id puede dar error al buscar 


		$cuenta=new Cuenta(new Connexion);
		$cuenta->setpkcobropago($_POST['id']);
		$cuenta->setfkusuario($_SESSION['id']);
		$cuenta=$cuenta->getAllById();
		if (mysqli_num_rows($cuenta)==null) {
        exit('No existe la Cuenta');
   		 }

    $cuenta=$cuenta->fetch_array(MYSQLI_ASSOC);
    $deposito=$cuenta['credit']+$_POST['monto'];

    $balance=$cuenta['monto']-$deposito;

		if ($balance>0) {
			$status="activo";
		}
		else
		{
			$status="finalizado";
		}

  	  $cuenta=new Cuenta(new Connexion);
		$cuenta->setcredit($deposito);
		$cuenta->setpkcobropago($_POST['id']);
		$cuenta->setstatus($status);
		$cuenta->setfkusuario($_SESSION['id']);

		$cuenta->updateAbonar();

		$transaccion=new Transaccion(new Connexion);
		$transaccion->setiid($_POST['id']);
		$transaccion->settabla($tabla);
		$transaccion->setmonto($_POST['monto']);
		if ($_POST['tipo']=="cobrar") {
			$transaccion->setingreso($_POST['monto']);
		}
		else
		{
			$transaccion->setsalida($_POST['monto']);
		}
		$transaccion->setcomentario($_POST['comentario']);
		$transaccion->setfechapago(date('Y-m-d'));
		$transaccion->setfkusuario($_SESSION['id']);

		return $transaccion->insert();


	}

	echo abonar();
 ?>