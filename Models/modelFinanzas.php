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
                where g.$item = :$item AND estatus = 1");
                $stmt->bindparam(":".$item,$valor,PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            //$stmt->close();
            $stmt=null;            
        }

        public static function mdlAgregarGastos($tabla,$datos){
            $valor=2;
            if($datos!=null){
                $stmt=Conexion::conectar()->prepare("
                INSERT INTO $tabla
                (id_usuario, nombre, cantidad, id_periodicidad, fecha_de_pago, id_tipo_de_gasto) 
                VALUES (:dato1,:dato2,:dato3,:dato4,:dato5,:dato6)");
                $stmt->bindparam(':dato1',$valor,PDO::PARAM_INT);
                $stmt->bindparam(':dato2',$datos['descripcion'],PDO::PARAM_STR);
                $stmt->bindparam(':dato3',$datos['monto'],PDO::PARAM_INT);
                $stmt->bindparam(':dato4',$datos['periodicidad'],PDO::PARAM_INT);
                if($datos['fecha_pago']==""){
                    $fecha=NULL;
                    $stmt->bindParam(':dato5',$fecha, PDO::PARAM_NULL);
                }else{
                    $fecha=date('Y/m/d', strtotime($datos['fecha_pago']));
                    $stmt->bindparam(':dato5',$fecha,PDO::PARAM_STR);
                }
                $stmt->bindparam(':dato6',$datos['tipo_gasto'],PDO::PARAM_INT);
                $stmt->execute();
            }
            //$stmt->close();
            $stmt=null; 
        }
        public static function mdlConsultaGasto($tabla,$datos,$item){
            if($datos!=null){
                $stmt=Conexion::conectar()->prepare("
                SELECT id_gasto,nombre, cantidad, id_periodicidad, fecha_de_pago, id_tipo_de_gasto FROM $tabla WHERE $item =:dato");
                $stmt->bindparam(':dato',$datos['id'],PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
            //$stmt->close();
            $stmt=null;            
        }

        public static function mdlEditarGasto($tabla,$datos,$item){
            $campos_modificiados=NULL;
            if($datos!=null){
                foreach ($datos as $campo => $valor) {
                    if($campo=="cantidad" ||$campo=="id_periodicidad" ||$campo=="id_tipo_de_gasto"||$campo=="nombre"||$campo=="fecha_de_pago"){
                        $campos_actualizados[] = "$campo = :$campo";
                    }
                }
                $query="Update $tabla SET ";
                $query .=implode(',', $campos_actualizados);
                $query .=" Where $item = :dato";
                $stmt=Conexion::conectar()->prepare($query);
                foreach ($datos as $campo => $valor) {
                    if($campo=="cantidad" ||$campo=="id_periodicidad" ||$campo=="id_tipo_de_gasto"){
                        $stmt->bindParam(":$campo", $datos["$campo"],PDO::PARAM_INT);
                    }
                    if($campo=="nombre"){
                        $stmt->bindParam(":$campo", $datos["$campo"],PDO::PARAM_STR);
                    }
                    if($campo=="fecha_de_pago"){
                        if($valor==""){
                            $fecha=NULL;
                            $stmt->bindParam(":$campo",$fecha, PDO::PARAM_NULL);
                        }else{
                            $fecha=date('Y/m/d', strtotime($datos["$campo"]));
                            $stmt->bindParam(":$campo",$fecha ,PDO::PARAM_STR);
                        }
                    }
                }
                $stmt->bindParam(':dato',$datos['id'],PDO::PARAM_INT);
                echo $datos['id'];
                $stmt->execute();
                return $stmt;  
            }
            
            //$stmt->close();
            $stmt=null;            
        }

        public static function mdlEliminarGasto($tabla,$datos,$item){
            if($datos!=null){
                $stmt=Conexion::conectar()->prepare("
                Update $tabla SET estatus=0 WHERE $item = :dato");
                $stmt->bindparam(':dato',$datos['id'],PDO::PARAM_INT);
                $stmt->execute();
                return $stmt;
            }
            
            //$stmt->close();
            $stmt=null;            
        }

    }
?>