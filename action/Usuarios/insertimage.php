<?php 
	

	function insertUsuario()
	{	
		$nombre = $_POST['txt_name'];
		$email = $_POST['email'];
		$pasword=$_POST['pasword'];


			$imagenBinaria = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

   		 $login=new Usuario(new Connexion);
		$login->setnombre($nombre);
		$login->setemail($email);
		$login->setpasword($pasword);
		$login->setimagen($imagenBinaria);

		return $login->insert();
	
}


	echo insertUsuario();
 ?>