<?php 
namespace Config;

class SystemFunctions {
    
    public static function validateSession(){
        if(!isset($_SESSION["loggedUser"]))
        header("location:login.php");
    }
}
?>`