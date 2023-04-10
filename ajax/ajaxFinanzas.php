<?php
/* Requiere Controladores */
require_once "../Controllers/controllerFinanzas.php";
/* Requiere Modelos */
require_once "../Models/modelFinanzas.php";
var_dump($_POST);
    exit();
class ajaxfinanzas{
    public function Ajax_agregar_gasto(){
        $datos= $this->data;
        $respuesta = controllerFinanzas::ctrlAgregarGasto($datos);
        echo json_encode($respuesta);
    }
}

if(isset($_POST["data"])){
    $agregar_gastos = new ajaxfinanzas();
    $agregar_gastos->data=array(
                                $_POST["data"]
                            );
    var_dump($agregar_gastos->data);
    exit();
    $agregar_gastos->Ajax_agregar_gasto();

}