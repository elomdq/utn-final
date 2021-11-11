<?php 

namespace Controllers;

use Config\SystemFunctions;
use DAO\OfferDAO as OfferDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;

use DAO\StudentsXOffersDAO as StudentsXOffers;
use Models\Offer as Offer;

class OfferController{

    private $offersDAO;
    private $studentsXoffers;
    private $puestos;
    private $careerDAO; 
    private $companyDao;
    

    public function __construct()
    {
        $this->offersDAO = new OfferDAO;
        $this->studentsXoffers = new StudentsXOffers;
        $this->puestos = new JobPositionDAO;
        $this->careerDAO = new CareerDAO;
        $this->companyDao = new CompanyDAO;
    }

    public function showOffersList(){
        SystemFunctions::validateSession();
        ViewsController::offersView();
    }

    public function showOfferDetails($offerId){
        SystemFunctions::validateSession();

        $offer = $this->offersDAO->getOfferById($offerId);
        ViewsController::offerDetailsView($offer);
    }

    public function addView($message = ""){
        SystemFunctions::validateSession();
        ViewsController::addOfferView();
    }

    public function editView($offerId, $message = "")
    {
        $offer = new Offer;
        $offer = $this->offersDAO->getOfferById($offerId);

        $listJobsPositions = $this->puestos->getAll();
        $listaCarreras = $this->careerDAO->getAll_Api();
        $companyList = $this->companyDao->getAll();

        SystemFunctions::validateSession();
        ViewsController::edditOfferView($offer);
    }

    public function editOffer(...$values)
    {
        if($_POST)
        { 
            $oferta = new Offer;
            $oferta->setOfferId($_POST['offerId']);
            $oferta->setTitle($_POST['offerTitle']);
            $oferta->setJobPosition($_POST['jobPosition']);
            $oferta->setDescription($_POST['offerDesc']);
            $oferta->setCompanyId($_POST['companyId']);
            $oferta->setPublicationDate($_POST['publicationDate']);
            $oferta->setCareerId($_POST['careerId']);
            
            if (isset($_POST['active'])) 
            {
                $oferta->setActive(true);
            } else {
                $oferta->setActive(0);
            }
            
            $this->offersDAO->updateOfferById($oferta);

            $this->showOfferDetails($oferta->getOfferId());
        } else {
                $this->editView($_POST['offerId'], "Incorrecto ingreso de datos.");
        }
    }

    public function createOffer(...$values)  {
       
        if($_POST)
        {
            $oferta = new Offer;
            $oferta->setTitle($_POST['offerTitle']);
            $oferta->setJobPosition($_POST['jobPosition']);
            $oferta->setDescription($_POST['offerDesc']);
            $oferta->setCompanyId($_POST['companyId']);
            $oferta->setPublicationDate($_POST['publicationDate']);
            $oferta->setCareerId($_POST['careerId']);
            
           
            if (isset($_POST['active'])) 
            {
                $oferta->setActive(true);
            } else {
                $oferta->setActive(0);
            }

            $this->offersDAO->add($oferta);

            $this->showOffersList();
        
        } else {
            $this->addView("Incorrecto ingreso de datos.");
        }
    } 


    public function applyForOffer(...$values){
        SystemFunctions::validateSession();
        
        if($_POST)
        {
            if($_SESSION['loggedUser']){
                $this->studentsXoffers->add($this->offersDAO->getOfferById($_POST['offerId']), $_SESSION['loggedUser']);
            }
        }

        $this->showOfferDetails($_POST['offerId']);
    }

}

?>