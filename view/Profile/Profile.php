<?php 
	
    $cliente=new Usuario(new Connexion);
    $cliente->setpkusuario($_SESSION['id']);
    $cliente=$cliente->getAllById();

    if (mysqli_num_rows($cliente)==null) {
   echo "<script> location.replace('index.php?view=Home'); </script>";
    exit;
    }

    $cliente=$cliente->fetch_array(MYSQLI_ASSOC);
 
 ?>
<div class="col-md-6">
	  					<div class="content-box-large">
			  				<div class="panel-heading">
					            <div class="panel-title">Perfil</div>
					          					        </div>
			  				<div class="panel-body">
			  					<form class="form-horizontal" role="form">
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Correo</label>
								    <div class="col-sm-10">
								      <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $cliente['email']; ?>">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
								    <div class="col-sm-10">
								      <input type="password" class="form-control" id="pasword" placeholder="Password">
								    </div>
								  </div>
								 
								  <div class="form-group">
								    <label class="col-sm-2 control-label">Nombre</label>
								    <div class="col-sm-10">
								    	<input type="text" class="form-control" id="txt_name" placeholder="Nombre" value="<?php echo $cliente['nombre']; ?>">
								    	<input type="hidden" id="id" value="<?php echo $_SESSION['id']; ?>">

								    </div>
								  </div>
								  <div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <button type="submit" class="btn btn-primary" id="profile_guardar">GUARDAR</button>
								    </div>
								  </div>
								</form>
			  				</div>
			  			</div>