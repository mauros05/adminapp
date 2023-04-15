<?php

Class Conexion{
    public static function conectar(){
        try{
             $link = new PDO("mysql:host=localhost;dbname=adminapp","root","");
             $link->exec("set names utf8");
             return $link;
            } catch(PDOException $e){
                echo 'Connection error: ' .$e->getMessage();
            }
    }
}