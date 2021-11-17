<?php 
namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use Models\File as Curriculum;

class CurriculumDAO{

    private $connection;
    private $tableName = 'curriculums';

    public function add(Curriculum $Curriculum){
        try{
            $query = "INSERT INTO ".$this->tableName."(id_student, url) VALUES(:id_student, :url);";

            $parameters = array();
            $parameters['id_student'] = $Curriculum->getIdOwner();
            $parameters['url'] = $Curriculum->getUrl();

            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query, $parameters);

        } catch(Exception $e){
            throw $e;
        }
    }

    public function getURLByOwnerId($idOwner)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_owner = " . $idOwner . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = $resultSet[0]['url'];
            return $url;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getCurriculumIdByOwnerId($idOwner)
    {
        try {
            $query = "SELECT (id_curriculum) FROM " . $this->tableName . " WHERE id_student = " . $idOwner . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = $resultSet[0]['url'];
            return $url;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getURLByCurriculumId($idCurriculum)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_curriculum = " . $idCurriculum . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = $resultSet[0]['url'];
            return $url;
        } catch (Exception $e) {
            throw $e;
        }
    }
    

    public function deleteURLByCurriculumId($idCurriculum)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE id_curriculum = " . $idCurriculum . ";";
            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query);
        } catch (Exception $e) {
            throw $e;
        }
    }

}

?>