<?php 
namespace DAO;

use Connections\CareerConnection;
use Models\Career as Career;
use DAO\ICareerDAO as ICareerDAO;

class CareerDAO implements ICareerDAO{

    private $careers = array();
    private $filename;
    private $careerConnection; 

    public function __construct()
    {
        $this->filename = ROOT . "Data/careers.json";

        if(!file_exists($this->filename)){
            $this->careerConnection = new CareerConnection;
            $this->downloadDataToJson($this->careerConection->executeCurl());
        }
    }

    public function add(Career $career){
        $this->retrieveData();
        array_push($this->careers, $career);
        $this->saveData();
    }

    public function remove($careerId){}

    public function getAll(){
        $this->retrieveData();
        return $this->careers;
    }

    private function saveData(){
        $array_to_encode = array();

        foreach($this->careers as $career)
        {
            $careerData['idCareer'] = $career->getIdCareer();
            $careerData['description'] = $career->getDescription();
            $careerData['active'] = $career->getActive();
            
            array_push($array_to_encode, $careerData);

            $jsonEnconde = json_encode($array_to_encode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonEnconde);
        }
    }

    private function retrieveData(){
        $this->careers = array();

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
        }
    }

    public function getCareerById($id){
        $this->retrieveData();
        $career = null;
        foreach($this->careers as $obj)
        {
            if($obj->getIdCareer() == $id)
                $career = $obj;
        }

        return $career;
    }


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
    } 

}
?>