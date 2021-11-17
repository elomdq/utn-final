<?php 
namespace DAO;

use Models\Student as Student;
use Models\Offer as Offer;

use DAO\Connection as Connection;
use DAO\OfferDAO as OfferDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\CurriculumDAO as CurriculumDAO;

use \Exception as Exception;

class StudentsXOffersDAO{

    private $connection;
    private $tableName = "students_x_offers";
    private $curriculumDAO;

    public function __construct()
    {
        $this->curriculumDAO = new CurriculumDAO;
    }

    public function add(Offer $offer, Student $student)
    {
        try{
            $query = "INSERT INTO ".$this->tableName. "(id_offer, id_student, id_curriculum) VALUES(:id_offer, :id_student, :id_curriculum) ";

            $parameters = array();
            $parameters['id_offer'] = $offer->getOfferId();
            $parameters['id_student'] = $student->getStudentId();

            $idCurriculum = $this->curriculumDAO->getCurriculumIdByOwnerId($parameters['id_student']);
            
            if($idCurriculum != 0){
                $parameters['id_curriculum'] = $idCurriculum;
            }

            $this->connection = Connection::getInstance();
            $this->connection->executeNonQuery($query, $parameters);

        }catch (Exception $e){
            throw $e;
        }
        
    }

    public function getApplicantsByOfferId($offerId){
        try{
            $query = "SELECT * FROM ". $this->tableName . " WHERE id_offer = " . $offerId . ";";

            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($query);

            $applicants = array();
            $studentDAO = new StudentDAO;
            $userDAO = new UserDAO;

            foreach($resultSet as $row)
            {
                $student = $studentDAO->getStudentByStudentId($row['id_student']);
                $student->setEmail($userDAO->getUserById($student->getUserId())['email']);

                array_push($applicants, $student);
            }

            return $applicants;

        }catch(Exception $e){
            throw $e;
        }
    }


    public function isStudentInOffer($studentId, $offerId){
        
        try{
            $flag = false;
            
            $query = "SELECT (id_student) FROM ".$this->tableName." WHERE id_offer = " . $offerId .";";

            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($query);

            foreach($resultSet as $row){
                if($row['id_student'] == $studentId)
                    $flag = true;
            }

            return $flag;
        }catch(Exception $e){
            throw $e;
        }
    }

}

?>