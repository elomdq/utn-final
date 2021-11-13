<?php 

namespace Controllers;

use Config\SystemFunctions as SystemFunctions;

use DAO\OfferDAO as OfferDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;

use DAO\StudentsXOffersDAO as StudentsXOffers;
use Models\Offer as Offer;
use Models\Alert as Alert;

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

        $carriersMap = array();
        foreach($listaCarreras as $value){
            $carriersMap[$value->getIdCareer()] = $value->getDescription();
        }

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
            $oferta->setOfferId($_POST['offerId']);
            $oferta->setTitle($_POST['offerTitle']);
            $oferta->setJobPosition($_POST['jobPosition']);
            $oferta->setDescription($_POST['offerDesc']);
            $oferta->setCompanyId($_POST['companyId']);
            $oferta->setPublicationDate($_POST['publicationDate']);
            $oferta->setCareerId($_POST['careerId']);
            $oferta->setDueDays($_POST['dueDays']);
            
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
            $oferta->setDueDays($_POST['dueDays']);
            
           
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
        if($_POST)
        {
            if($_SESSION['loggedUser']){
                $this->studentsXoffers->add($this->offersDAO->getOfferById($_POST['offerId']), $_SESSION['loggedUser']);
                echo '<script language="javascript">';
                echo 'alert("Ha aplicado a la oferta con éxito.")';
                echo '</script>';

                $this->showOfferDetails($_POST['offerId']);
            }

            
        } else{
            echo '<script language="javascript">';
            echo 'alert("Algo salio mal")';
            echo '</script>';
        }
        
    }

    public function viewApplicants($offerId){
        
            $students = $this->studentsXoffers->getApplicantsByOfferId($offerId);
            if(!empty($students))
            {
                require_once VIEWS_PATH ."validate-session.php";
                require_once VIEWS_PATH."header.php";
                require_once VIEWS_PATH ."nav.php";
                require_once VIEWS_PATH."applicants-list.php";
                require_once VIEWS_PATH."footer.php";
            } else {
                echo '<script language="javascript">';
            echo 'alert("No hay postulantes")';
            echo '</script>';
                $this->showOfferDetails($offerId);
            }
        
    }

}

?>