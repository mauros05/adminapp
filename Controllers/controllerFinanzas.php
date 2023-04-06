<?php 
    class controllerFinanzas {
        public function __construct(){
            require_once "Models/modelFinanzas.php";
            
        }
        public function listado_gastos(){
            $modeloFinanzas = new modelFinanzas;
            $lista_gastos=$modeloFinanzas->listado_gastos();
            require_once "views/Finanzas/viewGastos.php";
        }
    }
?>