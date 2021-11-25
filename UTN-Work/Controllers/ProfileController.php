<?php 
namespace Controllers;

use Models\Alert as Alert;

use Config\SystemFunctions as SystemFunctions;
use Exception;

class ProfileController{

    private $studentDAO;

    public function __construct()
    {
       
    }

    public function showProfile(){
        SystemFunctions::validateSession();
        
        try{
            require_once(VIEWS_PATH . "header.php");
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
                require_once VIEWS_PATH . "company-profile.php";
                break;
            default:
                break;
            }
            require_once(VIEWS_PATH."footer.php");
        } catch(Exception $e){
            $alert = new Alert;
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            
            ViewController::erroConnectionView($alert);
        }
        
    }
}

?>
