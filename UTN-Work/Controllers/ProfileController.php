<?php 
namespace Controllers;


class ProfileController{

    private $studentDAO;

    public function __construct()
    {
       
    }

    public function showProfile(){
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH . "validate-session.php";
        require_once VIEWS_PATH . "nav.php" ;

        switch($_SESSION['userType'])
        {
            case 0:
                require_once VIEWS_PATH . "student-profile.php";
                break;
            case 1:
                require_once VIEWS_PATH . "admin-profile.php";
                break;
            case 2:
                break;
            default:
                break;
        }
        require_once(VIEWS_PATH."footer.php");
    }



}


?>