<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header ">
    <div class="container-fluid ">
      <h1 class="text-center">Gastos</h1>
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
                <th class="col-1 text-center">Periodicidad</th>
                <th class="col-2 text-center">Tipo de gasto</th>
                <th class="col-2 text-center">Fecha limite</th>
                <th class="col-2 text-center">Opciones</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $item='id_usuario';
                $valor=2;
                $respuesta = controllerFinanzas::ctrlistado_gastos($item,$valor);
                if($respuesta){for($i=0; $i<count($respuesta); $i++){
                ?>
                    <tr id='<?= $respuesta[$i]['id_gasto'] ?>'>
                    <td><?= $respuesta[$i]['descripcion'] ?></td>
                    <td><?="$".$respuesta[$i]['monto'] ?></td>
                    <td><?= $respuesta[$i]['periodicidad'] ?></td>
                    <td><?= $respuesta[$i]['tipo_de_gasto'] ?></td>
                    <td><?php if($respuesta[$i]['fecha_de_pago']==null){echo "NA";}else{echo $respuesta[$i]['fecha_de_pago'];}  ?></td>
                    <td>
                      <div class="row">
                        <div class="d-flex justify-content-around col-12">
                          <button data-id="<?= $respuesta[$i]['id_gasto'] ?>" type="button" class="btn btn-primary col-5 editar_gasto"><i class="fa fa-fw fa-edit"></i> Editar</button>
                          <button data-id="<?= $respuesta[$i]['id_gasto'] ?>" type="button" class="btn btn-primary col-5 eliminar_gasto"><i class="fa fa-fw fa-trash"></i> Borrar</button>
                        </div>
                      </div>
                    </td>
                    </tr>
                <?php
                }}else{?>
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
        <div id="mensaje_error"></div>
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
                    <input class="form-check-input" type="radio" name="radiogasto" value="1">
                    <label class="form-check-label">Fijo</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radiogasto" value="2">
                    <label class="form-check-label">Variable</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <label>Periodicidad</label>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioperiodicidad" value="1">
                    <label class="form-check-label"> cada 15 dias</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioperiodicidad" value="2">
                    <label class="form-check-label">una vez al mes</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioperiodicidad" value="3">
                    <label class="form-check-label">Una vez cada 2 meses</label>
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
        <button type="button" class="btn btn-primary" id="eliminar">Eliminar</button>
        <button type="button" class="btn btn-primary" id="actualizar">Editar</button>
        <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
        <button type="button" class="btn btn-secondary cerrar_modal" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>



<!--
  <div class="modal" tabindex="-1" role="dialog" id="modal_gasto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_modal">Modal title</h5>
        <button type="button" class="close"id="cerrar_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Text</label>
                  <input type="text" class="form-control" placeholder="Enter ...">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Text Disabled</label>
                  <input type="text" class="form-control" placeholder="Enter ..." disabled="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Textarea</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Textarea Disabled</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." disabled=""></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with success</label>
              <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with warning</label>
              <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with error</label>
              <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">Checkbox</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked="">
                    <label class="form-check-label">Checkbox checked</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" disabled="">
                    <label class="form-check-label">Checkbox disabled</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio1">
                    <label class="form-check-label">Radio</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio1" checked="">
                    <label class="form-check-label">Radio checked</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" disabled="">
                    <label class="form-check-label">Radio disabled</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Select</label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Select Disabled</label>
                  <select class="form-control" disabled="">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Select Multiple</label>
                  <select multiple="" class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Select Multiple Disabled</label>
                  <select multiple="" class="form-control" disabled="">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
              </div>
            </div>
          </form>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div> 
-->