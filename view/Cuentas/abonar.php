<?php 

    
    if (isset($_GET['id'])==null) {
    echo "<script> location.replace('index.php?view=Cuentas&type=activa'); </script>";
    exit;
    }

    $cuenta=new Cuenta(new Connexion);
    $cuenta->setpkcobropago($_GET['id']);
    $cuenta->setfkusuario($_SESSION['id']);
    $cuenta=$cuenta->getAllById();

    if (mysqli_num_rows($cuenta)==null) {
   echo "<script> location.replace('index.php?view=Cuentas&type=activa'); </script>";
    exit;
    }

    $cuenta=$cuenta->fetch_array(MYSQLI_ASSOC);
 
 ?>
  <?php 
    $login=new Transaccion(new Connexion);
    $login->setiid($cuenta['pk_cobro_pago']);
    $login->settabla('cobro_pago');
    $login->setfkusuario($_SESSION['id']);
    $res=$login->getAllCobrar();

 ?>

 <div class="col-md-12">
              <div class="content-box-large">
                <div class="panel-heading">
                    <h2>Abonar Cuenta</h2>
                   </div>

                   <div>
                            <div >
                                <div >
                                     <ol class="breadcrumb text-left">
                                        <li>
                                              <a href="?"><i class="fa fa-dashboard"></i> Dashboard</a>
                                        </li>
                                        <li class="active">
                                              <a href="#"><i class="glyphicon glyphicon-random"></i> Cuentas Por</a>
                                        </li>
                                        <li class="active">
                                              <a href="?view=Cuentas&type=activa"><i class="glyphicon glyphicon-cog"></i> Activas</a>
                                        </li>
                                         <li class="active">
                                              <a href="#"><i class="glyphicon glyphicon-download-alt"></i> Abonar Cuenta</a>
                                        </li>
                                      
                                    </ol>
                                </div>
                            </div>
                        </div>


                  <div class="content-box-large">

          <div class="panel-body">
                                
                <div class="panel-body">
                 <form class="form-horizontal" role="form">
                        <input type="hidden" id="id" value="<?php echo $cuenta['pk_cobro_pago']; ?>">
                        <input type="hidden" id="tipo" value="<?php echo $cuenta['type']; ?>">
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Monto a Abonar</label>
                    <div class="col-sm-10">
                      <input  type="number" min="0" step="1" class="form-control" id="txt_monto" placeholder="Monto de la Cuenta por Cobrar o Pagar" value="<?php echo $cuenta['monto']-$cuenta['credit']; ?>">
                    </div>
                  </div>                 
                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Comentario</label>
                     <div class="col-sm-10">
                     <textarea class="form-control" placeholder="Digite algun comentario" id="txt_comentario" rows="3"></textarea>
                    </div>

                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" id="abonar_cuentas">GUARDAR</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>  

         <div class="content-box-large">
            <div class="panel-heading">
                  <div class="panel-title">Transacciones Recientes de la Cuenta</div>
                  </div>
          <div class="panel-body">
                                
                <div class="panel-body">
                 <form class="form-horizontal" role="form">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead>
              <tr>
                <th>#</th>
                <th>Monto</th>
                <th>Comentario</th>
                <th>Fecha</th>
                <th>Fecha Pago</th>
              </tr>
            </thead>
            <tbody>
               <?php      $num=1;
                          while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))  
                          {  
                              ?>
                               <tr>  
                                    <td><?php echo $num;?></td>  
                                    <td><?php echo $row["monto"]; ?></td>  
                                    <td><?php echo $row["comentario"]; ?></td>
                                    <td><?php echo $row["fecha_pago"]; ?></td>  
                                    <td><?php echo $row["created_at"]; ?></td>  
                               </tr>  
                               <?php
                               $num++;
                          }  
                          ?>  
            </tbody>
          </table>
                </form>
              </div>
            </div>
          </div>
        </div>  
       
      

                </div>
              </div>





            