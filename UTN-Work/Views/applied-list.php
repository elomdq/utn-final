<!-- Contenedor -->
<div class="container">

    <div class="alert alert-<?php if ($alert != null) echo $alert->getType(); ?> col-6 mx-auto" role="alert"> <?php if ($alert != null) echo $alert->getMessage(); ?> </div>



    <div class="col-8 mx-auto ">
        <div class="row justify-content-center ">

            <?php foreach ($appliedList as $offer) { ?>

                <div class="col-12 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">

                                <div class="col-2  rounded-circle">
                                    <?php if ($this->profilePictureDAO->getURLByOwnerId($this->companyDAO->getCompanyById($offer->getCompanyId())->getUserId()) == null) { ?>
                                        <img src="<?php echo FRONT_ROOT . VIEWS_PATH . "assets/no-img.jpg" ?>" alt="..." class="card-img" height="105">
                                    <?php } else {  ?>
                                        <img src="<?php echo FRONT_ROOT . $this->profilePictureDAO->getURLByOwnerId($this->companyDAO->getCompanyById($offer->getCompanyId()->getUserId())) ?>" alt="..." class="card-img" height="105">
                                    <?php } ?>
                                </div>

                                <div class="col mr-3">
                                    <div class=" mb-1">
                                        <a href="<?php echo FRONT_ROOT . "offer/showOfferDetails/" . $offer->getOfferId(); ?>" class="stretched-link fs-5 fw-bold text-primary text-decoration-none">
                                            <span class=""><?php echo $offer->getTitle(); ?></span>
                                        </a>
                                        <div class="fs-6 mb-1 float-end">Publicación: <?php echo $offer->getPublicationDate(); ?></div>
                                    </div>

                                    <div class="fs-6 mb-1"><?php echo $this->companyDAO->getCompanyById($offer->getCompanyId())->getCity(); ?></div>

                                    <div class="text-xs font-weight-bold text-primary mb-2 offer-description">
                                        <?php echo $offer->getDescription(); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>