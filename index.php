<?php 
    require_once("Controllers/loginContoller.php");
    
    $loginController = new loginController; 
    $metodo = $_SERVER["REQUEST_METHOD"];
    if($metodo == "GET"){
        $loginController->login();
    }
?>
