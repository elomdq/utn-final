<?php 

namespace Controllers;

use Config\SystemFunctions as SystemFunctions;

use DAO\OfferDAO as OfferDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;

use DAO\StudentsXOffersDAO as StudentsXOffers;
use Exception;
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

    public function showOffersList(Alert $alert = null){
        SystemFunctions::validateSession();
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."offers-list.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function showOfferDetails($offerId, Alert $alert = null){
        SystemFunctions::validateSession();
        require_once VIEWS_PATH."header.php";
        //paso la oferta por la variable superglobal SESSION
        $_SESSION['offer'] = $this->offersDAO->getOfferById($offerId);
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."offer-details.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function addView(Alert $alert = null){
        SystemFunctions::validateSession();
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php";
        require_once VIEWS_PATH ."offer-add.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function editView($offerId, Alert $alert = null)
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

        SystemFunctions::validateSession();
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php";
        require_once VIEWS_PATH ."offer-edit.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function editOffer(...$values)
    {
        $alert = new Alert();
        try{
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

                $alert->setType('success');
                $alert->setMessage("Se edito con exito.");
                $this->showOfferDetails($oferta->getOfferId(), $alert);
            } else {
                $alert->setType('danger');
                $alert->setMessage("Incorrecto ingreso de datos.");
                $this->editView($_POST['offerId'], $alert);
            }
        } catch (Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
        } finally {
            $this->editView($_POST['offerId'], $alert);
        }
        
    }

    public function createOffer(...$values)  {
        try{
            $alert = new Alert();
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

                $alert->setType('success');
                $alert->setMessage("Se edito con exito.");

                $this->showOffersList($alert);
        
            } else {
                $alert->setType('danger');
                $alert->setMessage("Incorrecto ingreso de datos.");
                $this->addView($alert);
            }
        } catch (Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            $this->addView($alert);
        }
    } 


    public function applyForOffer(...$values){      
        try{
            $alert = new Alert();
            if($_POST)
            {
                if($_SESSION['loggedUser']){
                    $this->studentsXoffers->add($this->offersDAO->getOfferById($_POST['offerId']), $_SESSION['loggedUser']);
                    $alert->setType('success');
                    $alert->setMessage("Se aplico con exito.");
                    $this->showOfferDetails($_POST['offerId'],$alert);
                }
            } else{
                $alert->setType('warning');
                $alert->setMessage("Algo ocurrio en el envio de datos, intente nuevamente");
                $this->showOffersList($alert);
            }
        } catch(Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            $this->showOffersList($alert);
        }
    }

    public function viewApplicants($offerId){
        SystemFunctions::validateSession();
        try{
            $alert = new Alert();
            $students = $this->studentsXoffers->getApplicantsByOfferId($offerId);
            if(!empty($students))
            {
                require_once VIEWS_PATH."header.php";
                require_once VIEWS_PATH ."nav.php";
                require_once VIEWS_PATH."applicants-list.php";
                require_once VIEWS_PATH."footer.php";
            } else {
                $alert->setType('warning');
                $alert->setMessage("No hay postulantes");
                $this->showOfferDetails($offerId,$alert);
            }

        }catch (Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            $this->showOfferDetails($offerId,$alert);
        }
    }

}

?>