<?php 

namespace Controllers;

use Config\SystemFunctions as SystemFunctions;

use FPDF as FPDF;

use DAO\OfferDAO as OfferDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\StudentsXOffersDAO as StudentsXOffersDAO;
use DAO\imageDAO as imageDAO;
use DAO\ProfilePictureDAO as ProfilePictureDAO;

use Exception;

use Models\Offer as Offer;
use Models\Alert as Alert;
use Models\File as Archivo;

use Controllers\MailController as MailController;
use DAO\StudentDAO;

class OfferController{

    private $offersDAO;
    private $studentsXoffersDAO;
    private $jobPositionsDAO;
    private $careerDAO; 
    private $companyDAO;
    private $imageDAO;
    private $profilePictureDAO;
    

    public function __construct()
    {
        $this->offersDAO = new OfferDAO;
        $this->studentsXoffersDAO = new StudentsXOffersDAO;
        $this->jobPositionsDAO = new JobPositionDAO;
        $this->careerDAO = new CareerDAO;
        $this->companyDAO = new CompanyDAO;
        $this->imageDAO = new imageDAO;
        $this->profilePictureDAO = new ProfilePictureDAO;
    }

    public function showOffersList(Alert $alert = null, ...$values){
        SystemFunctions::validateSession();
        try{
            $offerList = array();
            $searchKeysCareer = array();
            $searchKeysJobPosition = array();
            

            while(!empty($values))
            {
                if(array_key_first($values) && str_contains(array_key_first($values), "career")){
                    array_push($searchKeysCareer, $values[array_key_first($values)]);
                } else if(array_key_first($values) && str_contains(array_key_first($values), "jobPosition")){
                    array_push($searchKeysJobPosition, $values[array_key_first($values)]);
                }

                array_shift($values);
            }
            
            //filtrado de ofertas
            /*
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
            */

            //filtrado por sidebar
            if(!empty($searchKeysCareer)){
                foreach ($this->offersDAO->getAll() as $offer) { 
                    if(in_array($offer->getCareerId(), $searchKeysCareer))
                    {
                        if(!in_array($offer, $offerList))
                            array_push($offerList, $offer);
                    }
                }
            }

            if(!empty($searchKeysJobPosition)){
                foreach ($this->offersDAO->getAll() as $offer) { 
                    if(in_array($offer->getJobPosition(), $searchKeysJobPosition))
                    {
                        if(!in_array($offer, $offerList))
                            array_push($offerList, $offer);
                    }
                }
            }

            if(empty($searchKeysCareer) && empty($searchKeysJobPosition))
            {
                if($_SESSION['userType'] == 0)
                {
                    foreach ($this->offersDAO->getAll() as $offer) { 
                        if($offer->getActive())
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
            }
            
            require_once VIEWS_PATH."header.php";
            require_once VIEWS_PATH ."nav.php" ;
            require_once VIEWS_PATH ."offers-list.php";
            require_once VIEWS_PATH."footer.php";
        }
        catch(Exception $e){
            $alert = new Alert;
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            ViewController::erroConnectionView($alert);
        }
        
    }

    public function showOfferDetails($offerId, Alert $alert = null){
        SystemFunctions::validateSession();

        $offer = $this->offersDAO->getOfferById($offerId);
        $flyer = $this->imageDAO->getURLByOwnerId($offerId);

        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."offer-details.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function addView(Alert $alert = null){
        SystemFunctions::validateSession();

        try{
        $listJobsPositions = $this->jobPositionsDAO->getAll();
        $listaCarreras = $this->careerDAO->getAll_Api();
        $companyList = $this->companyDAO->getAll();

        $carriersMap = array();
        foreach($listaCarreras as $value){
            $carriersMap[$value->getIdCareer()] = $value->getDescription();
        }

        $user = $_SESSION['loggedUser'];

        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php";
        require_once VIEWS_PATH ."offer-add.php";
        require_once VIEWS_PATH."footer.php";
        } catch(Exception $e){
            $alert = new Alert;
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            ViewController::erroConnectionView($alert);
        }
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
            ViewController::erroConnectionView($alert);
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

                if($_FILES &&  $_FILES["fileToUpload"]["name"] != "")
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
                $alert->setMessage("Hubo un problema con el envio de datos.");
                $this->addView($alert);
            }
        } catch (Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            //$this->addView($alert);
            ViewController::erroConnectionView($alert);
        }
    } 


