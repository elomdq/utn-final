<?php 
namespace Controllers;

use Config\SystemFunctions as SystemFunctions;

use Models\Student as Student;
use DAO\StudentDAO as StudentDAO;
use Models\Alert as Alert;

class StudentController{

    private $studentDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO;
    }


}


?>