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
                      <div class="panel-title"><h2>Transacciones de : <?php echo $cuenta['nombre']; ?></h2></div>

                       <a class="btn btn-primary signup" href="#">Descargar Excel</a>

                   </div>

                    <div>
                            <div >
                                <div >
                                    <ol class="breadcrumb text-left">
                                        <li>
                                              <a href="?"><i class="fa fa-dashboard"></i> Dashboard</a>
                                        </li>
                                        <li class="active">
                                              <a href="?view=Cuentas&type=activa"><i class="glyphicon glyphicon-random"></i> Cuentas Por</a>
                                        </li>
                                        <li class="active">
                                              <a href="?view=Cuentas&type=cobrar"><i class="glyphicon glyphicon-cog"></i> Cobrar -</a>
                                                <a href="?view=Cuentas&type=pagar"><i class="glyphicon glyphicon-cog"></i> Pagar</a>
                                        </li>
                                         <li class="active">
                                              <a href="#"><i class="glyphicon glyphicon-list"></i> Transacciones</a>
                                        </li>
                                      
                                    </ol>
                                </div>
                            </div>
                        </div>


                  <div class="content-box-large">

          <div class="panel-body">
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
          </div>
        </div>
                </div>
              </div>