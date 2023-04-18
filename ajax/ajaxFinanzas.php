<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    public function Ajax_editar_gasto(){
        $datos= $this->data;
        $respuesta = controllerFinanzas::ctrlEditarGasto($datos);
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
        $consulta_gasto = new ajaxfinanzas();
        $consulta_gasto->data=$datos;
        $consulta_gasto->Ajax_consulta_gasto();
    break;
    case 'editar':
        $editar_gastos = new ajaxfinanzas();
        $editar_gastos->data=$datos;
        $editar_gastos->Ajax_editar_gasto();
    break;
    case 'borrar':
        $eliminar_gastos = new ajaxfinanzas();
        $eliminar_gastos->data=$datos;
        $eliminar_gastos->Ajax_eliminar_gasto();
    break;
}


