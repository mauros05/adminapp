<?php 
    class controllerFinanzas {
        public function __construct(){

            
        }
        public static function  ctrlistado_gastos($item,$valor){
            $tabla="gastos";
            $respuesta=modelFinanzas::mdllistado_gastos($tabla,$item,$valor);
            return $respuesta;
        }
    }
?>