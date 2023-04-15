<?php 
    class controllerFinanzas {
        public function __construct(){

            
        }
        public static function  ctrlistado_gastos($item,$valor){
            $tabla="gastos";
            $respuesta=modelFinanzas::mdllistado_gastos($tabla,$item,$valor);
            return $respuesta;
        }
        public static function ctrlAgregarGasto($datos){
            $tabla="gastos";
            $respuesta=modelFinanzas::mdlAgregarGastos($tabla,$datos);
            return $respuesta;
        }
        public static function ctrlCunsultaGasto($datos){
            $tabla="gastos";
            $item=$datos['item'];
            $respuesta=modelFinanzas::mdlConsultaGasto($tabla,$datos,$item);
            return $respuesta;
        }
        public static function ctrlEditarGasto($datos){
            $tabla="gastos";
            $item=$datos['item'];
            $respuesta=modelFinanzas::mdlEditarGasto($tabla,$datos,$item);
            return $respuesta;
        }
        public static function ctrlEliminarGasto($datos){
            $tabla="gastos";
            $item=$datos['item'];
            $respuesta=modelFinanzas::mdlEliminarGasto($tabla,$datos,$item);
            return $respuesta;
        }
    }
?>