 <?php 
    $login=new Variablem(new Connexion);
    $login->setfkusuario($_SESSION['id']);
    $res=$login->getAll();

 ?>
 <div class="col-md-12">
              <div class="content-box-large">
                <div class="panel-heading">
                      <div class="panel-title"><h2>Mensualidad Variable</h2></div>

                       <a class="btn btn-primary signup" href="?view=VariableM&type=Nuevo">Nueva Mensualidad</a>

                   </div>

                    <div>
                            <div >
                                <div >
                                    <ol class="breadcrumb text-left">
                                        <li>
                                              <a href="?"><i class="fa fa-dashboard"></i> Dashboard</a>
                                        </li>
                                        <li class="active">
                                              <a href="#"><i class="glyphicon glyphicon-align-center"></i> Mensualidades</a>
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
                <th>Comentario</th>
                <th>Fecha de Pago</th>
                <th>Estado</th>
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
                                    <td><?php echo $row["comentario"]; ?></td>
                                    <td><?php echo $row["fecha_pago"]; ?></td>  
                                    <td><?php echo $row["aud_anulado"]; ?></td> 
                                    <td>
                                     <a href="?view=VariableM&type=abonar&id=<?php echo $row['pk_variablem'];?>" class="btn btn-warning btn-outline btn-xs"><i class="glyphicon glyphicon-list"></i> Ver Transacciones</a>
                                       <a href="?view=VariableM&type=Editar&id=<?php echo $row['pk_variablem'];?>" class="btn btn-warning btn-outline btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a onclick="Delete(<?php echo $row['pk_variablem'];?>);" class="btn btn-danger btn-outline btn-xs"><i class="glyphicon glyphicon-trash"></i></a>  
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