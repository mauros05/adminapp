//Partes del modal
const modal_gasto = document.getElementById("modal_gasto");
const form_gasto = document.getElementById("form_gasto");
const titulo_modal = document.getElementById("titulo_modal");
const descripion_gasto = document.getElementById("descripcion_gasto");
const radios_periodicidad = document.getElementsByName("radioperiodicidad");
const radios_tipo_gasto = document.getElementsByName("radiogasto");
const fechaInput = document.getElementById("fecha_gasto");
const monto_gasto = document.getElementById("monto_gasto");
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
          console.log(xhr.responseText);
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
          radios_periodicidad.forEach((radio) => {
            if (radio.value == respuesta.id_periodicidad) {
              radio.checked = true;
            }
          });
          radios_tipo_gasto.forEach((radio) => {
            if (radio.value == respuesta.id_tipo_de_gasto) {
              radio.checked = true;
            }
          });
          if(respuesta.fecha_de_pago!=null){
            fechaInput.value=respuesta.fecha_de_pago;
          }
          monto_gasto.value=respuesta.cantidad;
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
  datos_editados.id = actualizar_gasto.getAttribute('data-id');
  radios_periodicidad.forEach(function(radio) {
    if (radio.checked) {
      datos_editados.periodicidad=radio.value
    }
  });
  radios_tipo_gasto.forEach(function(radio) {
    if (radio.checked) {
      datos_editados.tipo_gasto=radio.value
    }
  });
  datos_editados.descripcion=descripcion_gasto.value;
  datos_editados.monto=monto_gasto.value;
  for (let clave in datos) {
    mismosValores = true;
    if(clave=="accion" || clave=="fecha_pago"||clave=="item"){
     
    }else{
      console.log(clave);
      if (datos[clave] != datos_editados[clave]) {
        mismosValores = false;
        break;
      }
    }
  }
  if(mismosValores==false){
    datos_editados.fecha_pago=fechaInput.value;
    datos_editados.accion="editar";
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
    xhr.send(JSON.stringify(datos_editados));
    console.log("enviado");
  }else{
    console.log("No hay cambios");
  }

});

eliminar_gasto.forEach(function(boton){
  boton.addEventListener("click",function(){
    datos.id = boton.getAttribute('data-id');
    modal_gasto.style.display="block";
    form_gasto.style.display="none";
    titulo_modal.textContent="Eliminar Gasto";
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