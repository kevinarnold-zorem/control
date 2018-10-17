<?php 
	if(isset($_POST['txt_email']) && isset($_POST['txt_password']))
	{	
		 $usuario= $_POST['txt_email']??'';
        $password=$_POST['txt_password']??'';
        if (empty($usuario) or empty($password))
        {
           header('location: index.php?message=Usuario o contraseña no introducidos');
           
        }
        $login=new Login(new Connexion);
        $login->setemail($usuario);
        $login->setpasword($password);
        $row=$login->signIn();
        
        if ($row){
            $session=new Session();
            $session->addValue('id',$row['pk_usuario']);
            $session->addValue('name',$row['nombre']);
            $session->addValue('email',$row['email']);
            header("location: index.php");

        }
        else {
          header('location: index.php?message=Usuario o Contraseña Incorrectos&types=WarningMessage');
        }
	
	}

 ?>