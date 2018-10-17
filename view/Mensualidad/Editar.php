<?php 

    
    if (isset($_GET['id'])==null) {
    echo "<script> location.replace('index.php?view=Cuentas&type=activa'); </script>";
    exit;
    }

    $cuenta=new Mensualidad(new Connexion);
    $cuenta->setpkmensualidad($_GET['id']);
    $cuenta->setfkusuario($_SESSION['id']);
    $cuenta=$cuenta->getAllById();

    if (mysqli_num_rows($cuenta)==null) {
   echo "<script> location.replace('index.php?view=Cuentas&type=activa'); </script>";
    exit;
    }

    $cuenta=$cuenta->fetch_array(MYSQLI_ASSOC);
 
 ?>

 <div class="col-md-12">
              <div class="content-box-large">
                <div class="panel-heading">
                    <h2>Modificar Mensualidad</h2>
                   </div>

                   <div>
                            <div >
                                <div >
                                     <ol class="breadcrumb text-left">
                                        <li>
                                              <a href="?"><i class="fa fa-dashboard"></i> Dashboard</a>
                                        </li>
                                        <li class="active">
                                              <a href="?view=Mensualidad"><i class="glyphicon glyphicon-align-center"></i> Mensualidades</a>
                                        </li>
                                        <li class="active">
                                              <a href="#"><i class="glyphicon glyphicon-cog"></i> Modificar Mensualidad</a>
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
                    <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="id" value="<?php echo $cuenta['pk_mensualidad']; ?>">
                      <input type="email" class="form-control" id="txt_nombre" placeholder="Nombre de la Mensualidad" value="<?php echo $cuenta['nombre']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Monto</label>
                    <div class="col-sm-10">
                      <input  type="number" min="0" step="1" class="form-control" id="txt_monto" placeholder="Monto de la Mensualidad por Cobrar o Pagar" value="<?php echo $cuenta['monto']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha de Pago Mensual</label>
                     <div class="col-sm-10">
                           <input value="<?php echo $cuenta['fecha_pago_mes']; ?>" type="text" class="form-control"  name="fecha_pago_mes" id="fecha_pago_mes" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true" >
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Comentario</label>
                     <div class="col-sm-10">
                     <textarea class="form-control" placeholder="Digite algun comentario" id="txt_comentario" rows="3"><?php echo $cuenta['comentario']; ?></textarea>
                    </div>

                  </div>
                   <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Anulado</label>
                     <div class="col-sm-10">
                                <label class="switch switch-text switch-primary switch-pill"><input id="is_active" type="checkbox" class="switch-input" <?php if($cuenta['aud_anulado']=='true') echo "checked"; ?>> <span data-on="On" data-off="Off" class="switch-label"></span> <span class="switch-handle"></span></label>
                    </div>

                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" id="actualizar_Mensualidad">GUARDAR</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          

          </div>
        </div>
                </div>
              </div>