
<div class="container">
<div class="alert alert-<?php if($alert!=null) echo $alert->getType();?> col-6 mx-auto" role="alert"> <?php if($alert!=null) echo $alert->getMessage(); ?> </div>

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
                    <p class="d-inline fw-bold">Estado: <?php echo $offer->getActive()? "Activa" : "Dada de Baja"; ?> </p> 
                </div>
                
                <hr class="col-10 m-3">
                
                <div class="col-10 m-3">
                    <div><?php echo $offer->getDescription(); ?></div>
                </div>

                <div class="col-10 m-3">
                    <div>
                        <p class="d-inline fw-bold">Fecha limite de oferta: <?php echo $offer->getDueDays(); ?></p>
                    </div>
                </div>

                <div class="col-10 m-3">
                    <div>
                        <img src="<?php echo FRONT_ROOT.$flyer; ?>" alt=" " width="500" height="600">    
                    </div>
                </div>

                

                <hr class="col-10 m-3">
                
                <div class="col-10 m-3">
                    <form class="col-12" action="<?php echo FRONT_ROOT; ?>offer/applyForOffer/" method="post">
                        <input type="hidden" name="offerId" value="<?php echo $offer->getOfferId();?>">
                        
                        <?php if(isset($_SESSION['userType']) && $_SESSION['userType']== 0) { 
                            ?>
                            <?php if( $this->studentsXoffersDAO->isStudentInOffer($_SESSION['loggedUser']->getStudentId(), $offer->getOfferId()) ) { ?>
                                <button class="btn btn-primary botonCentro " type="button" disabled>Ya estas postulado</button>
                            <?php } else {?>
                                <button class="btn btn-primary botonCentro" type="submit">Postularse</button>
                            <?php } ?>
                        <?php } ?>

                        <?php if(isset($_SESSION['userType']) && $_SESSION['userType']!= 0) { ?>
                            <a class="text-decoration-none " href="<?php echo FRONT_ROOT. "offer/viewApplicants/" .$offer->getOfferId() ;?> "> <button class="btn btn-dark botonCentro" type="button">Ver Postulantes</button></a>
                        <?php } ?>
                        <?php if(isset($_SESSION['userType']) && $_SESSION['userType']== 1) {?>
                            <a class="text-decoration-none " href="<?php echo FRONT_ROOT."offer/editView/".$offer->getOfferId();?>" > <button class="btn btn-dark botonCentro" type="button">Editar</button> </a>
                        <?php } ?>
                    </form>
                </div>

                
                
            </div>

        </div>
    </div>
</div>
</div>