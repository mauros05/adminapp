<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header ">
    <div class="container-fluid ">
      <h1 class="text-center">Inversiones</h1>
      <div class="row mt-2 col-12 mx-auto">
        <button id="agregar_gasto" type="button" class="btn btn-block btn-primary btn-flat ml-auto col-12 col-lg-2">Agregar nuevo</button>
      </div>
      <div class="row">
        <div class="card-body">
          <table class="table table-bordered ">
            <thead>
              <tr>
                <th class="col-4 text-center">Descripcion</th>
                <th class="col-1 text-center">Monto</th>
                <th class="col-1 text-center">% interes</th>
                <th class="col-2 text-center">Opciones</th>
              </tr>
            </thead>
            <tbody id="tbl_gastos">
                <?php
                $item='id_usuario';
                $valor=2;
                $respuesta = controllerFinanzas::ctrlistado_inversiones($item,$valor);
                if($respuesta){
                    var_dump($respuesta);
                }else{?>
                  <td colspan="6"><h5 id="aviso_registros" class="text-center mt-2">No existe ningun registro</h5></td>
                <?php
                }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>




<div class="modal" tabindex="-1" role="dialog" id="modal_gasto"  >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_modal">Modal title</h5>
        <button type="button" class="close cerrar_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="mensaje_eliminar"></div>
        <div id="form_gasto" class="card-body">
          <form>
            <div class="row">
              <div class="form-group col-12">
                <label>Descripcion</label>
                <input type="text" class="form-control" id="descripcion_gasto" placeholder="Nombre del gasto">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>Tipo de gasto</label>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radiogasto" value="1" id="opcion1">
                    <label class="form-check-label" for="opcion1">Fijo</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radiogasto" value="2" id="opcion2">
                    <label class="form-check-label" for="opcion2">Variable</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <label>Periodicidad</label>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioperiodicidad" value="1" id="opcion3">
                    <label class="form-check-label" for="opcion3"> cada 15 dias</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioperiodicidad" value="2" id="opcion4">
                    <label class="form-check-label" for="opcion4">una vez al mes</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioperiodicidad" value="3" id="opcion5">
                    <label class="form-check-label" for="opcion5">Una vez cada 2 meses</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Date:</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    <input type="text" class="form-control datetimepicker-input" id="fecha_gasto" data-target="#reservationdate">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <label>Monto</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="text" class="form-control" id="monto_gasto">
                </div>
              </div>
            </div>
          </form>
        </div> 
      </div>
      <div class="modal-footer">
        <label id="mensaje_error" class="text-danger"></label>
        <button type="button" class="btn btn-primary" id="eliminar">Eliminar</button>
        <button type="button" class="btn btn-primary" id="actualizar">Editar</button>
        <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
        <button type="button" class="btn btn-secondary cerrar_modal" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>