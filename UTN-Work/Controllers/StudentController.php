<?php 
namespace Controllers;

use Config\SystemFunctions as SystemFunctions;
use \Exception;

use Models\Student as Student;
use Models\Alert as Alert;

use DAO\StudentDAO as StudentDAO;
use DAO\StudentsXOffersDAO as StudentsXOffersDAO;



class StudentController{

    private $studentDAO;
    private $studentsXoffersDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO;
        $this->studentsXoffersDAO = new StudentsXOffersDAO;
    }


    public function historicOfferApplications($studentId){
        SystemFunctions::validateSession();

        try{
            $alert = new Alert;
            $appliedList = $this->studentsXoffersDAO->getOffersListByStudentId($studentId);
            
            if(empty($appliedList))
            {
                $alert->setType('warning');
                $alert->setMessage($alert->getMessage() . "No se ha postulado a ninguna propuesta.");
            }

            require_once VIEWS_PATH."header.php";
            require_once VIEWS_PATH ."nav.php";
            require_once VIEWS_PATH."applied-list.php";
            require_once VIEWS_PATH."footer.php";
        }
        catch(Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            $ViewController->homeView($alert);
        }
    }
}


?>