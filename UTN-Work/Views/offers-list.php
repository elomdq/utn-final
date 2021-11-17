<div class="container">

<div class="alert alert-<?php if($alert!=null) echo $alert->getType();?> col-8 mx-auto" role="alert"> <?php if($alert!=null) echo $alert->getMessage(); ?> </div>
    <!-- Content Row -->
    <div class="row justify-content-center">

        <?php foreach ($offerList as $offer) { ?>
            
            <div class="col-8  mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">

                                <div class="text-md font-weight-bold text-primary text-uppercase mb-2">
                                    <?php echo $offer->getTitle(); ?>
                                </div>

                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                    <?php echo $offer->getDescription(); ?>
                                </div>

                            </div>
                            
                            <!--<div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div> -->

                        </div>
                        <a href="<?php echo FRONT_ROOT . "offer/showOfferDetails/" . $offer->getOfferId(); ?>" class="stretched-link"> ver más </a>
                    </div>
                </div>
            </div>
            
        <?php } ?>
        
        
    </div>
</div>