<?php 
	
if (!isset($_POST['pk'])) exit('no se recibio el POST');
	
	 $login=new Cuenta(new Connexion);
    $login->setpkcobropago($_POST['pk']);
    $login->setfkusuario($_SESSION['id']);
    $res=$login->getAllById();

    if (mysqli_num_rows($res)==null) {
        exit('No existen Datos');
    }

	function deletes()
	{
		$login=new Cuenta(new Connexion);
    	$login->setpkcobropago($_POST['pk']);
		
		$login->delete();
		

	}

	echo deletes();
 ?>