<?php
    if(isset($_SESSION['email']) && $_SESSION['email']=="huamanip.soft2016@gmail.com"){

    }
    else
    {
          echo "<script> location.replace('index.php?view=Home'); </script>";
    }

 ?>
 
<?php 

    
    if (isset($_GET['id'])==null) {
    echo "<script> location.replace('index.php?view=Cliente'); </script>";
    exit;
    }

    $cliente=new Usuario(new Connexion);
    $cliente->setpkusuario($_GET['id']);
    $cliente=$cliente->getAllById();

    if (mysqli_num_rows($cliente)==null) {
   echo "<script> location.replace('index.php?view=Cliente'); </script>";
    exit;
    }

    $cliente=$cliente->fetch_array(MYSQLI_ASSOC);
 
 ?>
<div class="col-md-12">
              <div class="content-box-large">
                <div class="panel-heading">
                    <h2>Modificar Usuario</h2>
                   </div>

                   <div>
                            <div >
                                <div >
                                    <ol class="breadcrumb text-left">
                                        <li>
                                              <a href="?"><i class="fa fa-dashboard"></i> Dashboard</a>
                                        </li>
                                        <li class="active">
                                              <a href="./?view=Usuarios"><i class="fa fa-users"></i> Usuarios</a>
                                        </li>
                                        <li class="active">
                                              <a href="#"><i class="fa fa-asterisk"></i> Modificar Usuario</a>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>


                  <div class="content-box-large">

          <div class="panel-body">
                                
                <div class="panel-body">
                 <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Correo</label>
                    <div class="col-sm-10">
                      <input type="hidden" id="id" value="<?php echo $cliente['pk_usuario']; ?>"> 
                      <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $cliente['email']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="pasword" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                     <div class="col-sm-10">
                      <input type="text" class="form-control" id="txt_name" placeholder="Nombre" value="<?php echo $cliente['nombre']; ?>">
                    </div>
                  </div>
                 
                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Anulado</label>
                     <div class="col-sm-10">
                      <label class="switch switch-text switch-primary switch-pill"><input id="is_active" type="checkbox" class="switch-input" <?php if ($cliente['aud_anulado']=='true') echo "checked"?>> <span data-on="On" data-off="Off" class="switch-label"></span> <span class="switch-handle"></span></label>
                    </div>

                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" id="actualizar_usuario">GUARDAR</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          

          </div>
        </div>
                </div>
              </div>