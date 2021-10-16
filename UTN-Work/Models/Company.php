<?php 

namespace Models;

use Models\User as User;
use Models\Student as Student;
use Models\Offer as Offer;

class Company extends User{

    private $companyName;
    private $telephone;
    private $city;
    private $direction;
    private $cuit;


    public function viewProfile()
    {
        
    }

    //return List<Offer>, habria que ver si hay que agregar una variable repo de ofertas de la empresa que levante de la base de datos, o 
    //si cada ves que llamo a esta funcion conecto con la base de datos en funcion al userId o un id de la empresa (como el CUIT u otro generado)
    public function listOffers(){

    }

    public function viewOfferDetails(Offer $offer){

    }

    //return lista de estudiantes
    public function viewApplicants(Offer $offer){

    }


    public function getCompanyName(){ return $this->companyName; }
    public function setCompanyName($companyName): self { $this->companyName = $companyName; return $this; }

    public function getTelephone(){ return $this->telephone; }
    public function setTelephone($telephone): self { $this->telephone = $telephone; return $this; }

    public function getCity(){ return $this->city; }
    public function setCity($city): self { $this->city = $city; return $this; }

    public function getDirection(){ return $this->direction; }
    public function setDirection($direction): self { $this->direction = $direction; return $this; }

    public function getCuit(){ return $this->cuit; }
    public function setCuit($cuit): self { $this->cuit = $cuit; return $this; }
}

?>