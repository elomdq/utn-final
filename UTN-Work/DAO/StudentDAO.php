<?php
namespace DAO;

use DAO\IStudentDAO as IStudentDAO;
use Models\Student as Student;
use Connections\StudentApiConnection as StudentApiConnection;
use \Exception as Exception;
use DAO\Connection as Connection;



class StudentDAO implements IStudentDAO{

    private $connection;
    private $tableName = 'students';
    //private $userDAO;


    public function __construct()
    {
    }
    
    public function add(Student $student){

        try{
            $query = "INSERT INTO ". $this->tableName ." (firstName, lastName, dni, birthDate, gender, id_user) VALUES(:firstName, :lastName, :dni, :birthDate, :gender, :idUser);";

            $parameters = array();
            $parameters['firstName']=$student->getFirstName();
            $parameters['lastName']=$student->getLastName();
            $parameters['dni']=$student->getDni();
            $parameters['birthDate']= str_split($student->getBirthDate(),10)[0];
            //$student->setGender( str_replace("-", " ", $student->getGender()) );
            $parameters['gender']=$student->getGender();
            $parameters['idUser']=$student->getUserId();;

            $this->connection = Connection::GetInstance();

            $this->connection->executeNonQuery($query, $parameters);
        }
        catch(Exception $e){
            throw($e);
        }
    }

    public function remove($studentId){

    }

    public function getAll(){
        


    }

    private function saveData(){
        /*$array_to_encode = array();

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
        }*/
    }

    private function retrieveData(){
        /*$this->students = array();

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
        }*/
    }


    public function studentByEmailApi($email)
    {
        $student = null;

        foreach($this->connectToApi() as $studentData)
        {
            if($studentData['email'] == $email)
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
            }
        }
        
        return $student;
    }

    private function connectToApi()
    {
        $this->studentApiConnection = new StudentApiConnection;
        $arrayStudents = json_decode($this->studentApiConnection->executeCurl(), true);
        return $arrayStudents;
    }

    public function getStudentByUserId($userId)
    {
        $query = "SELECT * FROM ".$this->tableName." WHERE id_user= \"".$userId."\";";
        $this->connection = Connection::GetInstance();

        $resultSet=$this->connection->execute($query);
        
        $student = new Student;
        $student->setStudentId($resultSet[0]['id_student']);
        $student->setCareerId($resultSet[0]['id_career']);
        $student->setFileNumber($resultSet[0]['fileNumber']);
        $student->setFirstName($resultSet[0]['firstName']);
        $student->setLastName($resultSet[0]['lastName']);
        $student->setDni($resultSet[0]['dni']);
        $student->setGender($resultSet[0]['gender']);
        $student->setPhoneNumber($resultSet[0]['id_telephone']);
        $student->setBirthDate($resultSet[0]['birthDate']);

        return $student;
    }

    /*
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
    }*/

}

?>