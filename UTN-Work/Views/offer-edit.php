<?php
namespace Views;

use DAO\OfferDAO as OfferDAO;
use Models\Offer as Offer;

$offers = new OfferDAO;
$offer = $this->offers->getOfferByIdDB($idOffer);

?>

<section id="listado" class="mb-5">
    
    <div class="container">
        <form action="<?php echo FRONT_ROOT . "Offer/modifyoffer/" ?>" method="POST" class="bg-light-alpha p-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="offerTitle">Titulo</label>
                        <input id="offerTitle" type="text" name="offerTitle" required class="form-control" value="<?php echo $offer->getTitle(); ?>">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="jobPosition">Puesto</label>
                        <input id="jobPosition" type="text" required name="jobPosition" class="form-control" value="<?php echo $offer->getJobPosition(); ?>" min="0">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="offerDesc">Descripcion</label>
                        <input id="offerDesc" type="text" name="offerDesc" class="form-control" required value="<?php echo $offer->getDescription(); ?>" min="0">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="companyId">Compania</label>
                        <input id="companyId" type="text" name="companyId" class="form-control" required value="<?php echo $offer->getCompanyId(); ?>" min="0">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="publicationDate">Fecha</label>
                        <input id="publicationDate" type="date" name="publicationDate" class="form-control" required value="<?php echo $offer->getPublicationDate(); ?>" min="0">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="careerId">Carrera</label>
                        <input id="careerId" type="text" name="careerId" class="form-control" required value="<?php echo $offer->getCareerId();?>" min="0">
                    </div>
                </div>
                <div class="col-lg-">
                    <div>
                        <label for="active">Active</label>
                        <input id="active" type="checkbox" name="active" class="form-control" min="0" <?php if($offer->getActive()) echo "checked";?> >
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <button type="submit" name="idOffer" class="btn btn-dark botonCentro" value="<?php echo $idOffer ?>">Aceptar</button>
                <button type="reset" class="btn btn-dark botonCentro">Resetear</button>
            </div>
            <label style="color: red;"><?php if (isset($message)) echo $message; ?> </label>
        </form>
    </div>
</section>