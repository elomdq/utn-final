<?php 

namespace Models;

use Models\User as User;
//use Models\Student as Student;
use Models\Offer as Offer;

class Company extends User{

    private $companyName;
    private $telephone;
    private $city;
    private $address;
    private $cuit;

    public function getCompanyName(){ return $this->companyName; }
    public function setCompanyName($companyName): self { $this->companyName = $companyName; return $this; }

    public function getTelephone(){ return $this->telephone; }
    public function setTelephone($telephone): self { $this->telephone = $telephone; return $this; }

    public function getCity(){ return $this->city; }
    public function setCity($city): self { $this->city = $city; return $this; }

    public function getCuit(){ return $this->cuit; }
    public function setCuit($cuit): self { $this->cuit = $cuit; return $this; }

    public function getAddress(){ return $this->address; }
    public function setAddress($address): self { $this->address = $address; return $this; }
}

?>