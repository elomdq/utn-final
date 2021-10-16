<?php 

namespace Controllers;

use DAO\OfferDAO as OfferDAO;
use Models\Offer as Offer;

class OfferController{

    private $offers;

    public function __construct()
    {
        $this->offers = new OfferDAO;
    }

    public function showOffersList(){
        require_once VIEWS_PATH . "validate-session.php";
        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "offers-list.php";
    }

    public function showOffer($offer){
        
    }

}

?>