const agregar_gasto = document.getElementById("agregar_gasto");
const cerrar_modal = document.querySelectorAll(".cerrar_modal");
const modal_gasto = document.getElementById("modal_gasto");
const titulo_modal = document.getElementById("titulo_modal");
const guardar_gasto = document.getElementById("guardar");
const radios_periodicidad = document.getElementsByName("radioperiodicidad");
const radio_tipo_gasto = document.getElementsByName("radiogasto");
const fechaInput = document.getElementById("fecha_gasto");
const descripion_gasto = document.getElementById("descripcion_gasto");
const monto_gasto = document.getElementById("monto_gasto");
const xhr = new XMLHttpRequest();
let datos={};


agregar_gasto.addEventListener("click",function(){

    modal_gasto.style.display="block";
    titulo_modal.textContent="Agregar Gasto";
    for (let i = 0; i < radios_periodicidad.length; i++) {
        radios_periodicidad[i].addEventListener("change", function() {
          datos.periodicidad=this.value
        });
    }
    for (let i = 0; i < radio_tipo_gasto.length; i++) {
        radio_tipo_gasto[i].addEventListener("change", function() {
            datos.tipo_gasto=this.value
        });
    }

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

guardar_gasto.addEventListener("click",function(){
    datos.fecha_pago=fechaInput.value;
    datos.descripcion=descripcion_gasto.value;
    datos.monto=monto_gasto.value;
    console.log(datos)
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

$(document).ready(function() {
    $('#reservationdate').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true
    });
  });
