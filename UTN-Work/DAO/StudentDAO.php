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
            $query = "INSERT INTO ". $this->tableName ." (firstName, lastName, dni, birthDate, gender, id_user, id_career, filenumber) VALUES(:firstName, :lastName, :dni, :birthDate, :gender, :idUser, :id_career, :filenumber);";

            $parameters = array();
            $parameters['firstName']=$student->getFirstName();
            $parameters['lastName']=$student->getLastName();
            $parameters['dni']=$student->getDni();
            $parameters['birthDate']= str_split($student->getBirthDate(),10)[0];
            $parameters['gender']=$student->getGender();
            $parameters['idUser']=$student->getUserId();
            $parameters['id_career'] = $student->getCareerId();
            $parameters['filenumber'] = $student->getFileNumber();


            $this->connection = Connection::GetInstance();

            $this->connection->executeNonQuery($query, $parameters);
        }
        catch(Exception $e){
            throw($e);
        }
    }

    public function getAll(){
        
        try{

            $query = "SELECT * FROM ". $this->tableName ;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->execute($query);

            $students = array();

            foreach($resultSet as $row){
                $student = new Student;
                $student->setUserId($row['id_user']);
                $student->setFirstName($row['firstName']);
                $student->setLastName($row['lastName']);
                $student->setDni($row['dni']);
                $student->setBirthDate($row['birthDate']);
                $student->setGender($row['gender']);
                $student->setPhoneNumber($row['phoneNumber']);
            }
            

            return $students;

        }catch(Exception $e){
            throw $e;
        }
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
        $student->setPhoneNumber($resultSet[0]['phoneNumber']);
        $student->setBirthDate($resultSet[0]['birthDate']);

        return $student;
    }

    public function getStudentByStudentId($studentId)
    {
        $query = "SELECT * FROM ".$this->tableName." WHERE id_student= \"".$studentId."\";";
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
        $student->setPhoneNumber($resultSet[0]['phoneNumber']);
        $student->setBirthDate($resultSet[0]['birthDate']);
        $student->setUserId($resultSet[0]['id_user']);

        return $student;
    }

    
}

?>