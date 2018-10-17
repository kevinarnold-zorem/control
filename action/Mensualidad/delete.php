<?php 
	function deletes()
	{

if (!isset($_POST['pk'])) exit('no se recibio el POST');
	
	 $login=new Mensualidad(new Connexion);
	 $login->setfkusuario($_SESSION['id']);
    $login->setpkmensualidad($_POST['pk']);
    $res=$login->getAllById();

    if (mysqli_num_rows($res)==null) {
        exit('No existen Datos');
    }

	
		$login=new Mensualidad(new Connexion);
		$login->setfkusuario($_SESSION['id']);
    	$login->setpkmensualidad($_POST['pk']);
		
		$login->delete();
		

	}

	echo deletes();
 ?>