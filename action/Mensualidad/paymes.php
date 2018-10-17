<?php 
	
if (empty($_POST['txt_monto'])) exit('No se recibio POST');

	function insert()
	{
		$monto=$_POST['txt_monto'];

  		$date=strtotime($_POST['fecha_pago_mes']);
		$año=date("Y", $date);
		$mes=date("m", $date);

		$invoice=new Invoice(new Connexion);
		$invoice->setfkmensualidad($_POST['id']);
		$invoice->setfkusuario($_SESSION['id']);
		$getall=$invoice->validarmensualidad($mes,$año);
		if ($getall) {
			exit('EL PAGO DEL MES ELEGIDO YA SE REALIZO / VERIFIQUE SI FINALIZO');

		}

		$invoice=new Invoice(new Connexion);
		$invoice->setfkmensualidad($_POST['id']);
		$invoice->setfkusuario($_SESSION['id']);
		$getall=$invoice->validarmensualidad2($mes,$año);

		if ($getall) {

			//existe entonces modificar el credit y status
			$invoice=new Invoice(new Connexion);
			$invoice->setfkmensualidad($_POST['id']);
			$invoice->setfkusuario($_SESSION['id']);
			$res=$invoice->validarmensualidad_2($mes,$año);
			$res=$res->fetch_array(MYSQLI_ASSOC);
			$monto=$monto+$res['credit'];

			$balance=$_POST['monto_mensualidad']-$monto;

			if ($balance>0) {
				$status="debe";
			}
			else
			{
				$status="pagado";
				$monto=$_POST['monto_mensualidad'];
			}

			$invoice=new Invoice(new Connexion);
			$invoice->setfkmensualidad($_POST['id']);
			$invoice->setfkusuario($_SESSION['id']);
			$invoice->setcredit($monto);
			$invoice->setpkinvoice($res['pk_invoice']);

			
			$invoice->setstatus($status);
			$invoice->updateinvoice();
			$id=$res['pk_invoice'];


		}
		else
		{

		//fin de la verificacion de el invoice si hay mes que ya pago cambiando el monto por el restante
			//insertar 
		$invoice=new Invoice(new Connexion);
		$invoice->setfkmensualidad($_POST['id']);
		$invoice->setfkusuario($_SESSION['id']);
		$invoice->setfechapagomes($_POST['fecha_pago_mes']);
		$invoice->settotal($_POST['monto_mensualidad']);
		$invoice->setcredit($monto);

		$balance=$_POST['monto_mensualidad']-$monto;

		if ($balance>0) {
			$status="debe";
		}
		else
		{
			$status="pagado";
		}

		$invoice->setstatus($status);
		$id=$invoice->insertinvoice();

		}

		

//imagen
		$imagenBinaria="";
		if ($_FILES['imagen']['error'] === 4) {
			# code...
		}
		else
		{
			$imagenBinaria = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
		}

		
	
		//transaccion
		$transaccion=new Transaccion(new Connexion);
		$transaccion->setiid($id);
		$transaccion->settabla('invoice');
		$transaccion->setmonto($_POST['txt_monto']);
		$transaccion->setcomentario($_POST['txt_comentario']);
		$transaccion->setfechapago($_POST['fecha_pago_mes']);
		$transaccion->setfkusuario($_SESSION['id']);
		$transaccion->setimagen($imagenBinaria);
		return $transaccion->insert();


	}

	echo insert();
 ?>