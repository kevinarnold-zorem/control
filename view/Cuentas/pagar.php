 <?php 
    $login=new Cuenta(new Connexion);
    $login->settype('pagar');
    $login->setfkusuario($_SESSION['id']);
    $res=$login->getAllCobrar();

 ?>
 <div class="col-md-12">
              <div class="content-box-large">
                <div class="panel-heading">
                      <div class="panel-title"><h2>Cuentas Por Pagar</h2></div>

                       <a class="btn btn-primary signup" href="#">Descargar EXCEL</a>

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
                                              <a href="#"><i class="glyphicon glyphicon-cog"></i> Pagar</a>
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
                <th>Nombre</th>
                <th>Status</th>
                <th>Monto</th>
                 <th>Monto Abonado</th>
                <th>Fecha de Creacion</th>
                <th>Gestionar</th>
              </tr>
            </thead>
            <tbody>
               <?php      $num=1;
                          while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))  
                          {  
                              ?>
                               <tr>  
                                    <td><?php echo $num;?></td>  
                                    <td><?php echo $row["nombre"]; ?></td>  
                                    <td><?php echo $row["status"]; ?></td>
                                    <td><?php echo $row["monto"]; ?></td>
                                    <td><?php echo $row["credit"]; ?></td>  
                                    <td><?php echo $row["created_at"]; ?></td>  

                                    <td><a href="?view=Cuentas&type=Transaccion&id=<?php echo $row['pk_cobro_pago'];?>" class="btn btn-warning btn-outline btn-xs"><i class="glyphicon glyphicon-list"></i> Ver Transacciones</a>
                                      <a onclick="Delete(<?php echo $row['pk_cobro_pago'];?>);" class="btn btn-danger btn-outline btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>   
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