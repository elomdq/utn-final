<?php 

namespace Controllers;

use Models\Student as Student;
use DAO\StudentDAO as StudentDAO;
use DAO\AdminDAO as AdminDAO;


class HomeController{

    private $studentDAO;
    private $adminDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO;
        $this->adminDAO = new AdminDAO;
    }

    public function home(){
        require_once VIEWS_PATH . "validate-session.php";
        require_once(VIEWS_PATH. "header.php");
        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "home.php";
        require_once(VIEWS_PATH. "footer.php");
    }

    public function login($email, $userType) //0-student 1-admin 2-company
    {
        switch($userType)
        {
            case 0:
                $student = $this->studentDAO->studentByEmailApi($email);

                if($student != null && $student->getActive() == true )
                {
                    $_SESSION["loggedUser"] = $student;
                    $_SESSION['userType'] = $userType;
                    $this->home();
                } else
                    $this->showLoginView();
                break;
            case 1:
                $admin = $this->adminDAO->GetAdminByEmail($email);

                if($admin != null && $admin->getActive() == true )
                {
                    $_SESSION['loggedUser'] = $admin;
                    $_SESSION['userType'] = $userType;
                    $this->home();
                } else
                    $this->showLoginView();
                break;
            case 2:
                    $this->showLoginView();
                break;
            default:
                break;
        }
    }

    public function showLoginView()
    {
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH . "login.php";
        require_once(VIEWS_PATH."footer.php");
    }

    public function checkEmail(){
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH . "check-email.php";
        require_once(VIEWS_PATH."footer.php");
    }

    public function confirmData($email){
        $student = $this->studentDAO->studentByEmailApi($email);

        if($student != null && $student->getActive() == true )
        {
            require_once(VIEWS_PATH."header.php");
            require_once VIEWS_PATH . "confirm-data.php";
            require_once(VIEWS_PATH."footer.php");
        } else {
            require_once(VIEWS_PATH."header.php");
            require_once VIEWS_PATH . "check-email.php";
            require_once(VIEWS_PATH."footer.php");
        }
    }

    public function register(){
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH . "register-user.php";
        require_once(VIEWS_PATH."footer.php");
    }


    public function logout(){
        unset($_SESSION['loggedUser']); //no usar destroy ya que puedo tener cosas en el session que quiero guardar o persistir todavia
        $this->showLoginView();
    }

}

?>