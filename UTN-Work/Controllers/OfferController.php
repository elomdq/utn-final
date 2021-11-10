<?php 

namespace Controllers;

use DAO\OfferDAO as OfferDAO;
use Models\Offer as Offer;

class OfferController{

    private $offersDAO;

    public function __construct()
    {
        $this->offersDAO = new OfferDAO;
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

    public function editView($message = "")
    {
        require_once VIEWS_PATH ."validate-session.php";
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH ."nav.php" ;
        require_once VIEWS_PATH ."company-edit.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function editOffer($idOffer)
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
            $this->offersDAO->updateOfferById($oferta, $idOffer);
        }   else {
                $this->editView("Incorrecto ingreso de datos.",$idOffer);
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

}

?>