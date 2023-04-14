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
    public function Ajax_consulta_gasto(){
        $datos= $this->data;
        $respuesta = controllerFinanzas::ctrlCunsultaGasto($datos);
        echo json_encode($respuesta);
    }
    public function Ajax_eliminar_gasto(){
        $datos= $this->data;
        $respuesta = controllerFinanzas::ctrlEliminarGasto($datos);
        echo json_encode($respuesta);
    }
}

switch($datos['accion']){
    case 'guardar':
        $agregar_gastos = new ajaxfinanzas();
        $agregar_gastos->data=$datos;
        $agregar_gastos->Ajax_agregar_gasto();
    break;
    case 'consulta':
        $editar_gastos = new ajaxfinanzas();
        $editar_gastos->data=$datos;
        $editar_gastos->Ajax_consulta_gasto();
    break;
}


