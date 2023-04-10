const agregar_gasto = document.getElementById("agregar_gasto");
const cerrar_modal = document.querySelectorAll(".cerrar_modal");
const modal_gasto = document.getElementById("modal_gasto");
const titulo_modal = document.getElementById("titulo_modal");

agregar_gasto.addEventListener("click",function(){
    modal_gasto.style.display="block";
    titulo_modal.textContent="Agregar Gasto";

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