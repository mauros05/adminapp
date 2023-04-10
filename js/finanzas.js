const agregar_gasto = document.getElementById("agregar_gasto");
const cerrar_modal = document.querySelectorAll(".cerrar_modal");
const modal_gasto = document.getElementById("modal_gasto");
const titulo_modal = document.getElementById("titulo_modal");
const guardar_gasto = document.getElementById("guardar");
const radios_periodicidad = document.getElementsByName("radioperiodicidad");
const radiogasto = document.getElementsByName("radiogasto");
const fechaInput = document.getElementById("fecha_gasto");
const xhr = new XMLHttpRequest();



agregar_gasto.addEventListener("click",function(){
    modal_gasto.style.display="block";
    titulo_modal.textContent="Agregar Gasto";
    for (let i = 0; i < radios_periodicidad.length; i++) {
        radios_periodicidad[i].addEventListener("change", function() {
          console.log(`Radio  ${i+1} seleccionado: ${this.value}`);
        });
    }
    for (let i = 0; i < radiogasto.length; i++) {
        radiogasto[i].addEventListener("change", function() {
          console.log(`Radio ${i+1} seleccionado: ${this.value}`);
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
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("nombre=Juan&apellido=Pérez");
});
$(document).ready(function() {
    $('#reservationdate').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true
    });
  });
