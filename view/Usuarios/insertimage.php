<?php
    if(isset($_SESSION['email']) && $_SESSION['email']=="huamanip.soft2016@gmail.com"){

    }
    else
    {
          echo "<script> location.replace('index.php?view=Home'); </script>";
    }

 ?>
 <div class="col-md-12">
              <div class="content-box-large">
                <div class="panel-heading">
                    <h2>Nuevo Usuario</h2>
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
                                              <a href="#"><i class="fa fa-asterisk"></i> Nuevo Usuario</a>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>


                  <div class="content-box-large">

          <div class="panel-body">
                                
                <div class="panel-body">
          <form accept-charset="utf-8"  class="form-horizontal" method="POST" id="enviarimagenes" enctype="multipart/form-data" >
<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Correo</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control"  name="pasword" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                     <div class="col-sm-10">
                      <input type="text" class="form-control"  name="txt_name" placeholder="Nombre">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
                     <div class="col-sm-10">
                      <input type="file" name="imagen" id="imagen" />
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">GUARDAR</button>
                    </div>
                  </form>
              </div>
            </div>
          

          </div>
        </div>
                </div>
              </div>