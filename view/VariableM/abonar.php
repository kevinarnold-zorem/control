<?php 
  $tabla="variablem";
    
    if (isset($_GET['id'])==null) {
    echo "<script> location.replace('index.php?view=VariableM'); </script>";
    exit;
    }

    $cuenta=new Variablem(new Connexion);
    $cuenta->setpkvariablem($_GET['id']);
    $cuenta->setfkusuario($_SESSION['id']);
    $cuenta=$cuenta->getAllById();

    if (mysqli_num_rows($cuenta)==null) {
   echo "<script> location.replace('index.php?view=VariableM'); </script>";
    exit;
    }

    $cuenta=$cuenta->fetch_array(MYSQLI_ASSOC);
 
 ?>
  <?php 
    $login=new Transaccion(new Connexion);
    $login->setiid($cuenta['pk_variablem']);
    $login->settabla($tabla);
   $login->setfkusuario($_SESSION['id']);
    $res=$login->getAllCobrar();

 ?>

 <div class="col-md-12">
                <div class="panel-heading">
                    <h2>Abonar Mensualidad - <?php echo $cuenta['nombre']; ?> <?php if(isset($_GET['fecha']) && !empty($_GET['fecha'])) {
                       $date=strtotime($_GET['fecha']);
                      $año=date("Y", $date);
                      $mes=date("m", $date);
                        echo "- ".mes($mes);

                    }  ?></h2>
                 </div>
                   <div>
                            <div >
                                <div >
                                     <ol class="breadcrumb text-left">
                                        <li>
                                              <a href="?"><i class="fa fa-dashboard"></i> Dashboard</a>
                                        </li>
                                        <li class="active">
                                              <a href="?view=VariableM"><i class="glyphicon glyphicon-align-center"></i> VariableMes</a>
                                        </li>
                                        <li class="active">
                                              <a href="#"><i class="glyphicon glyphicon-cog"></i> Abonar VariableM</a>
                                        </li>                                        
                                    </ol>
                                </div>
                            </div>
                        </div>


                  <div class="content-box-large">

          <div class="panel-body">
                                
                <div class="panel-body">
          <form accept-charset="utf-8"  class="form-horizontal" method="POST" id="pagovmes" enctype="multipart/form-data" >
                        <input type="hidden" id="id" name="id" value="<?php echo $cuenta['pk_variablem']; ?>">
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Monto a Abonar</label>
                    <div class="col-sm-10">
                      <input  type="number" min="0" step="1" class="form-control" id="txt_monto" name="txt_monto"placeholder="Monto de la Cuenta por Cobrar o Pagar" >
                    </div>
                  </div> 
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha de Pago Mensual</label>
                     <div class="col-sm-10">
                           <input value="<?php if(isset($_GET['fecha']) && !empty($_GET['fecha'])){echo $_GET['fecha'];} else {echo date("Y-m-d");}?>" type="text" class="form-control"  name="fecha_pago_mes" id="fecha_pago_mes" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true" >
                    </div>
                  </div>                
                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Comentario</label>
                     <div class="col-sm-10">
                     <textarea class="form-control" placeholder="Digite algun comentario" id="txt_comentario" name="txt_comentario"rows="3"></textarea>
                    </div>

                  </div>
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Imagen o Captura del Pago</label>
                     <div class="col-sm-10">
                      <input type="file" name="imagen" id="imagen" />
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">GUARDAR</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>  

         <div class="content-box-large">
            <div class="panel-heading">
                  <div class="panel-title">Meses Efectuados o Deudas</div>
                  </div>
          <div class="panel-body">
                                
                <div class="panel-body">
                 <form class="form-horizontal" role="form">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead>
              <tr>
                <th>#</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Comentario</th>                
                <th>Total</th>
                <th>Imagen</th>
              </tr>
            </thead>
            <tbody>


               <?php 
                          $fechamayor = date("Y-m-d");
                          $fecha = $cuenta['fecha_pago'];

                          $invoice=new Invoice(new Connexion);
                          $ress=$invoice->getMeses($fecha,$fechamayor);
                          $ress=$ress->fetch_array(MYSQLI_ASSOC);
                          $ress=$ress['meses'];
                          $i=0;
                          $num=1;

                          while ($i<=$ress) { 

                            $nuevafecha = strtotime('+ '.$i.' Month', strtotime($fecha));
                            $nuevafecha = date('Y-m-j',$nuevafecha);
                          
                            $date=strtotime($nuevafecha);
                              $año=date("Y", $date);
                              $mes=date("m", $date);

                          $invoice=new Transaccion(new Connexion);
                          $invoice->setiid($cuenta['pk_variablem']);
                          $invoice->settabla($tabla);
                          $invoice->setfkusuario($_SESSION['id']);
                          $getall=$invoice->existepagomes($mes,$año);
                            if ($getall) {
                          }
                          else
                          {
                            ?>
                             <tr>   <td><?php echo $num;?></td>  
                                    <td><?php echo mes($mes);?></td>  
                                    <td><?php echo $año; ?></td> 
                                    <td><a  class="btn btn-warning btn-outline btn-xs">SIN ABONAR</a></td> 
                                   <td><a  class="btn btn-warning btn-outline btn-xs">SIN ABONAR</a></td>  
                                    <td>
                                       <a href="?view=VariableM&type=abonar&id=<?php echo $cuenta['pk_variablem'];?>&fecha=<?php echo $nuevafecha ?>" class="btn btn-warning btn-outline btn-xs"><i class="glyphicon glyphicon-fire"></i> ABONAR</a>
                                    </td>
                               </tr>  
                            <?php
                          }
                          $i=$i+1;
                          $num++;

                          }


                          ?>  

               <?php  
                //cargar invoices 
                          while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))  
                          {  
                            $date=strtotime($row['fecha_pago']);
                            $año=date("Y", $date);
                            $mes=date("m", $date);
                              ?>
                               <tr>  
                                    <td><?php echo $num;?></td>  
                                    <td><?php echo mes($mes); ?></td>  
                                    <td><?php echo $año; ?></td>
                                   <td><?php echo $row["comentario"]; ?></td>  
                                    <td><?php echo $row["monto"]; ?></td>  
                                    <td>
                                       <button type="button" class="btn btn-warning btn-outline btn-xs" data-toggle="modal" data-target="#<?php echo $num; ?>">
                                        Mostrar Imagen
                                      </button>

                                      <div class="modal fade" id="<?php echo $num; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagen']); ?>"  width="550" height="500" />

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

                                    </td>  

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

<?php 
function mes($mes)
    {
      if ($mes=="01") {
        return "ENERO";
      }
      if ($mes=="02") {
        return "FEBRERO";
      }
      if ($mes=="03") {
        return "MARZO";
      }
      if ($mes=="04") {
        return "ABRIL";
      }
      if ($mes=="05") {
        return "MAYO";
      }
      if ($mes=="06") {
        return "JUNIO";
      }
      if ($mes=="07") {
        return "JULIO";
      }
      if ($mes=="08") {
        return "AGOSTO";
      }
      if ($mes=="09") {
        return "SEPTIEMBRE";
      }
      if ($mes=="10") {
        return "OCTUBRE";
      }
      if ($mes=="11") {
        return "NOVIEMBRE";
      }
      if ($mes=="12") {
        return "DICIEMBRE";
      }


    }




 ?>