    public function applyForOffer($offerId){      
        SystemFunctions::validateSession();
        
        try{
            $alert = new Alert();
            
                    $this->studentsXoffersDAO->add($this->offersDAO->getOfferById($offerId), $_SESSION['loggedUser']); 
                    $alert->setType('success');
                    $alert->setMessage("Se aplico con exito.");
                    $this->showOfferDetails($offerId,$alert);
            
        } catch(Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            //$this->showOffersList($alert);
            ViewController::erroConnectionView($alert);
        }
    }

    public function viewApplicants($offerId, $alert = null){
        SystemFunctions::validateSession();
        try{
            if($alert == null)
                $alert = new Alert();
            
            $students = $this->studentsXoffersDAO->getApplicantsByOfferId($offerId);
            if(!empty($students))
            {
                require_once VIEWS_PATH."header.php";
                require_once VIEWS_PATH ."nav.php";
                require_once VIEWS_PATH."applicants-list.php";
                require_once VIEWS_PATH."footer.php";
            } else {
                if($alert->getMessage() != null)
                {
                    $this->showOfferDetails($offerId,$alert);
                } else {
                    $alert->setType('warning');
                    $alert->setMessage($alert->getMessage() . "No hay postulantes");
                    $this->showOfferDetails($offerId,$alert);
                }
            }
        }catch (Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            //$this->showOfferDetails($offerId,$alert);
            ViewController::erroConnectionView($alert);
        }
    }


    public function declineApplicant($offerId, $studentId){
        SystemFunctions::validateSession();
        try
        {
            $alert = new Alert();
            $students = $this->studentsXoffersDAO->getApplicantsByOfferId($offerId);
            $this->studentsXoffersDAO->remove($offerId, $studentId);

            $studentDAO = new StudentDAO;

            $mailController = new MailController;
            $mailController->sendDeclineEmail(/*$studentDAO->getStudentByStudentId($studentId)->getEmail()*/ "eloymrp@gmail.com", $this->offersDAO->getOfferById($offerId)->getTitle());

            $alert->setType('success');
            $alert->setMessage("Postulacion declinada con exito.");
            
            $this->viewApplicants($offerId,$alert);
            
        } catch(Exception $e){
            $alert->setType('danger');
            $alert->setMessage("Hubo problemas para declinar esa");
            $this->viewApplicants($offerId,$alert);
        }
        
    }

    public function closeOffer($offerId){
        try{
            $this->offersDAO->disableOffer($offerId);
        
            $mailController = new MailController;
            $mailController->sendThanksEmails(/*$this->studentsXoffersDAO->getApplicantsByOfferId($offerId)*/ ["eloymrp@gmail.com","eloymrp@gmail.com"] , $this->offersDAO->getOfferById($offerId)->getTitle());
          
            $alert = new Alert;
            $alert->setType("success");
            $alert->setMessage("Oferta cerrado con exito.");

            $this->showOfferDetails($offerId, $alert);
        }catch(Exception $e){
            $alert->setType("danger");
            $alert->setMessage("Algo salio mal. Error: " . $e->getMessage());
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

    public function CreatePDF($idOffer): void
        {
            $jobOffer = $this->offersDAO->getOfferById($idOffer);
            $companyName = $this->companyDAO->getCompanyById($jobOffer->getCompanyId());
            $students = $this->studentsXoffersDAO->getApplicantsByOfferId($idOffer);
            $justNames = array();
            foreach ($students as $student) {
                array_push($justNames,$student->getFirstName() ." " . $student->getLastName());
            }
            $stringNombres = implode("-", $justNames);

            $jobPosition = $this->jobPositionsDAO->getjobPositionById($jobOffer->getJobPosition());

            ob_end_clean(); //clears
            $pdf=new FPDF();

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 20);
            $pdf->Cell(60,20,$jobOffer->getTitle());
            $pdf->Ln(20);

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(60,20,"Empresa: ");
            $pdf->SetFont('Arial', '', 16);
            $pdf->Cell(60,20,$companyName->getCompanyName());
            $pdf->Ln(20);

            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(60,20,"Puesto Laboral: ");
            $pdf->SetFont('Arial', '', 14);
            $pdf->Cell(60,20,"No conecta a API"/*$jobPosition->getDescription()*/);
            $pdf->Ln(20);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,20,"Postulados: ");
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 12);
            foreach($justNames as $nombres){
                $pdf->Cell(60,20,$nombres);
                $pdf->Ln(5);
            }
            
            $pdf->Ln(20);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,20,"Descripcion: ");
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(60,20,$jobOffer->getDescription());
            $pdf->Ln(20);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,20,"Fecha: ");
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(60,20,$jobOffer->getPublicationDate());


            $pdf->Output();
        }

}

?>