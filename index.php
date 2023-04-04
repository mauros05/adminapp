<?php 
/*     require_once("Controllers/loginContoller.php");
    
    $loginController = new loginController; 

    $metodo = $_SERVER["REQUEST_METHOD"];

    if($metodo == "GET"){
        $loginController->login();
    }
 */

 require_once "Models/Conexion.php";

  $respuesta = Conexion::conectar()->prepare("SELECT * FROM usuarios");
  echo $respuesta;
?>