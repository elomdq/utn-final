<?php 
namespace DAO;

use Models\Offer as Offer;
use DAO\IOfferDAO as IOfferDAO;

class OfferDAO implements IOfferDAO{

    private $offers = array();
    private $filename;

    public function __construct()
    {
        $this->filename = ROOT . "Data/offers.json";
    }

    public function add(Offer $offer){
        $this->retrieveData();
        array_push($this->offers, $offer);
        $this->saveData();
    }

    public function remove($offerId){
        $newList = array();
        $this->retrieveData();

        foreach($this->offers as $offer)
        {
            if($offer->getOfferId != $offerId)
                array_push($newList, $offer);
        }
        
        $this->offers = $newList;
        $this->saveData();
    }

    public function getAll(){
        $this->retrieveData();
        return $this->offers;
    }

    private function saveData(){
        $array_to_encode = array();

        foreach($this->offers as $offer)
        {
            $offerData['offerId'] = $offer->getOfferId();
            $offerData['title'] = $offer->getTitle();
            $offerData['description'] = $offer->getDescription();
            $offerData['companyId'] = $offer->getCompanyId();
            $offerData['salary'] = $offer->getSalary();
            $offerData['publicationDate'] = $offer->getPublicationDate();
            $offerData['careerId'] = $offer->getCareerId();
            $offerData['active'] = $offer->getActive();

            array_push($array_to_encode, $offerData);

            $jsonEnconde = json_encode($array_to_encode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonEnconde);
        }
    }

    private function retrieveData(){
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
    }

    public function getOfferById($offerId)
    {
        $this->retrieveData();
        $offer = null;
        foreach($this->offers as $obj)
        {
            if($obj->getOfferId() == $offerId)
                $offer = $obj;
        }

        return $offer;
    }
}
?>