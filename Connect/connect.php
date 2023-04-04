<?php 
    class Connect {
        public function connect(){
            $db = mysqli_connect("localhost", "root", "", "adminapp");

            if(!$db){
                echo "Error en la conexion en la base de datos";
            }
        }
    }
?>