<section id="offer-list">
    <div class="container mt-5">
        <div class="alert alert-<?php if ($alert != null) echo $alert->getType(); ?> col-8 mx-auto" role="alert"> <?php if ($alert != null) echo $alert->getMessage(); ?> </div>
        <!-- Content Row -->
        <div class="row flex-row">
            <div class="col-3 d-flex flex-column flex-shrink-0 sidebar">
                <div class="card">
                    <div class="card-body">
                        <form class="" action="<?php echo FRONT_ROOT ?>Offer/showOffersList/" method="post">
                            <div class="form-group col-12 py-3">
                                <p>Carreras:</p>
                                <div class="form-check">
                                    <label class="form-check-label" for="1">Programacion</label>
                                    <input id="1" type="checkbox" name="active" class="form-check-input" value="1">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="2">Sistemas</label>
                                    <input id="2" type="checkbox" name="active" class="form-check-input" value="2">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="3">Diseño de Interiores</label>
                                    <input id="3" type="checkbox" name="active" class="form-check-input" value="3">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="4">Ingenieria Naval</label>
                                    <input id="4" type="checkbox" name="active" class="form-check-input" value="4">
                                </div>

                            </div>
                            <div class="form-group col-12 py-3">

                                <p>Posiciones:</p>
                                <div class="form-check">
                                    <label class="form-check-label" for="5">Jr JAVA</label>
                                    <input id="5" type="checkbox" name="active" class="form-check-input" value="1">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="6">SSr PHP</label>
                                    <input id="6" type="checkbox" name="active" class="form-check-input" value="2">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="7">Trainne JAVA</label>
                                    <input id="7" type="checkbox" name="active" class="form-check-input" value="3">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="8">Sr JAVA</label>
                                    <input id="8" type="checkbox" name="active" class="form-check-input" value="4">
                                </div>

                            </div>

                            <div class="col-12 pt-2 d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Filtrar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-8 mb-4">
                <div class="row justify-content-center">
                    <?php foreach ($offerList as $offer) { ?>
                        <div class="col-12">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">

                                        <div class="col-2  rounded-circle">
                                            <img src="<?php echo FRONT_ROOT . VIEWS_PATH . "assets/no-img.jpg" ?>" alt="..." class="card-img" height="105">
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
    </div>
</section>