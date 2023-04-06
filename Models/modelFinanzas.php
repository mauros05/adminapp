<?php 
    class modelFinanzas {
        public function __construct(){
            require_once "Connect/Conexion.php";
        }

        public function listado_gastos(){
            $respuesta = Conexion::conectar()->prepare("
            SELECT id_gasto, g.nombre as Descripcion, cantidad as Monto,periodicidad,fecha_de_pago,tg.nombre as tipo_de_gasto 
            FROM gastos g 
            left join periodicidad p 
            on g.id_periodicidad=p.id_periodicidad 
            inner JOIN tipo_gasto tg 
            on g.id_tipo_de_gasto=tg.id_tipo_gasto 
            where g.id_usuario = 2");
            $respuesta->execute();
            return $respuesta->fetchAll(PDO::FETCH_ASSOC);
            
        }
    }
?>