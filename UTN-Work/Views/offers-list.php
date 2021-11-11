<?php

use Models\Offer as Offer;
use DAO\OfferDAO as OfferDAO;

$offers = new OfferDAO;
$offerList = array();

if($_SESSION['userType'] == 0)
{
    foreach ($offers->getAll() as $offer) { 
        if($offer->getCareerId() == $_SESSION['loggedUser']->getCareerId())
        {
            array_push($offerList, $offer);
        }
    }
} else if($_SESSION['userType'] == 2){
    foreach ($offers->getAll() as $offer) { 
        if($_SESSION['loggedUser']->getIdCompany() == $offer->getCompanyId() )
        {
            array_push($offerList, $offer);
        }
    }
}
else{
    $offerList = $offers->getAll();
}

?>

<div class="container">
    <!-- Content Row -->
    <div class="row justify-content-center">

        <?php foreach ($offerList as $offer) { ?>
            <!-- <a class="col-xl-8 col-md-8" href="#"> -->
            <div class="col-8  mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-2">
                                    <?php echo $offer->getTitle(); ?></div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                    <?php echo $offer->getDescription(); ?></div>
                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> -->
                            </div>
                            <div class="col-auto">
                               <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                            </div>
                        </div>
                        <a href="<?php echo FRONT_ROOT . "offer/showOfferDetails/" . $offer->getOfferId(); ?>" class="stretched-link"> ver más </a>
                    </div>
                </div>
            </div>
            <!-- </a> -->
        <?php } ?>

    </div>
</div>