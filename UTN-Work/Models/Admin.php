<?php 

namespace Models;

use Models\User as User;

class Admin extends User{

    private $name;
    private $lastName;

    function __construct($name,$lastName){
        $this->setName($name);
        $this->setLastName($lastName);
    }

    public function viewProfile()
    {
        
    }

    public function createUser(){}

    public function deactivateUser(){}
    
    //nose para que hicimos esta funcion - return: User
    public function modifyUserEmail($email){}

    public function listSudents(){}

    public function listOffers(){}

    //No deberiamos tener esto como una funcion de la oferta? y la oferta tener un array de aplicantes 
    public function listApplicants(Offer $offer){}


    //return offer
    public function creatOffer(){}

    //return offer
    public function modifyOffer(){}

    //return bool
    public function deactivateOffer(){}


    //return admin
    public function createAdmin(){}

    public function getName(){ return $this->name; }
    public function getLastName(){ return $this->lastName; }
    public function setName($name): self { $this->name = $name; return $this; }
    public function setLastName($lastName): self { $this->lastName = $lastName; return $this; }

}

?>