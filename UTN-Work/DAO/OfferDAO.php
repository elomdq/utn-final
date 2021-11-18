<?php 
namespace DAO;

use Models\Offer as Offer;
use DAO\IOfferDAO as IOfferDAO;


use DAO\Connection as Connection;
use \Exception as Exception;

class OfferDAO implements IOfferDAO{

    private $connection;
    private $tableName = 'offers';

    public function __construct()
    {
    }

    public function add(Offer $offer) {

        try{
            $query = "INSERT INTO ".$this->tableName."(jobPosition, id_company, career, title, active, publicationDate, offerDescription, dueDays) VALUES(:jobPosition, :id_company, :career, :title, :active, :publicationDate, :offerDescription, :dueDays);";

            $parameters['jobPosition']=$offer->getJobPosition();
            $parameters['id_company']=$offer->getCompanyId();
            $parameters['career']=$offer->getCareerId();
            $parameters['title']=$offer->getTitle();
            $parameters['active']=$offer->getActive();
            $parameters['publicationDate']=$offer->getPublicationDate();
            $parameters['offerDescription']=$offer->getDescription();
            $parameters['dueDays']=$offer->getDueDays();

            $this->connection = Connection::GetInstance();

            $this->connection->executeNonQuery($query, $parameters);
        } catch(Exception $e) {
            throw $e;
        }
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
                $offer->setDueDays('dueDays');

                array_push($offers, $offer);
            }

            return $offers;
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function getOfferById($offerId)
    {
        try{
            $query = "SELECT * FROM ".$this->tableName." WHERE id_jobOffer= \"".$offerId."\";";
            $this->connection = Connection::GetInstance();

            $resultSet=$this->connection->execute($query);
       
            $offer = new Offer;
            $offer->setOfferId($resultSet[0]['id_jobOffer']);
            $offer->setCompanyId($resultSet[0]['id_company']);
            $offer->setJobPosition($resultSet[0]['jobPosition']);
            $offer->setCareerId($resultSet[0]['career']);
            $offer->setActive($resultSet[0]['active']);
            $offer->setTitle($resultSet[0]['title']);
            $offer->setPublicationDate($resultSet[0]['publicationDate']);
            $offer->setDescription($resultSet[0]['offerDescription']);
            $offer->setDueDays($resultSet[0]['dueDays']);

            return $offer;
        }
        catch(Exception $e){
            throw $e;
        }  
    }


    public function updateOfferById(Offer $offer)
    {
        try{
                
                $query = "UPDATE ".$this->tableName." SET 
                jobPosition=". $offer->getJobPosition()
                .", career=". $offer->getCareerId()
                .", id_company=". $offer->getCompanyId()
                .", title=\"". $offer->getTitle()
                ."\", active=". $offer->getActive()
                .", publicationDate=\"". $offer->getPublicationDate()
                ."\", dueDays=". $offer->getDueDays()
                .", offerDescription=\"". $offer->getDescription()
                . "\" WHERE id_jobOffer = ".$offer->getOfferId() .";";

                //echo "QUERY: " . $query . "<br>";
    
                $this->connection = Connection::GetInstance();
    
                $this->connection->executeNonQuery($query);
        } catch(Exception $e){
            throw $e;
        }
    }


    public function disableOffer($offerId)
    {
        try{
            $query = "UPDATE " .$this->tableName. " SET active = 0 WHERE id_jobOffer = " . $offerId. ";";

            $this->connection = Connection::GetInstance();
    
            $this->connection->executeNonQuery($query);
        }
        catch(Exception $e){
            throw $e;
        }

    }

    
    public function getIdJobOfferByTitle($title){
        try{
            $query = "SELECT (id_jobOffer) FROM ".$this->tableName." WHERE title= \"".$title."\";";
            $this->connection = Connection::GetInstance();
    
            $resultSet=$this->connection->execute($query);
    
            return $resultSet[0]['id_jobOffer'];
        } catch (Exception $e){
            throw $e;
        }

    }
}
?>
