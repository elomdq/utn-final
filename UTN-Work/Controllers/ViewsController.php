<?php 
namespace Controllers;

use Models\Offer as Offer;
use Models\Student as Student;

class ViewsController{

    public static function header(){
        require_once(VIEWS_PATH."header.php");
    }

    public static function footer(){
        require_once(VIEWS_PATH."footer.php");
    }

    public static function loginView(){
        require_once VIEWS_PATH ."login.php";
    }

    public static function login(){
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH ."login.php";
        require_once(VIEWS_PATH."footer.php");
    }

    public static function validateEmailView(){
        require_once VIEWS_PATH ."check-email.php";
    }

    public static function confirmStudentFormView(Student $student){
        require_once VIEWS_PATH . "confirm-data.php";
    }

    public static function generatePasswordView(){
        require_once VIEWS_PATH . "generate-password.php";
    }

    // HOME

    public static function homeView(){
        require_once VIEWS_PATH. "header.php";
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."home.php";
        require_once VIEWS_PATH. "footer.php";
    }

    //Offers

    public static function offersView(){
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."offers-list.php";
        require_once VIEWS_PATH."footer.php";
    }

    public static function offerDetailsView(Offer $offer){
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."offer-details.php";
        require_once VIEWS_PATH."footer.php";
    }

    public static function addOfferView(){
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php";
        require_once VIEWS_PATH ."offer-add.php";
        require_once VIEWS_PATH."footer.php";
    }

    public static function edditOfferView(Offer $offer){
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php";
        require_once VIEWS_PATH ."offer-edit.php";
        require_once VIEWS_PATH."footer.php";
    }

}


?>