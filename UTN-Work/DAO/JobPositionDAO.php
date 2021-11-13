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
            $this->careerApiConnection = new JobApiConnection;
            $arrayJobPositions = json_decode($this->careerApiConnection->executeCurl(), true);
            
            return $arrayJobPositions;
        } catch (Exception $e){
            throw $e;
        }
    }

    public function getPositionDescriptionById($id){
        foreach($this->connectToApi() as $careerData)
        {
            if($careerData['jobPositionId'] == $id)
            {
                return $careerData['description'];
            }
        }
    }

    public function getjobPositionById($id){
        $jobPosition = null;

        foreach($this->connectToApi() as $careerData)
        {
            if($careerData['jobPositionId'] == $id)
            {
                
                $jobPosition = new JobPosition;
                $jobPosition->setCareerId($careerData['careerId']);
                $jobPosition->setDescription($careerData['description']);
                $jobPosition->setIdJobPosition($careerData['jobPositionId']);
            }
        }
        return $jobPosition;
    }

    public function getAll() {
        $puestos = array();

        foreach($this->connectToApi() as $JobPositionData)
        {
            $jobPosition = new JobPosition;
            $jobPosition->setIdJobPosition($JobPositionData['jobPositionId']);
            $jobPosition->setDescription($JobPositionData['description']);
            $jobPosition->setCareerId($JobPositionData['careerId']);
        
            array_push($puestos, $jobPosition);
        }

        return $puestos;
    }

}
?>