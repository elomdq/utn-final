<section class="offer-details">

    <div class="container mt-5" id="offer-detail">

        <div class="alert alert-<?php if ($alert != null) echo $alert->getType(); ?> col-6 mx-auto" role="alert"> <?php if ($alert != null) echo $alert->getMessage(); ?> </div>

        <div class="row justify-content-center">

            <div class="col-6">
                <div class="card shadow mb-4">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary"><?php echo $offer->getTitle(); ?></h5>
                        <div class="">
                            <h6 class="float-end">Fecha de Publicación</h6>
                            <p class="m-0"><?php echo $offer->getPublicationDate(); ?></p>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="row card-body justify-content-center py-2">
                        <div class="col-10 m-2">
                            <div>
                                <p class="d-inline fw-bold">Empresa: <?php echo $this->companyDAO->getCompanyById($offer->getCompanyId())->getCompanyName(); ?></p>
                            </div>
                        </div>
                        <div class="col-10 m-2">
                            <div>
                                <p class="d-inline fw-bold">Puesto: <?php echo $this->jobPositionsDAO->getPositionDescriptionById($offer->getJobPosition()); ?></p>
                            </div>
                        </div>

                        <div class="col-10 m-3">
                            <p class="d-inline fw-bold">Estado: <?php echo $offer->getActive() ? "Activa" : "Dada de Baja"; ?> </p>
                        </div>

                        <hr class="col-10 m-3">

                        <div class="col-10 m-3">
                            <div><?php echo $offer->getDescription(); ?></div>
                        </div>

                        <div class="col-10 m-3">
                            <div>
                                <p class="d-inline fw-bold">Dias abiertos para postularse: <?php echo $offer->getDueDays(); ?></p>
                            </div>
                        </div>

                        <?php if (!empty($flyer)) { ?>
                            <div class="col-10 m-3">
                                <div>
                                    <img class="col-12" src="<?php echo FRONT_ROOT . $flyer; ?>" alt="No Flyer :(" width="">
                                </div>
                            </div>
                        <?php } ?>

                        <hr class="col-10 m-3">

                        <div class="col-12 my-3 d-flex flex-wrap justify-content-center">

                            <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 0) { ?>
                                <a class="text-decoration-none mb-2 mx-1" href="<?php echo FRONT_ROOT . "offer/applyForOffer/" . $offer->getOfferId(); ?>">
                                    <?php if ($this->studentsXoffersDAO->isStudentInOffer($_SESSION['loggedUser']->getStudentId(), $offer->getOfferId())) { ?>
                                        <button class="btn btn-primary botonCentro " type="button" disabled>Ya estas postulado</button>
                                    <?php } else { ?>
                                        <button class="btn btn-primary botonCentro" type="submit">Postularse</button>
                                    <?php } ?>
                                </a>
                            <?php } ?>

                            <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] != 0) { ?>
                                <a class="text-decoration-none mb-2 mx-1" href="<?php echo FRONT_ROOT . "offer/viewApplicants/" . $offer->getOfferId(); ?> "> <button class="btn btn-dark botonCentro" type="button">Ver Postulantes</button></a>
                            <?php } ?>

                            <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == 1) { ?>
                                <a class="text-decoration-none mb-2 mx-1" href="<?php echo FRONT_ROOT . "offer/editView/" . $offer->getOfferId(); ?>"> <button class="btn btn-dark botonCentro" type="button">Editar</button> </a>
                                <a class="text-decoration-none mb-2 mx-1" href="<?php echo FRONT_ROOT . "offer/createPDF/" . $offer->getOfferId(); ?>"> <button class="btn btn-dark botonCentro" type="button">Generar PDF</button> </a>
                                <a class="text-decoration-none mb-2 mx-1" href="<?php echo FRONT_ROOT . "offer/closeOffer/" . $offer->getOfferId(); ?>"> <button class="btn btn-dark botonCentro" type="button">Cerrar Oferta</button> </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>