<?php 
    class loginController {
        public function __construct(){
            require_once("Models/loginModel.php");
            $this->loginModel =  new loginModel;
        }

        public function login(){
            require_once("Views/componentes/header.php");
            require_once("Views/login.php");
            require_once("Views/componentes/footer.php");
        }
    }
?>