<?php 
    require_once "Conexion.php";
    class modelFinanzas {       
        public function __construct(){
            
        }

        public static function mdllistado_gastos($tabla,$item,$valor){
            
            if($item!=null){
                $stmt=Conexion::conectar()->prepare("
                SELECT id_gasto, g.nombre as descripcion, cantidad as monto,periodicidad,DATE_FORMAT(fecha_de_pago,'%d/%m/%Y') as fecha_de_pago,tg.nombre as tipo_de_gasto 
                FROM $tabla g 
                left join periodicidad p 
                on g.id_periodicidad=p.id_periodicidad 
                inner JOIN tipo_gasto tg 
                on g.id_tipo_de_gasto=tg.id_tipo_gasto 
                where g.$item = :$item");
                $stmt->bindparam(":".$item,$valor,PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            //$stmt->close();
            $stmt=null;            
        }

        public static function mdlAgregarGastos($tabla,$datos){
            if($datos!=null){
                $stmt=Conexion::conectar()->prepare("
                SELECT id_gasto, g.nombre as descripcion, cantidad as monto,periodicidad,DATE_FORMAT(fecha_de_pago,'%d/%m/%Y') as fecha_de_pago,tg.nombre as tipo_de_gasto 
                FROM $tabla g 
                left join periodicidad p 
                on g.id_periodicidad=p.id_periodicidad 
                inner JOIN tipo_gasto tg 
                on g.id_tipo_de_gasto=tg.id_tipo_gasto 
                where g.$item = :$item");
                $stmt->bindparam(":".$item,$valor,PDO::PARAM_INT);
                $stmt->bindparam(":".$item,$valor,PDO::PARAM_INT);
                $stmt->bindparam(":".$item,$valor,PDO::PARAM_INT);
                $stmt->bindparam(":".$item,$valor,PDO::PARAM_INT);
                $stmt->bindparam(":".$item,$valor,PDO::PARAM_INT);
                $stmt->bindparam(":".$item,$valor,PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            //$stmt->close();
            $stmt=null; 
        }

    }
?>