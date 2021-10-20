<?php
namespace DAO;

use DAO\IStudentDAO as IStudentDAO;
use Models\Student as Student;
use Connections\StudentConnection as StudentConnection;

class StudentDAO implements IStudentDAO{

    private $students = array();
    private $filename;
    private $studentConnection;

    public function __construct()
    {
        $this->filename = ROOT . "Data/students.json";
    }

    public function add(Student $student){
        $this->retrieveData();
        array_push($this->students, $student);
        $this->saveData();
    }

    public function remove($studentId){}

    public function getAll(){
        $this->retrieveData();
        return $this->students;
    }

    private function saveData(){
        $array_to_encode = array();

        foreach($this->students as $student)
        {
            $studentData['studentId'] = $student->getStudentId();
            $studentData['careerId'] = $student->getCareerId();
            $studentData['name'] = $student->getFirstName();
            $studentData['lastName'] = $student->getLastName();
            $studentData['fileNumber'] = $student->getFileNumber();
            $studentData['dni'] = $student->getDni();
            $studentData['phoneNumber'] = $student->getPhoneNumber();
            $studentData['gender'] = $student->getGender();
            $studentData['birthDate'] = $student->getBirthDate();
            $studentData['email'] = $student->getEmail();
            $studentData['active'] = $student->getActive();

            array_push($array_to_encode, $studentData);

            $jsonEnconde = json_encode($array_to_encode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonEnconde);
        }
    }

    private function retrieveData(){
        $this->students = array();

        if(file_exists($this->filename))
        {
            $jsonContent = file_get_contents($this->filename);

            $array_to_decode = ($jsonContent)? json_decode($jsonContent, true) : array(); 

            foreach($array_to_decode as $studentData)
            {
                $student = new Student;
                $student->setStudentId($studentData['studentId']);
                $student->setCareerId($studentData['careerId']);
                $student->setFileNumber($studentData['fileNumber']);
                $student->setFirstName($studentData['name']);
                $student->setLastName($studentData['lastName']);
                $student->setDni($studentData['dni']);
                $student->setGender($studentData['gender']);
                $student->setPhoneNumber($studentData['phoneNumber']);
                $student->setBirthDate($studentData['birthDate']);
                $student->setEmail($studentData['email']);
                $student->setActive($studentData['active']);

                array_push($this->students, $student);
            }
        }
    }


    public function getStudentByEmail($email)
    {
        //$this->retrieveData();
        $this->connectToApi();

        $student = null;

        //$student = array_filter($this->students, function ($var) {return $var->getEmail() == $email;} );

        foreach($this->students as $obj)
        {
            if($obj->getEmail() == $email)
                $student = $obj;
        }
        
        return $student;
    }

    public function connectToApi()
    {
        $this->studentConnection = new StudentConnection;
        $response = $this->studentConnection->executeCurl();
        $this->downloadData($response);
    }

    /*
    public function downloadDataToJson($apiResponse){
        
        //decodifico el json en un array
        $arrayStudents = json_decode($apiResponse, true);

        foreach($arrayStudents as $studentData)
        {
            $student = new Student;
            $student->setStudentId($studentData['studentId']);
            $student->setCareerId($studentData['careerId']);
            $student->setFileNumber($studentData['fileNumber']);
            $student->setFirstName($studentData['name']);
            $student->setLastName($studentData['lastName']);
            $student->setDni($studentData['dni']);
            $student->setGender($studentData['gender']);
            $student->setPhoneNumber($studentData['phoneNumber']);
            $student->setBirthDate($studentData['birthDate']);
            $student->setEmail($studentData['email']);
            $student->setActive($studentData['active']);
                
            array_push($this->students, $student);
        }

        $this->saveData();
    }*/

    public function downloadData($apiResponse){
        
        //decodifico el json en un array
        $arrayStudents = json_decode($apiResponse, true);

        foreach($arrayStudents as $studentData)
        {
            $student = new Student;
            $student->setStudentId($studentData['studentId']);
            $student->setCareerId($studentData['careerId']);
            $student->setFileNumber($studentData['fileNumber']);
            $student->setFirstName($studentData['firstName']);
            $student->setLastName($studentData['lastName']);
            $student->setDni($studentData['dni']);
            $student->setGender($studentData['gender']);
            $student->setPhoneNumber($studentData['phoneNumber']);
            $student->setBirthDate($studentData['birthDate']);
            $student->setEmail($studentData['email']);
            $student->setActive($studentData['active']);
                
            array_push($this->students, $student);
        }
    }

}

?>