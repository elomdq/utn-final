<?php 

namespace Models;

use Models\User as User;

class Admin extends User{

    private $name;
    private $lastName;

    public function viewProfile()
    {
        
    }

    public function createUser(){}

    public function deactivateUser(){}
    
    //nose para que hicimos esta funcion - return: User
    public function modifyUserEmail($email){}

    public function listCompanies(){}

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

    //return company
    public function createCompany(){}

    //return admin
    public function createAdmin(){}

}

?>