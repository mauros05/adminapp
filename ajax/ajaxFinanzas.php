<?php
/* Requiere Controladores */
require_once "../Controllers/controllerFinanzas.php";
/* Requiere Modelos */
require_once "../Models/modelFinanzas.php";
$datos = json_decode(file_get_contents('php://input'), true);
class ajaxfinanzas{
    public function Ajax_agregar_gasto(){
        $datos= $this->data;
        $respuesta = controllerFinanzas::ctrlAgregarGasto($datos);
        echo json_encode($respuesta);
    }
}

if($datos!=null){
    
    $agregar_gastos = new ajaxfinanzas();
    $agregar_gastos->data=$datos;

 
    $agregar_gastos->Ajax_agregar_gasto();

}

