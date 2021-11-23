<section id="jobOffer-form" class="mb-5">
     <div class="container">

          <div class="alert alert-<?php if ($alert != null) echo $alert->getType(); ?>" role="alert"> <?php if ($alert != null) echo $alert->getMessage(); ?> </div>

          <div class="row justify-content-center bg-white">
               <div class="col-6 p-2">

                    <div class="card">

                         <div class="card-header py-2">
                              <h5 class="mt-2">Agregar Oferta</h5>
                         </div>


                         <div class="card-body">
                              <form action="<?php echo FRONT_ROOT ?>Offer/createOffer/" method="POST" class="row bg-light-alpha p-3" enctype="multipart/form-data">

                                   <div class="form-group col-12 py-3">
                                        <label for="offerTitle">Titulo</label>
                                        <input id="offerTitle" type="text" name="offerTitle" required class="form-control" placeholder="Titulo para la oferta">
                                   </div>

                                   <div class="form-group col-12  py-3">
                                        <label>Carrera</label>
                                        <select class="form-select" name="careerId">
                                             <?php foreach ($listaCarreras as $carrera) { ?>
                                                  <option value="<?php echo $carrera->getIdCareer(); ?>"> <?php echo $carrera->getIdCareer() . " - " . $carrera->getDescription(); ?> </option>
                                             <?php }  ?>
                                        </select>
                                   </div>

                                   <div class="form-group col-12 py-3">
                                        <label for="jobPosition">Puesto</label>
                                        <select id="jobPosition" class="form-select" name="jobPosition">
                                             <?php foreach ($listJobsPositions as $puesto) { ?>
                                                  <option value="<?php echo $puesto->getIdJobPosition(); ?>"> <?php echo $carriersMap[$puesto->getCareerId()] . " - " . $puesto->getDescription(); ?> </option>
                                             <?php } ?>
                                        </select>
                                   </div>

                                   <div class="form-group col-12 py-3">
                                        <label>Empresa</label>

                                        <select class="form-select" name="companyId">

                                             <?php if ($_SESSION['userType'] == 1) { ?>

                                                  <?php foreach ($companyList as $company) { ?>
                                                       <option value="<?php echo $company->getIdCompany(); ?>"> <?php echo $company->getCompanyName(); ?> </option>
                                                  <?php }
                                             } else { ?>

                                                  <option value="<?php echo $_SESSION['loggedUser']->getIdCompany(); ?>" selected> <?php echo $_SESSION['loggedUser']->getCompanyName(); ?> </option>

                                             <?php }  ?>
                                        </select>
                                   </div>

                                   <div class="form-group col-12 py-3">
                                        <label for="publicationDate">Fecha</label>
                                        <input id="publicationDate" type="date" name="publicationDate" class="form-control" value="<?php echo date("Y-m-d") ?>">
                                   </div>

                                   <div class="form-group col-12 py-3">
                                        <label for="dueDays">Oferta abierta por cuantos dias?</label>
                                        <input id="dueDays" type="number" name="dueDays" class="form-control" placeholder="Cantidad de dias" min="0" max="20">
                                   </div>

                                   <div class="form-group col-12 py-3">
                                        <label for="offerDesc">Descripcion</label>
                                        <textarea id="offerDesc" name="offerDesc" class="form-control" rows="6" placeholder="Ingrese la descripción de la oferta"></textarea>
                                   </div>

                                   <div class="form-group col-12 py-3">

                                        <div class="form-check">
                                             <label class="form-check-label" for="active">Active</label>
                                             <input id="active" type="checkbox" name="active" class="form-check-input">
                                        </div>

                                   </div>


                                   <div class="form-group col-12 py-3">
                                        <label for="fileToUpload">Flyer</label>
                                        <input type="file" id="fileToUpload" name="fileToUpload" max-file-size="6000" accept="image/png, image/gif, image/jpeg">
                                   </div>

                                   <hr class="col-12 my-3">

                                   <div class="col-12 pt-2 d-flex justify-content-center">
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Confirmar">
                                   </div>


                              </form>
                         </div>
                    </div>



               </div>
          </div>
     </div>
</section>