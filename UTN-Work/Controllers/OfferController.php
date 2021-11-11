<?php 

namespace Controllers;

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
        require_once VIEWS_PATH ."validate-session.php";
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."offers-list.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function showOfferDetails($offerId){
        require_once VIEWS_PATH ."validate-session.php";
        require_once VIEWS_PATH."header.php";

        //paso la oferta por la variable superglobal SESSION
        $_SESSION['offer'] = $this->offersDAO->getOfferById($offerId);

        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."offer-details.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function addView($message = ""){
        require_once VIEWS_PATH ."validate-session.php";
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php";
        require_once VIEWS_PATH ."offer-add.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function editView($offerId, $message = "")
    {
        $offer = new Offer;
        $offer = $this->offersDAO->getOfferById($offerId);

        $listJobsPositions = $this->puestos->getAll();
        $listaCarreras = $this->careerDAO->getAll_Api();
        $companyList = $this->companyDao->getAll();

        require_once VIEWS_PATH ."validate-session.php";
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php";
        require_once VIEWS_PATH ."offer-edit.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function editOffer(...$values)
    {
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
                $oferta->setActive(false);
            }
            $this->offersDAO->updateOfferById($oferta);
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
                $oferta->setActive(false);
            }

            $this->offersDAO->add($oferta);

            $this->showOffersList();
        
        } else {
            $this->addView("Incorrecto ingreso de datos.");
        }
    } 


    public function applyForOffer(...$values){
        require_once VIEWS_PATH ."validate-session.php";
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php" ;
        
        if($_POST)
        {
            if($_SESSION['loggedUser']){
                $this->studentsXoffers->add($this->offersDAO->getOfferById($_POST['offerId']), $_SESSION['loggedUser']);
            }
        }
        require_once VIEWS_PATH."footer.php";
    }

}

?>