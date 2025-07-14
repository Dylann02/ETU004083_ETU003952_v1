<?php 
    function dbconnect(){
        if($db =mysqli_connect('localhost' , 'root' , '' , 'projet_final')){
            return $db;
        }
    }
?>