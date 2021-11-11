<section id="jobOffer-form" class="mb-5">
     <div class="container">
          <div class="row justify-content-center bg-white">
               <div class="col-8 p-2">
                    <div class="card">
                         <h5 class="card-header mb-2">Editar Oferta</h5> 

                         <div class="card-body">
                              <form action="<?php echo FRONT_ROOT?>Offer/editOffer/" method="POST" class="row bg-light-alpha p-3">

                                   <div class="form-group col-12">
                                        <label for="offerTitle">Titulo</label>
                                        <input id="offerTitle" type="text" name="offerTitle" required class="form-control" value="<?php echo $offer->getTitle(); ?>">
                                   </div>

                                   <div class="form-group col-12">
                                        <label>Carrera</label>
                                        <select class="form-select" name="careerId">
                                            <option value="<?php echo $offer->getCareerId();?>" selected> <?php echo $this->careerDAO->getCareerById_Api($offer->getCareerId())->getDescription()." - ". $this->careerDAO->getCareerById_Api($offer->getCareerId())->getDescription();?> </option>
                                            <?php foreach ($listaCarreras as $carrera) { ?>
                                                <option value="<?php echo $carrera->getIdCareer(); ?>"> <?php echo $carrera->getIdCareer()." - ". $carrera->getDescription(); ?> </option>
                                            <?php } ?>
                                        </select>
                                   </div>

                                   <div class="form-group col-12">
                                        <label for="jobPosition">Puesto</label>
                                        <select id="jobPosition" class="form-select" name="jobPosition">
                                            <option value="<?php echo $offer->getJobPosition();?>" selected><?php echo $this->puestos->getjobPositionById($offer->getJobPosition())->getDescription() . " - " . $this->puestos->getjobPositionById($offer->getJobPosition())->getDescription(); ?></option>
                                             <?php foreach ($listJobsPositions as $puesto) { ?>
                                                  <option value="<?php echo $puesto->getIdJobPosition(); ?>"> <?php echo $carriersMap[$puesto->getCareerId()] . " - " .  $puesto->getDescription(); ?> </option>
                                             <?php } ?>
                                        </select>
                                   </div>


                                   <div class="form-group col-12">
                                        <label>Empresa</label>
                                        <select class="form-select" name="companyId">
                                            <option value="<?php echo $offer->getCompanyId(); ?>" selected><?php echo $this->companyDao->getCompanyById($offer->getCompanyId())->getCompanyName() ; ?></option>
                                             <?php foreach ($companyList as $company) { ?>
                                                  <option value="<?php echo $company->getIdCompany();?>"> <?php echo $company->getCompanyName(); ?> </option>
                                             <?php }  ?>
                                        </select>
                                   </div>


                                   <div class="form-group col-12">
                                        <label for="publicationDate">Fecha</label>
                                        <input id="publicationDate" type="date" name="publicationDate" class="form-control" value="<?php echo $offer->getPublicationDate(); ?>">
                                   </div>

                                   <div class="form-group col-12">
                                        <label for="offerDesc">Descripcion</label>
                                        <textarea id="offerDesc" name="offerDesc" class="form-control" rows="6"><?php echo $offer->getDescription(); ?></textarea>
                                   </div>

                                   <div class="form-group col-12">

                                        <div class="form-check">
                                            <?php if($offer->getActive()) { ?>
                                                <input id="active" type="checkbox" name="active" class="form-check-input" checked>
                                            <?php } else {?>
                                                <input id="active" type="checkbox" name="active" class="form-check-input">
                                            <?php }?>
                                                <label class="form-check-label" for="active">Active</label>
                                        </div>

                                   </div>

                                   <input type="hidden" class="" name="offerId" value="<?php echo $offer->getOfferId();?>">
                                   
                                   <input type="submit" class="btn btn-primary btn-user btn-block" value="Confirmar">

                              </form>
                         </div>
                    </div>

                    <label style="color: red;"><?php if (isset($message)) echo $message; ?> </label>

               </div>
          </div>
     </div>
</section>