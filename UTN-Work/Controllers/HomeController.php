<?php 

namespace Controllers;

use Models\Student as Student;
use DAO\StudentDAO as StudentDAO;
use DAO\UserDAO as UserDAO;
use DAO\AdminDAO as AdminDAO;
use DAO\CompanyDAO as CompanyDAO;
use Models\User as User;


class HomeController{

    private $studentDAO;
    private $adminDAO;
    private $userDao;
    private $companyDao;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO;
        $this->userDAO = new userDAO;
        $this->adminDAO = new AdminDAO;
        $this->companyDao = new CompanyDAO;
    }

    public function home(){
        require_once VIEWS_PATH ."validate-session.php";
        require_once VIEWS_PATH. "header.php";
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."home.php";
        require_once VIEWS_PATH. "footer.php";
    }

    public function login($email,$password) {
        if(!empty($email) && !empty($password)) {
            $userData = $this->userDAO->getUserByEmail($email);

            if(!empty($userData)) {
                $user = new User;
                $user->setUserId($userData[0]['id_user']);
                $user->setEmail($userData[0]['email']);
                $user->setPassword($userData[0]['pass']);
                $user->setActive($userData[0]['active']);
                $user->setUserType($userData[0]['userType']);

                if($user->getPassword() == $password) {
                    if($user->getUserType() == 1){
                        $admin = $this->adminDAO->GetAdminByEmail($email);
                        $_SESSION["loggedUser"] = $admin;
                    } elseif($user->getUserType() == 0) {
                        $student = $this->studentDAO->getStudentByUserId($user->getUserId());
                        $_SESSION["loggedUser"] = $student;
                    } else {
                        $company = $this->companyDao->getCompanyByIdUser($user->getUserId());
                        $_SESSION["loggedUser"] = $company;
                    }
                    $_SESSION['userType'] = $user->getUserType();
                    $this->home();
                } else {
                    $this->showLoginView();
                    echo '<script language="javascript">';
                    echo 'alert("Se introdujo mal la password.")';
                    echo '</script>';
                }
            } else {
                $this->showLoginView();
                echo '<script language="javascript">';
                echo 'alert("No se encontro el email")';
                echo '</script>';
            }
        } else {
            $this->showLoginView();
            echo '<script language="javascript">';
            echo 'alert("Algo se rompio y fue feo")';
            echo '</script>';
        }
    }

    public function login2($email, $password, $userType) //0-student 1-admin 2-company
    {

        $userData = $this->userDAO->getUserByEmail($email);
       
        if(!empty($userData))
        {
            if($password == $userData[0]['pass'])
            {
                switch($userType)
                {
                case 0:
                    $student = $this->studentDAO->getStudentByUserId($userData[0]['id_user']);

                    $student->setUserId($userData[0]['id_user']);
                    $student->setEmail($userData[0]['email']);
                    $student->setPassword($userData[0]['pass']);
                    $student->setActive($userData[0]['active']);

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
        } else{
            $this->showLoginView();
        }

    }

    public function showLoginView()
    {
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH ."login.php";
        require_once(VIEWS_PATH."footer.php");
    }

    public function checkEmail(){
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH ."check-email.php";
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
            echo '<script language="javascript">';
            echo 'alert("No se encontro el email")';
            echo '</script>';
            require_once(VIEWS_PATH."footer.php");
        }
    }

    public function generatePassword(...$values){

        if($_POST)
        {
            require_once(VIEWS_PATH."header.php");
            require_once VIEWS_PATH . "generate-password.php";
            require_once(VIEWS_PATH."footer.php");
        }
    }

    public function register(...$values){
        if($_POST)
        {
            if(isset($_POST['password']))
                if(isset($_SESSION['student']))
                    $_SESSION['student']->setPassword($_POST['password']);

            /*$parameters = array();
            $parameters['email'] = $_SESSION['student']->getEmail();
            $parameters['password'] = $_SESSION['student']->getPassword();
            $parameters['active'] = $_SESSION['student']->getActive();*/

            $this->userDAO->add($_SESSION['student']->getEmail(), $_SESSION['student']->getActive(), $_SESSION['student']->getPassword(),$_SESSION['student']->getUserType());

            $_SESSION['student']->setUserId($this->userDAO->getUserIdByEmail($_SESSION['student']->getEmail()));

            $this->studentDAO->add($_SESSION['student']);

            unset($_SESSION['student']);

            $this->showLoginView();
        }
    }


    public function logout(){
        unset($_SESSION['loggedUser']); //no usar destroy ya que puedo tener cosas en el session que quiero guardar o persistir todavia
        $this->showLoginView();
    }

}

?>