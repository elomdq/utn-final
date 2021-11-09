<?php 
namespace DAO;

use Connections\JobPositionApiConnection as JobApiConnection;
use \Exception as Exception;
use Models\JobPosition as JobPosition;


class JobPositionDAO {

    private $connection;
    private $jobPositions;

    private function connectToApi()
    {
        try{
        $this->connection = new JobApiConnection;
        $this->jobPositions = json_decode($this->connection->executeCurl(), true);
    } catch (Exception $e){
        throw $e;
    }
        return $this->jobPositions;
    }

    public function getjobPositionById($id){
        $this->retrieveData();
        $jobPosition = null;
        foreach($this->jobPositions as $obj)
        {
            if($obj->getIdjobPosition() == $id)
                $jobPosition = $obj;
        }

        return $jobPosition;
    }

    private function retrieveData(){
        $this->jobPositions = array();

        if(file_exists($this->filename))
        {
            $jsonContent = file_get_contents($this->filename);

            $array_to_decode = ($jsonContent)? json_decode($jsonContent, true) : array(); 

            foreach($array_to_decode as $jobPositionData)
            {
                $jobPosition = new JobPosition;
                $jobPosition->setIdjobPosition($jobPositionData['jobPositionId']);
                $jobPosition->setDescripcion($jobPositionData['description']);
                $jobPosition->setCareerId($jobPositionData['jobPositionId']);

                array_push($this->jobPositions, $jobPosition);
            }
        }
    }

    public function getAll() {
        $puestos = array();

        foreach($this->connectToApi() as $JobPositionData)
        {
            $jobPosition = new JobPosition;
            $jobPosition->setIdJobPosition($JobPositionData['jobPositionId']);
            $jobPosition->setDescripcion($JobPositionData['description']);
            $jobPosition->setCareerId($JobPositionData['jobPositionId']);
        
            array_push($puestos, $jobPosition);
        }

        return $puestos;
    }




}
?>