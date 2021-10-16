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
        require_once VIEWS_PATH . "validate-session.php";
        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "offers-list.php";
    }

    public function showOfferDetails($offerId){
        require_once VIEWS_PATH . "validate-session.php";

        //paso la oferta por la variable superglobal SESSION
        $_SESSION['offer'] = $this->offersDAO->getOfferById($offerId);

        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "offer-details.php";
    }

}

?>