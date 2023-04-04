<?php 
    class loginModel {
        public function __construct(){
            require_once("Connect/connect.php");
            $dbConnect = new Connect;
            $this->db = $dbConnect->connect();
        }
    }
?>