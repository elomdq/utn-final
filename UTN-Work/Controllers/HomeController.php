<?php 

namespace Controllers;

use Config\SystemFunctions;
use DAO\StudentDAO as StudentDAO;
use DAO\UserDAO as UserDAO;
use DAO\AdminDAO as AdminDAO;
use DAO\CompanyDAO as CompanyDAO;

use Models\Student as Student;
use Models\User as User;
use Models\Alert as Alert;


class HomeController{

    private $studentDAO;
    private $adminDAO;
    private $userDAO;
    private $companyDao;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO;
        $this->userDAO = new UserDAO;
        $this->adminDAO = new AdminDAO;
        $this->companyDao = new CompanyDAO;
    }


    public function showLoginView(Alert $alert = NULL)
    {
        ViewController::loginView();
    }

    public function showHome(){
        SystemFunctions::validateSession();
        ViewController::homeView();
    }

    public function login($email,$password) {
        $alert = new Alert("","");

        if(!empty($email) && !empty($password)) {
            
            $userData = $this->userDAO->getUserByEmail($email);
            //echo $userData[0]['userType'] . "<br>";

            if(!empty($userData)) {
                
                if($userData[0]['pass'] == $password) {

                    if($userData[0]['active'] == true)
                    {
                                           
                        if($userData[0]['userType'] == 1){
                            $admin = $this->adminDAO->GetAdminByEmail($email);
                            $_SESSION["loggedUser"] = $admin;
                        } else if ($userData[0]['userType'] == 0) {
                            $student = $this->studentDAO->getStudentByUserId($userData[0]['id_user']);
                            $_SESSION["loggedUser"] = $student;
                        } else {
                            $company = $this->companyDao->getCompanyByIdUser($userData[0]['id_user']);
                            $_SESSION["loggedUser"] = $company;
                        }

                        $_SESSION["loggedUser"]->setUserId($userData[0]['id_user']);
                        $_SESSION["loggedUser"]->setEmail($userData[0]['email']);
                        $_SESSION["loggedUser"]->setPassword($userData[0]['pass']);
                        $_SESSION["loggedUser"]->setActive($userData[0]['active']);
                        $_SESSION["loggedUser"]->setUserType($userData[0]['userType']);

                        $_SESSION['userType'] = $userData[0]['userType'];

                        $this->showHome();

                    } else {
                        $alert->setType("danger");
                        $alert->setMessage("Usuario dado de baja, comuniquese con la UTN.");
                        $this->showLoginView($alert);
                    } 
                } else {
                    $alert->setType("danger");
                    $alert->setMessage("Se introdujo mal la password.");
                    $this->showLoginView($alert);
                }
                
            } else {
                $alert->setType("warning");
                $alert->setMessage("No se encontro el email. Proba con registrarte amigo.");
                $this->showLoginView($alert);
            }
        } else {
            $alert->setType("warning");
            $alert->setMessage("Falta algun dato.");
            $this->showLoginView($alert);
        }
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
            $student = new Student();
            $student->setFirstName($_POST['firstName']);
            $student->setLastName($_POST['lastName']);
            $student->setDni($_POST['dni']);
            $student->setBirthDate($_POST['birthDate']);
            $student->setGender($_POST['gender']);
            $student->setPhoneNumber($_POST['phoneNumber']);
            $student->setCareerId($_POST['careerId']);
            $student->setEmail($_POST['email']);
            $student->setActive($_POST['active']);
            $student->setUserType(0);

            $_SESSION['student'] = $student;

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

            $this->userDAO->add($_SESSION['student']->getEmail(), $_SESSION['student']->getActive(),$_SESSION['student']->getUserType(), $_SESSION['student']->getPassword());

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