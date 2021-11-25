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
                                        <label>Empresa</label>
                                        <select class="form-select" name="companyId">
                                            <option value="<?php echo $offer->getCompanyId(); ?>" selected><?php echo $this->companyDAO->getCompanyById($offer->getCompanyId())->getCompanyName() ; ?></option>
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
                                        <label for="dueDays">Oferta abierta por cuantos dias?</label>
                                        <input id="dueDays" type="number" name="dueDays" class="form-control" placeholder="Cantidad de dias: " min="0" max="100" value="<?php echo $offer->getDueDays();?>">
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

                                   <div class="form-group col-12">
                                        <label for="file">Archivo</label>
                                        <input id="file" type="text" name="file" class="form-control" value="<?php echo $flyerOffer;?>">
                                   </div>

                                   <input type="hidden" class="" name="offerId" value="<?php echo $offer->getOfferId();?>">
                                   
                                   <input type="submit" class="btn btn-primary btn-user btn-block" value="Confirmar">

                              </form>
                         </div>
                    </div>

                    <div class="alert alert-<?php if($alert!=null) echo $alert->getType();?>" role="alert"> <?php if($alert!=null) echo $alert->getMessage(); ?> </div>

               </div>
          </div>
     </div>
</section>