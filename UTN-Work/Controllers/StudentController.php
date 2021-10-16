<?php 
namespace Controllers;

use Models\Student as Student;
use DAO\StudentDAO as StudentDAO;

class StudentController{

    private $studentDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO;
    }

    public function showStudentProfile(){
        require_once VIEWS_PATH . "validate-session.php";
        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "student-profile.php";
    }



}


?>