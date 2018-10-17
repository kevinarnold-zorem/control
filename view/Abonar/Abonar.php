<?php 

    
    if (isset($_GET['id'])==null) {
    echo "<script> location.replace('index.php?view=Mensualidad'); </script>";
    exit;
    }

    $cuenta=new Mensualidad(new Connexion);
    $cuenta->setpkmensualidad($_GET['id']);
    $cuenta->setfkusuario($_SESSION['id']);
    $cuenta=$cuenta->getAllById();

    if (mysqli_num_rows($cuenta)==null) {
   echo "<script> location.replace('index.php?view=Mensualidad'); </script>";
    exit;
    }

    $cuenta=$cuenta->fetch_array(MYSQLI_ASSOC);
 
 ?>
  <?php 

    $date=strtotime($_GET['fecha']);
    $año=date("Y", $date);
    $mes=date("m", $date);

    $invoice=new Invoice(new Connexion);
    $invoice->setfkmensualidad($cuenta['pk_mensualidad']);
    $invoice->setfkusuario($_SESSION['id']);
    $getall=$invoice->createinvoicereturn($mes,$año);
    if ($getall) {
      //si existe obtener datos
       $invoice=new Invoice(new Connexion);
          $invoice->setfkmensualidad($cuenta['pk_mensualidad']);
          $invoice->setfkusuario($_SESSION['id']);
          $res=$invoice->validarmensualidad_2($mes,$año);
          $res=$res->fetch_array(MYSQLI_ASSOC);
    }
    else
    {
           //no existe crear el invoice
        $invoice=new Invoice(new Connexion);
    $invoice->setfkmensualidad($cuenta['pk_mensualidad']);
    $invoice->setfkusuario($_SESSION['id']);
    $invoice->setfechapagomes($_GET['fecha']);
    $invoice->settotal($cuenta['monto']);
    $invoice->setstatus("debe");
    $id=$invoice->insertinvoice();
    }


   

 ?>

 <div class="col-md-12">
              <div class="content-box-large">
                <div class="panel-heading">
                    <h2>Abonar Mensualidad - <?php echo $cuenta['nombre']; ?> - Del Mes de : <?php echo mes($mes); ?></h2>
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
                                              <a href="#"><i class="glyphicon glyphicon-cog"></i> Abonar Mensualidad - Fecha Especifica</a>
                                        </li>                                        
                                    </ol>
                                </div>
                            </div>
                        </div>


                  <div class="content-box-large">

          <div class="panel-body">
                                
                <div class="panel-body">
          <form accept-charset="utf-8"  class="form-horizontal" method="POST" id="pagomes_ABONAR" enctype="multipart/form-data" >
                        <input type="hidden" id="id" name="id" value="<?php echo $cuenta['pk_mensualidad']; ?>">
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Monto a Abonar</label>
                    <div class="col-sm-10">
                      <input  type="number" min="0" step="1" class="form-control" id="txt_monto" name="txt_monto"placeholder="Monto de la Cuenta por Cobrar o Pagar" value="<?php echo $cuenta['monto']-$res['credit']; ?>">
                      <input type="hidden" name="monto_mensualidad" value="<?php echo $cuenta['monto'] ?>">
                    </div>
                  </div> 
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha de Pago Mensual</label>
                     <div class="col-sm-10">
                           <input value="<?php echo $_GET['fecha'];?>" type="text" class="form-control"  name="fecha_pago_mes" id="fecha_pago_mes" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true" >
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
                  <div class="panel-title">Transacciones Recientes de la Cuenta</div>
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
                <th>Total</th>
                <th>Credit</th>
                <th>Status</th>
                <th>Gestionar</th>
              </tr>
            </thead>
            <tbody>


               <?php 
                          $fechamayor = date("Y-m-d");
                          $fecha = $cuenta['fecha_pago_mes'];

                          $invoice=new Invoice(new Connexion);
                          $ress=$invoice->getMeses($fecha,$fechamayor);
                          $ress=$ress->fetch_array(MYSQLI_ASSOC);
                          $ress=$ress['meses'];
                          $i=1;
                          $num=1;

                          while ($i<=$ress+1) { 

                            $nuevafecha = strtotime('+ '.$i.' Month', strtotime($fecha));
                            $nuevafecha = date('Y-m-j',$nuevafecha);
                          
                            $date=strtotime($nuevafecha);
                              $año=date("Y", $date);
                              $mes=date("m", $date);

                          $invoice=new Invoice(new Connexion);
                          $invoice->setfkmensualidad($cuenta['pk_mensualidad']);
                          $invoice->setfkusuario($_SESSION['id']);
                          $getall=$invoice->createinvoicereturn($mes,$año);
                            if ($getall) {
                             
                          }
                          else
                          {
                            ?>
                             <tr>   <td><?php echo $num;?></td>  
                                    <td><?php echo mes($mes);?></td>  
                                    <td><?php echo $año; ?></td> 
                                   <td><?php echo $cuenta['monto']; ?></td>  
                                    <td><?php echo "0.00"; ?></td>
                                    <?php $status="debe";?>  
                                    <td><?php echo $status ?></td>
                                    <td><a href="?view=Mensualidad&type=abonar&id=<?php echo $row['pk_mensualidad'];?>" class="btn btn-warning btn-outline btn-xs"><i class="glyphicon glyphicon-list"></i> Ver Transacciones</a>
                                      <?php 
                                        if ($status=="debe") {
                                          ?>
                                           <a href="?view=Mensualidad&type=Editar&id=<?php echo $row['pk_mensualidad'];?>" class="btn btn-warning btn-outline btn-xs"><i class="glyphicon glyphicon-fire"></i></a>
                                          <?php
                                        }
                                       ?>
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
                          $login=new Invoice(new Connexion);
                          $login->setfkmensualidad($cuenta['pk_mensualidad']);
                          $login->setfkusuario($_SESSION['id']);
                          $result=$login->getAll();
                          while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
                          {  
                            $date=strtotime($row['fecha_pago_mes']);
                            $año=date("Y", $date);
                            $mes=date("m", $date);
                              ?>
                               <tr>  
                                    <td><?php echo $num;?></td>  
                                    <td><?php echo mes($mes); ?></td>  
                                    <td><?php echo $año; ?></td>
                                    <td><?php echo $row["total"]; ?></td>  
                                    <td><?php echo $row["credit"]; ?></td>  
                                    <td><?php $status=$row["status"]; echo $status; ?></td>  
                                    <td>
                                      <a href="?view=Mensualidad&type=abonar&id=<?php echo $row['pk_mensualidad'];?>" class="btn btn-warning btn-outline btn-xs"><i class="glyphicon glyphicon-list"></i> Ver Transacciones</a>
                                       <?php 
                                        if ($status=="debe") {
                                          ?>
                                           <a href="?view=Abonar&id=<?php echo $row['fk_mensualidad'];?>&fecha=<?php echo $row['fecha_pago_mes'] ?>" class="btn btn-warning btn-outline btn-xs"><i class="glyphicon glyphicon-fire"></i></a>
                                          <?php
                                        }
                                       ?>
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

