<?php 
namespace DAO;

use Connections\CareerApiConnection as CareerApiConnection;
use Models\Career as Career;
use DAO\ICareerDAO as ICareerDAO;
use \Exception as Exception;
use DAO\Connection as Connection;


class CareerDAO implements ICareerDAO{

    private $connection;
    private $tableName = 'careers';

    public function __construct()
    {
        
    }

    public function add(Career $career){
        try{
            $query = "INSERT INTO ".$this->tableName."(description, active) VALUES(:description, :active);";

            $parameters = array();
            $parameters['description'] = $career->getDescription();
            $parameters['active'] = $career->getActive();

            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query, $parameters);

        } catch(Exception $e){
            throw $e;
        }
    }

    public function remove($careerId){

    }

    public function getAll(){
        try{
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);

            return $resultSet;
        } catch(Exception $e){
            throw $e;
        }
    }

    public function getCareerById_Api($careerId)
    {
        $career = null;

        foreach($this->connectToApi() as $careerData)
        {
            if($careerData['careerId'] == $careerId)
            {
                
                $career = new Career;
                $career->setIdCareer($careerData['careerId']);
                $career->setDescription($careerData['description']);
                $career->setActive($careerData['active']);
            }
        }
        return $career;
    }

    public function getAll_Api(){
        $careers = array();
        try{
            foreach($this->connectToApi() as $careerData)
            {
                $career = new Career;
                $career->setIdCareer($careerData['careerId']);
                $career->setDescription($careerData['description']);
                $career->setActive($careerData['active']);
                
                array_push($careers, $career);
            }
        }  catch (Exception $e){
            throw $e;
        }
        return $careers;
    }

    private function connectToApi()
    {
        try{
            $this->careerApiConnection = new CareerApiConnection;
            $arrayCareers = json_decode($this->careerApiConnection->executeCurl(), true);
            return $arrayCareers;
        } catch (Exception $e){
            throw $e;
        }
    }

}
?>