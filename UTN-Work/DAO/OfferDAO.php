<?php 
namespace DAO;

use Models\Offer as Offer;
use DAO\IOfferDAO as IOfferDAO;


use DAO\Connection as Connection;
use \Exception as Exception;

class OfferDAO implements IOfferDAO{

    private $connection;
    private $tableName = 'offers';

    private $offers = array();
    private $filename;

    public function __construct()
    {
    }

    public function add(Offer $offer) {

        try{
            $query = "INSERT INTO ".$this->tableName."(jobPosition, id_company, career, title, active, publicationDate, offerDescription) VALUES(:jobPosition, :id_company, :career, :title, :active, :publicationDate, :offerDescription);";

            $parameters['jobPosition']=$offer->getJobPosition();
            $parameters['id_company']=$offer->getCompanyId();
            $parameters['career']=$offer->getCareerId();
            $parameters['title']=$offer->getTitle();
            $parameters['active']=$offer->getActive();
            $parameters['publicationDate']=$offer->getPublicationDate();
            $parameters['offerDescription']=$offer->getDescription();

            $this->connection = Connection::GetInstance();

            $this->connection->executeNonQuery($query, $parameters);
        } catch(Exception $e) {
            throw new Exception('Error en el llamado al DAO al agregar la oferta, ',  $e->getMessage());
        }
    }

    public function remove($offerId) {
        /*$newList = array();
        $this->retrieveData();

        foreach($this->offers as $offer)
        {
            if($offer->getOfferId != $offerId)
                array_push($newList, $offer);
        }
        
        $this->offers = $newList;
        $this->saveData();*/
    }

    public function getAll()
    {
        try{
            $query = "SELECT * FROM ".$this->tableName.";";

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);

            $offers = array();
    
            foreach($resultSet as $row)
            {
                $offer = new Offer;
                $offer->setOfferId($row['id_jobOffer']);
                $offer->setCompanyId($row['id_company']);
                $offer->setJobPosition($row['jobPosition']);
                $offer->setCareerId($row['career']);
                $offer->setTitle($row['title']);
                $offer->setActive($row['active']);
                $offer->setPublicationDate($row['publicationDate']);
                $offer->setDescription($row['offerDescription']);

                array_push($offers, $offer);
            }

            return $offers;
        }
        catch(Exception $e){
            throw $e;
        }
    }

    /*private function saveData() {
        $array_to_encode = array();
        try {
            foreach($this->offers as $offer)
            {
                $offerData['offerId'] = $offer->getOfferId();
                $offerData['title'] = $offer->getTitle();
                $offerData['description'] = $offer->getDescription();
                $offerData['companyId'] = $offer->getCompanyId();
                $offerData['salary'] = $offer->getSalary();
                $offerData['publicationDate'] = $offer->getPublicationDate();
                $offerData['careerId'] = $offer->getCareerId();
                $offerData['jobPosition'] = $offer->getCareerId();
                $offerData['active'] = $offer->getActive();

                array_push($array_to_encode, $offerData);

                $jsonEnconde = json_encode($array_to_encode, JSON_PRETTY_PRINT);
                file_put_contents($this->filename, $jsonEnconde);
            }
         } catch(Exception $e) {
                throw new Exception('Error en el llamado al DAO durante el guardado, ',  $e->getMessage());
            }
    }*/

    /*private function retrieveData() {
        $this->offers = array();

        if(file_exists($this->filename))
        {
            $jsonContent = file_get_contents($this->filename);

            $array_to_decode = ($jsonContent)? json_decode($jsonContent, true) : array(); 

            foreach($array_to_decode as $offerData)
            {
                $offer = new Offer;
                $offer->setOfferId($offerData['offerId']);
                $offer->setTitle($offerData['title']);
                $offer->setSalary($offerData['salary']);
                $offer->setDescription($offerData['description']);
                $offer->setCompanyId($offerData['companyId']);
                $offer->setPublicationDate($offerData['publicationDate']);
                $offer->setCareerId($offerData['careerId']);
                $offer->setActive($offerData['active']);

                array_push($this->offers, $offer);
            }
        }
    }*/

    public function getOfferById($offerId)
    {
        $query = "SELECT * FROM ".$this->tableName." WHERE id_jobOffer= \"".$offerId."\";";
        $this->connection = Connection::GetInstance();

        $resultSet=$this->connection->execute($query);
        
        echo "Query: ". $query ." <br><br>";
        echo "ResultSet:";
        
        var_dump($resultSet);
        echo "ResultSet: <br><br>";

        $offer = new Offer;
        $offer->setofferId($resultSet[0]['id_jobOffer']);
        $offer->setCompanyId($resultSet[0]['id_company']);
        $offer->setJobPosition($resultSet[0]['jobPosition']);
        $offer->setCareerId($resultSet[0]['career']);
        $offer->setActive($resultSet[0]['active']);
        $offer->setTitle($resultSet[0]['title']);
        $offer->setPublicationDate($resultSet[0]['publicationDate']);
        $offer->setDescription($resultSet[0]['offerDescription']);

        return $offer;
    }


    public function updateOfferById(Offer $offer, $idOffer)
    {
        try{

                $quey2 =  "UPDATE ".$this->tableName." SET jobPosition = :jobPosition 
                                                            career=:career 
                                                            title=:title
                                                            active=:active
                                                            publicationDate=:publicationDate
                                                            offerDescription=:offerDescription
                                                            WHERE id_jobOffer = \"".$idOffer."\";";
                $query = "UPDATE ".$this->tableName."(jobPosition, career, title, active, publicationDate, offerDescription) VALUES(:jobPosition, :career, :title, :active, :publicationDate, :offerDescription) WHERE id_jobOffer = \"".$idOffer."\";";

                $parameters['jobPosition']=$offer->getJobPosition();
                $parameters['id_company']=$offer->getCompanyId();
                $parameters['career']=$offer->getCareerId();
                $parameters['title']=$offer->getTitle();
                $parameters['active']=$offer->getActive();
                $parameters['publicationDate']=$offer->getPublicationDate();
                $parameters['offerDescription']=$offer->getDescription();
    
                $this->connection = Connection::GetInstance();
    
                $this->connection->executeNonQuery($query, $parameters);
        } catch(Exception $e){
            throw $e;
        }
    }
}
?>