<?php 
    function dbconnect(){
        if($db =mysqli_connect('localhost' , 'root' , '' , 'projet_final')){
        //if($db =mysqli_connect('localhost','ETU003952' ,'QGzd0wVR' ,'db_s2_ETU003952')){
            return $db;
        }
    }
?>