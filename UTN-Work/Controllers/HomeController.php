<?php 

namespace Controllers;

use Models\Student as Student;
use DAO\StudentDAO as StudentDAO;

class HomeController{

    private $studentDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO;
    }

    public function home(){
        require_once VIEWS_PATH . "validate-session.php";
        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "home.php";
    }

    public function login($email)
    {
        $student = $this->studentDAO->GetStudentByEmail($email);

        if($email == 'admin@admin')
        {
            $admin = 'admin';
            $_SESSION["loggedUser"] =  $student;
            $_SESSION["admin"]=$admin;
            $this->home();
        }
        else 
        {
            if($student != null && $student->getActive() == true )
                {
                    $_SESSION["loggedUser"] = $student;
                    $this->home();
                } else
                    $this->showLoginView();
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