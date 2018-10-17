
 <div class="col-md-12">
              <div class="content-box-large">
                <div class="panel-heading">
                    <h2>Nueva Cuenta</h2>
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
                                              <a href="#"><i class="glyphicon glyphicon-cog"></i> Nueva Cuenta</a>
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
                      <input type="email" class="form-control" id="txt_nombre" placeholder="Nombre de la Cuenta">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Monto</label>
                    <div class="col-sm-10">
                      <input  type="number" min="0" step="1" class="form-control" id="txt_monto" placeholder="Monto de la Cuenta por Cobrar o Pagar">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
                     <div class="col-sm-10">
                      <select class="form-control form-control-sm" id="tipo">
                        <option value="pagar" >Pagar</option>
                        <option value="cobrar" selected>Cobrar</option>
                     </select>
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
                      <button type="submit" class="btn btn-primary" id="insert_Cuentas">GUARDAR</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          

          </div>
        </div>
                </div>
              </div>