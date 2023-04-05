<?php 
/*     require_once("Controllers/loginContoller.php");
    
    $loginController = new loginController; 

    $metodo = $_SERVER["REQUEST_METHOD"];

    if($metodo == "GET"){
        $loginController->login();
    }
 */

/*  require_once "Connect/Conexion.php";

  $respuesta = Conexion::conectar()->prepare("SELECT * FROM usuarios ");
  $respuesta->execute();
  $users = $respuesta->fetchAll(PDO::FETCH_ASSOC);
 var_dump($users); */

/* Requiere Controladores */
require_once "Controllers/plantillaController.php";



$plantilla = new PlantillaController();
$plantilla->ctrPlantilla();