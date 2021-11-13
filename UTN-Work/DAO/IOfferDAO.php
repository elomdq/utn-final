<?php 

namespace DAO;

use Models\Offer as Offer;

interface IOfferDAO{

    public function add(Offer $offer);
    public function getAll();

}

?>