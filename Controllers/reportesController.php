<?php
 class ReportesController{
    public function __construct(){
    }

    public function index(){
      require_once("Views/componentes/header.php");
      require_once "Views/resumenFinanciero.php";
      require_once("Views/componentes/footer.php");

    }
 }
?>