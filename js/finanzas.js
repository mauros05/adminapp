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
let datos_consultado={};//falta realizar el guardado de datos en la variables y realizar las comparacion
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
});
guardar_gasto.addEventListener("click",function(){
  radios_periodicidad.forEach(function(radio) {
    if (radio.checked) {
      datos.periodicidad=radio.value
    }
  });
  radios_tipo_gasto.forEach(function(radio) {
    if (radio.checked) {
      datos.tipo_gasto=radio.value
    }
  });
  datos.accion="guardar";
  datos.fecha_pago=fechaInput.value;
  datos.descripcion=descripcion_gasto.value;
  datos.monto=monto_gasto.value;
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4){
      if (xhr.status === 200) {
          
        }else{
          console.log("Error: " + xhr.statusText);
        }
      }
  };
  xhr.open("POST", "ajax/ajaxFinanzas.php");
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send(JSON.stringify(datos));
});

consulta_gasto.forEach(function(boton){
  boton.addEventListener("click",function(){
    mensaje_error.innerText="";
    modal_gasto.style.display="block";
    form_gasto.style.display="block";
    titulo_modal.textContent="Editar Gasto";
    datos.accion="consulta";
    datos.id = boton.getAttribute('data-id');
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
            fechaInput.value=respuesta.fecha_de_pago;
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
    
  });
});
actualizar_gasto.addEventListener("click",function(){
  let datos_enviados={};
  let cambio=0;
  datos_editados.nombre=descripcion_gasto.value;
  radios_periodicidad.forEach(function(radio) {
    if (radio.checked) {
      datos_editados.id_periodicidad=radio.value
    }
  });
  radios_tipo_gasto.forEach(function(radio) {
    if (radio.checked) {
      datos_editados.id_tipo_de_gasto=radio.value
    }
  });
  datos_editados.fecha_de_pago=fechaInput.value;// validacion de fecha
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
    console.log(datos_enviados);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4){
        if (xhr.status === 200) {
          console.log(xhr.responseText);
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

eliminar_gasto.forEach(function(boton){
  boton.addEventListener("click",function(){
    datos.id = boton.getAttribute('data-id');
    let gasto = document.getElementById("nombre"+datos.id).textContent;
    modal_gasto.style.display="block";
    form_gasto.style.display="none";
    titulo_modal.textContent="Eliminar Gasto";
    mensaje_eliminar.innerHTML="<label>Esta seguro de eliminar '"+gasto+"'</label>";
    /*xhr.onreadystatechange = function(){
      if (xhr.readyState === 4){
        if (xhr.status === 200) {
          console.log(xhr.responseText);
        }else{
          console.log("Error: " + xhr.statusText);
        }
      }
    };
    xhr.open("POST", "ajax/ajaxFinanzas.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(datos));*/
    guardar_gasto.style.display="none";
    actualizar_gasto.style.display="none";
    borrar_gasto.style.display="block";
  });
});

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