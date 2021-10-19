<?php

use Models\Offer as Offer;
use DAO\OfferDAO as OfferDAO;

$offers = new OfferDAO;
/*$offer1 = new Offer;

    $offer1->setOfferId(1);
    $offer1->setTitle("Propuesta Random");
    $offer1->setSalary(95000);
    $offer1->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis turpis ac purus consectetur tempor. Integer elementum arcu nec nisi interdum, id sagittis dui pellentesque. In efficitur sagittis lectus, semper vestibulum nisi laoreet quis. Nulla vehicula ultricies diam, sit amet dictum purus sodales id.");
    $offer1->setCompanyId(3);
    $offer1->setPublicationDate("15-11-2021");
    $offer1->setCareerId(2);
    $offer1->setActive(true);

    $offers->add($offer1);*/

?>

<div class="container">
    <!-- Content Row -->
    <div class="row justify-content-center">

        <?php foreach ($offers->getAll() as $offer) { ?>
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