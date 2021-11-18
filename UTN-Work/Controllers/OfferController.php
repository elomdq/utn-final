<?php 

namespace Controllers;

use Config\SystemFunctions as SystemFunctions;

use DAO\OfferDAO as OfferDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\imageDAO as imageDAO;

use DAO\StudentsXOffersDAO as StudentsXOffers;
use Exception;
use Models\Offer as Offer;
use Models\Alert as Alert;
use Models\File as Archivo;

class OfferController{

    private $offersDAO;
    private $studentsXoffers;
    private $jobPositionsDAO;
    private $careerDAO; 
    private $companyDAO;
    private $imageDAO;
    

    public function __construct()
    {
        $this->offersDAO = new OfferDAO;
        $this->studentsXoffers = new StudentsXOffers;
        $this->jobPositionsDAO = new JobPositionDAO;
        $this->careerDAO = new CareerDAO;
        $this->companyDAO = new CompanyDAO;
        $this->imageDAO = new imageDAO;
    }

    public function showOffersList(Alert $alert = null){
        SystemFunctions::validateSession();
        try{
            $offerList = array();

            //filtrado de ofertas
            if($_SESSION['userType'] == 0)
            {
                foreach ($this->offersDAO->getAll() as $offer) { 
                    if($offer->getCareerId() == $_SESSION['loggedUser']->getCareerId())
                    {
                        array_push($offerList, $offer);
                    }
                }
            } else if($_SESSION['userType'] == 2){
                foreach ($this->offersDAO->getAll() as $offer) { 
                    if($_SESSION['loggedUser']->getIdCompany() == $offer->getCompanyId() )
                    {
                        array_push($offerList, $offer);
                    }
                }
            }
            else{
                $offerList = $this->offersDAO->getAll();
            }

            require_once VIEWS_PATH."header.php";
            require_once VIEWS_PATH ."nav.php" ;
            require_once VIEWS_PATH ."offers-list.php";
            require_once VIEWS_PATH."footer.php";
        }
        catch(Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
        }
        
    }

    public function showOfferDetails($offerId, Alert $alert = null){
        SystemFunctions::validateSession();

        $offer = $this->offersDAO->getOfferById($offerId);
        $flyer = $this->imageDAO->getURLByOwnerId($offerId);
        $postulado = 0;

        if($_SESSION['userType']== 0){
            if( $this->studentsXoffers->isStudentInOffer($_SESSION['loggedUser']->getStudentId(), $offer->getOfferId()) ){
                $postulado = 1;
            }
        }

        require_once VIEWS_PATH."header.php";
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
        SystemFunctions::validateSession();
        
        $offer = $this->offersDAO->getOfferById($offerId);

        $listJobsPositions = $this->jobPositionsDAO->getAll();
        $listaCarreras = $this->careerDAO->getAll_Api();
        $companyList = $this->companyDAO->getAll();
        $flyerOffer = $this->imageDAO->getURLByOwnerId($offerId);
        
        $carriersMap = array();
        foreach($listaCarreras as $value){
            $carriersMap[$value->getIdCareer()] = $value->getDescription();
        }

        
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
                $alert->setMessage("La oferta se edito con exito.");
                $this->showOfferDetails($oferta->getOfferId(), $alert);
            } else {
                $alert->setType('danger');
                $alert->setMessage("Hubo una falla con el envio de los datos.");
                $this->editView($_POST['offerId'], $alert);
            }
        } catch (Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
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

                if($_FILES)
                {
                    $target_dir = UPLOADS_PATH_IMG;
                    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
                    $archivo = new Archivo();
                    $archivo->setUrl($target_file);
                    $archivo->setIdOwner($this->offersDAO->getIdJobOfferByTitle($oferta->getTitle()));

                    $this->uploadFile($target_file, $alert);
        
                    $this->imageDAO->add($archivo);
                }

                $alert->setType('success');
                $alert->setMessage("La oferta se creo con exito.");

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

    private function uploadFile($target_file, Alert $alert){

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $alert->setMessage("Archivo subido con exito");
            $alert->setType("success");
          } else {
            $alert->setMessage("Error al subir el archivo");
            $alert->setType("danger");
          }
        return $alert;
    }

}

?>