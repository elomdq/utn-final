<?php 
namespace Controllers;

use Models\Alert as Alert;

class ViewController{

    public static function loginView(Alert $alert = null){
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH ."login.php";
        require_once(VIEWS_PATH."footer.php");
    }

    public static function homeView(){
        require_once VIEWS_PATH. "header.php";
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."home.php";
        require_once VIEWS_PATH. "footer.php";
    }

}

?>