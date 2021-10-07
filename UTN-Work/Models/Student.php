<?php 

namespace Model;

use Model\User as User;
use Model\Offer as Offer;
use Model\Company as Company;

class Student extends User{


    private $studentId;
    private $careerId;
    private $fileNumber;
    private $nombre;
    private $apellido;
    private $dni;
    private $gender;
    private $birthDate;
    private $phoneNumber;

    
    //return List<Offer>
    public function listOffers(){

    }

    //return List<Company>
    public function listCompanies(){

    }

    //return Company
    public function listCompaniesByName($name){

    }

    //return List<Offer>
    public function listAppliedOffers(){

    }

    public function viewProfile(){

    }

    public function viewAcademicProfile(){

    }

    public function viewOfferDetail(Offer $offer){

    }

    public function viewCompanyProfile(Company $company){

    }

    //return bool
    public function aplliedToOffer(Offer $offer){

    }


    public function getStudentId(){ return $this->studentId; }
    public function setStudentId($studentId): self { $this->studentId = $studentId; return $this; }

    public function getCareerId(){ return $this->careerId; }
    public function setCareerId($careerId): self { $this->careerId = $careerId; return $this; }

    public function getFileNumber(){ return $this->fileNumber; }
    public function setFileNumber($fileNumber): self { $this->fileNumber = $fileNumber; return $this; }

    public function getNombre(){ return $this->nombre; }
    public function setNombre($nombre): self { $this->nombre = $nombre; return $this; }

    public function getApellido(){ return $this->apellido; }
    public function setApellido($apellido): self { $this->apellido = $apellido; return $this; }

    public function getDni(){ return $this->dni; }
    public function setDni($dni): self { $this->dni = $dni; return $this; }

    public function getGender(){ return $this->gender; }
    public function setGender($gender): self { $this->gender = $gender; return $this; }

    public function getBirthDate(){ return $this->birthDate; }
    public function setBirthDate($birthDate): self { $this->birthDate = $birthDate; return $this; }

    public function getPhoneNumber(){ return $this->phoneNumber; }
    public function setPhoneNumber($phoneNumber): self { $this->phoneNumber = $phoneNumber; return $this; }
}

?>