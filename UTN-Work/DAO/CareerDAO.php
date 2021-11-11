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
            echo "El problema: ".$e->getMessage();
            throw new Exception('Error!! ',  $e->getMessage());
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
            echo "El problema: ".$e->getMessage();
            throw new Exception('Error!! ',  $e->getMessage());
        }
    }

    private function saveData(){
        /*$array_to_encode = array();

        foreach($this->careers as $career)
        {
            $careerData['idCareer'] = $career->getIdCareer();
            $careerData['description'] = $career->getDescription();
            $careerData['active'] = $career->getActive();
            
            array_push($array_to_encode, $careerData);

            $jsonEnconde = json_encode($array_to_encode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonEnconde);
        }*/
    }

    private function retrieveData(){
        /*$this->careers = array();

        if(file_exists($this->filename))
        {
            $jsonContent = file_get_contents($this->filename);

            $array_to_decode = ($jsonContent)? json_decode($jsonContent, true) : array(); 

            foreach($array_to_decode as $careerData)
            {
                $career = new Career;
                $career->setIdCareer($careerData['idCareer']);
                $career->setDescription($careerData['description']);
                $career->setActive($careerData['active']);

                array_push($this->careers, $career);
            }
        }*/
    }

   /* public function getCareerById($id){
        $this->retrieveData();
        $career = null;
        foreach($this->careers as $obj)
        {
            if($obj->getIdCareer() == $id)
                $career = $obj;
        }

        return $career;
    }*/

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

        foreach($this->connectToApi() as $careerData)
        {
            $career = new Career;
            $career->setIdCareer($careerData['careerId']);
            $career->setDescription($careerData['description']);
            $career->setActive($careerData['active']);
            
            array_push($careers, $career);
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
            echo "El problema: ".$e->getMessage();
            throw new Exception('Error!! ',  $e->getMessage());
        }
    }

    /*
    public function downloadDataToJson($apiResponse){
        
        //decodifico el json en un array
        $arrayStudents = json_decode($apiResponse, true);

        foreach($arrayStudents as $careerData)
        {
            $career = new Career;
            $career->setIdCareer($careerData['careerId']);
            $career->setDescription($careerData['description']);
            $career->setActive($careerData['active']);
                
            array_push($this->careers, $career);
        }

        $this->saveData();
    }*/

}
?>