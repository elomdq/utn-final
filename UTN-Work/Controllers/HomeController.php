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
        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "home.php";
    }

    public function login($email, $userType) //0-student 1-admin 2-company
    {
        switch($userType)
        {
            case 0:
                $student = $this->studentDAO->GetStudentByEmail($email);

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
                break;
            default:
                break;
        }
    }

    public function showLoginView()
    {
        require_once VIEWS_PATH . "login.php";
    }

    public function logout(){
        session_destroy();
        $this->showLoginView();
    }

}

?>