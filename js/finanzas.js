///////////////////////////Elementos
//Gastos
//Partes del modal
const modal_gasto = document.getElementById("modal_gasto");
const form_gasto = document.getElementById("form_gasto");
const titulo_modal = document.getElementById("titulo_modal");
const descripion_gasto = document.getElementById("descripcion_gasto");
const radios_periodicidad = document.getElementsByName("radioperiodicidad");
const radios_tipo_gasto = document.getElementsByName("radiogasto");
const fechaInput = document.getElementById("fecha_gasto");
const monto_gasto = document.getElementById("monto_gasto");
const mensaje_error = document.getElementById("mensaje_error");
const mensaje_eliminar = document.getElementById("mensaje_eliminar");
//Funciones del modal
const agregar_gasto = document.getElementById("agregar_gasto");
const consulta_gasto = document.querySelectorAll(".editar_gasto");
const eliminar_gasto = document.querySelectorAll(".eliminar_gasto");
const cerrar_modal = document.querySelectorAll(".cerrar_modal");
const guardar_gasto = document.getElementById("guardar");
const actualizar_gasto = document.getElementById("actualizar");
const borrar_gasto = document.getElementById("eliminar");
const xhr = new XMLHttpRequest();
let datos={};
let datos_editados={};
let datos_consultado={};
//Crear nuevo gasto **********Poder modificar sin actualizar
agregar_gasto.addEventListener("click",function(){
  modal_gasto.style.display="block";
  form_gasto.style.display="block";
  titulo_modal.textContent="Agregar Gasto";
  descripcion_gasto.value="";
  radios_periodicidad.forEach(function(radio) {
    radio.checked=false;
  });
  radios_tipo_gasto.forEach(function(radio) {
    radio.checked=false;
  });
  fechaInput.value="";
  monto_gasto.value="";
  guardar_gasto.style.display="block";
  actualizar_gasto.style.display="none";
  borrar_gasto.style.display="none";
  guardar_gasto.addEventListener("click",agregar_gastos);
});
//Editar el gasto
consulta_gasto.forEach(function(boton){
  boton.addEventListener("click",editar_gastos);
});
//Eliminar gasto (cambio de estatus)
eliminar_gasto.forEach(function(boton){
  boton.addEventListener("click",eliminar_gastos);
});
//Modal funciones
cerrar_modal.forEach(function(boton){
  boton.addEventListener("click",function(){
      modal_gasto.style.display="none";
  });
});
window.addEventListener("click", function(event) {
  if (event.target == modal_gasto) {
      modal_gasto.style.display = "none";
  }
});
$(document).ready(function() {
  $('#reservationdate').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: true,
    autoclose: true
  });
});
///
///////////////////////////Funciones
/// Gastos
function agregar_gastos(){
  let periodicidad;
  let tipos_gasto;
  radios_periodicidad.forEach(function(radio) {
    if (radio.checked) {
      datos.periodicidad=radio.value
      const label = document.querySelector(`label[for="${radio.id}"]`);
      periodicidad=label.textContent;
    }
  });
  radios_tipo_gasto.forEach(function(radio) {
    if (radio.checked) {
      datos.tipo_gasto=radio.value
      const label = document.querySelector(`label[for="${radio.id}"]`);
      tipos_gasto=label.textContent;
    }
  });
  datos.accion="guardar";
  datos.fecha_pago=fechaInput.value;
  datos.descripcion=descripcion_gasto.value;
  datos.monto=monto_gasto.value;
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4){
      if (xhr.status === 200) {
        modal_gasto.style.display="none";
        let partesFecha = datos.fecha_pago.split("-");
        let fechaFormateada = partesFecha[0] + "/" + partesFecha[1] + "/" + partesFecha[2];   
        let tabla_gasto = document.getElementById('tbl_gastos');
        let linea=`
        <td>`+datos.descripcion+`</td>
        <td>$`+datos.monto+`</td>
        <td>`+periodicidad+`</td>
        <td>`+tipos_gasto+`</td>
        <td>`+fechaFormateada+`</td>
        <td>
          <div class="row">
            <div class="d-flex justify-content-around col-12">
              <button data-id="<?= $respuesta[$i]['id_gasto'] ?>" type="button" class="btn btn-primary col-5 editar_gasto"><i class="fa fa-fw fa-edit"></i> Editar</button>
              <button data-id="<?= $respuesta[$i]['id_gasto'] ?>" type="button" class="btn btn-primary col-5 eliminar_gasto"><i class="fa fa-fw fa-trash"></i> Borrar</button>
            </div>
          </div>
        </td>
        `;
        let nuevotr = document.createElement('tr');
        nuevotr.innerHTML=linea;
        tabla_gasto.appendChild(nuevotr)
        var botonesEditar = document.querySelectorAll('.editar_gasto');
        var botonesEliminar = document.querySelectorAll('.eliminar_gasto');
        for (var i = 0; i < botonesEditar.length; i++) {
          botonesEditar[i].addEventListener('click', editar_gastos);
        }
        for (var i = 0; i < botonesEliminar.length; i++) {
          botonesEliminar[i].addEventListener('click', eliminar_gastos);
        }
        }else{
          console.log("Error: " + xhr.statusText);
        }
      }
  };
  xhr.open("POST", "ajax/ajaxFinanzas.php");
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send(JSON.stringify(datos));
}
function editar_gastos(){
  let periodicidad;
  let tipos_gasto;
  mensaje_error.innerText="";
  modal_gasto.style.display="block";
  form_gasto.style.display="block";
  titulo_modal.textContent="Editar Gasto";
  datos.accion="consulta";
  datos.id = this.getAttribute('data-id');
  actualizar_gasto.setAttribute("data-id",datos.id);
  datos.item='id_gasto';
  xhr.onreadystatechange = function(){
    if (xhr.readyState === 4){
      if (xhr.status === 200) {
        respuesta=JSON.parse(xhr.responseText)[0];
        descripion_gasto.value=respuesta.nombre;
        datos_consultado.nombre=respuesta.nombre;
        radios_periodicidad.forEach((radio) => {
          if (radio.value == respuesta.id_periodicidad) {
            radio.checked = true;
           datos_consultado.id_periodicidad=respuesta.id_periodicidad;
          }
        });
        radios_tipo_gasto.forEach((radio) => {
          if (radio.value == respuesta.id_tipo_de_gasto) {
            radio.checked = true;
            datos_consultado.id_tipo_de_gasto=respuesta.id_tipo_de_gasto;
          }
        });
        if(respuesta.fecha_de_pago!=null){
          let partesFecha = respuesta.fecha_de_pago.split("-");
          let fechaFormateada = partesFecha[2] + "-" + partesFecha[1] + "-" + partesFecha[0];
          fechaInput.value=fechaFormateada;
          datos_consultado.fecha_de_pago=respuesta.fecha_de_pago;            
        }
        monto_gasto.value=respuesta.cantidad;
        datos_consultado.cantidad=respuesta.cantidad;
        guardar_gasto.style.display="none";
        actualizar_gasto.style.display="block";
        borrar_gasto.style.display="none";
      }else{
        console.log("Error: " + xhr.statusText);
      }
    }  
  };
  xhr.open("POST", "ajax/ajaxFinanzas.php");
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send(JSON.stringify(datos));
  //Actulizar los valores en la base de datos
  actualizar_gasto.addEventListener("click",function(){
    let datos_enviados={};
    let cambio=0;
    datos_editados.nombre=descripcion_gasto.value;
    radios_periodicidad.forEach(function(radio) {
      if (radio.checked) {
        datos_editados.id_periodicidad=radio.value
        const label = document.querySelector(`label[for="${radio.id}"]`);
        periodicidad=label.textContent;
      }
    });
    radios_tipo_gasto.forEach(function(radio) {
      if (radio.checked) {
        datos_editados.id_tipo_de_gasto=radio.value
        const label = document.querySelector(`label[for="${radio.id}"]`);
        tipos_gasto=label.textContent;
      }
    });
    datos_editados.fecha_de_pago=fechaInput.value;
    datos_editados.cantidad=monto_gasto.value;
    for (let clave in datos_editados) {
      if(cambio!=1){
        mismosValores = true;
      }
      if(datos_consultado[clave] != datos_editados[clave]){
        mismosValores = false;
        datos_enviados[clave]=datos_editados[clave];
        cambio=1;
      }

    }
    if(mismosValores==false){
      datos_enviados.id = actualizar_gasto.getAttribute('data-id');
      datos_enviados.accion="editar";
      datos_enviados.item='id_gasto';
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4){
          if (xhr.status === 200) {
            modal_gasto.style.display="none";
            document.getElementById("nombre"+datos_enviados.id).innerText=datos_editados.nombre;
            document.getElementById("monto"+datos_enviados.id).innerText="$"+datos_editados.cantidad;
            //hacer el cambio de int a string
            document.getElementById("periodicidad"+datos_enviados.id).innerText=periodicidad;
            document.getElementById("tipo_de_gasto"+datos_enviados.id).innerText=tipos_gasto;
            let partesFecha = datos_editados.fecha_de_pago.split("-");
            let fechaFormateada = partesFecha[0] + "/" + partesFecha[1] + "/" + partesFecha[2];
            document.getElementById("fecha_de_pago"+datos_enviados.id).innerText=fechaFormateada;
          }else{
            console.log("Error: " + xhr.statusText);
          }
        }
      };
      xhr.open("POST", "ajax/ajaxFinanzas.php");
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.send(JSON.stringify(datos_enviados));
    }else{
      mensaje_error.innerText="No hay cambios en los datos";
    }

  });
}
function eliminar_gastos(){
  datos.id = this.getAttribute('data-id');
  let gasto = document.getElementById("nombre"+datos.id).textContent;
  modal_gasto.style.display="block";
  form_gasto.style.display="none";
  titulo_modal.textContent="Eliminar Gasto";
  mensaje_eliminar.innerHTML="<label>Esta seguro de eliminar '"+gasto+"'</label>";
  guardar_gasto.style.display="none";
  actualizar_gasto.style.display="none";
  borrar_gasto.style.display="block";
  borrar_gasto.addEventListener("click",function(){
    datos.accion="borrar";
    datos.item='id_gasto';
    xhr.onreadystatechange = function(){
      if (xhr.readyState === 4){
        if (xhr.status === 200) {
          modal_gasto.style.display="none";
          document.getElementById(datos.id).remove();
        }else{
          console.log("Error: " + xhr.statusText);
        }
      }
    };
    xhr.open("POST", "ajax/ajaxFinanzas.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(datos));
  });
}
///