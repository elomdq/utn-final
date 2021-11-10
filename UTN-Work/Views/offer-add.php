<?php

namespace Views;

use DAO\CareerDAO as CareerDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;

$puestos = new JobPositionDAO;
$careerDAO = new CareerDAO;
$companyDao = new CompanyDAO;
$listJobsPositions = $puestos->getAll();

$listaCarreras = $careerDAO->getAll_Api();

$companyList = $companyDao->getAll();
$user = $_SESSION['loggedUser'];

?>

<section id="jobOffer-form" class="mb-5">
     <div class="container">
          <div class="row justify-content-center bg-white">
               <div class="col-8 p-2">
                    <div class="card">
                         <h2 class="card-header mb-2">Agregar Oferta</h2>

                         <div class="card-body">
                              <form action="<?php echo FRONT_ROOT ?>Offer/createOffer/" method="POST" class="row bg-light-alpha p-5">

                                   <div class="form-group col-12">
                                        <label for="offerTitle">Titulo</label>
                                        <input id="offerTitle" type="text" name="offerTitle" required class="form-control" placeholder="Nombre de empresa">
                                   </div>

                                   <div class="form-group col-12">
                                        <!-- <label for="jobPosition">Puesto</label> -->
                                        <select id="jobPosition" class="form-select" name="jobPosition">
                                             <?php foreach ($listJobsPositions as $puesto) { ?>
                                                  <option value="<?php echo $puesto->getIdJobPosition(); ?>"> <?php echo $puesto->getDescription(); ?> </option>
                                             <?php } ?>
                                        </select>
                                   </div>


                                   <div class="form-group col-12">
                                        <label for="offerDesc">Descripcion</label>
                                        <input id="offerDesc" type="text" name="offerDesc" class="form-control" placeholder="Ciudad" min="0">
                                   </div>

                                   <div class="form-group col-12">
                                        <label>Empresa</label>
                                        <select class="form-select" name="companyId">
                                             <?php
                                             foreach ($this->companyList as $company) { ?>
                                                  <option value="<?php echo $company->getIdCompany(); ?>"> <?php echo $company->getCompanyName(); ?> </option>
                                             <?php }  ?>
                                        </select>
                                   </div>


                                   <div class="form-group col-12">
                                        <label for="publicationDate">Fecha</label>
                                        <input id="publicationDate" type="date" name="publicationDate" class="form-control" placeholder="Cuit" min="0">
                                   </div>

                                   <div class="form-group col-12">
                                        <label>Carrera</label>
                                        <select class="form-select" name="careerId">
                                             <?php
                                             foreach ($this->listaCarreras as $carrera) { ?>
                                                  <option value="<?php echo $carrera->getIdCareer(); ?>"> <?php echo $carrera->getDescription(); ?> </option>
                                             <?php }  ?>
                                        </select>
                                   </div>

                                   <div class="form-group col-12">
                                        
                                   <div class="form-check">
                                        <input id="active" type="checkbox" name="active" class="form-check-input" min="0">
                                        <label class="form-check-label" for="active">Active</label>
                                   </div>

                                   </div>
                                   

                              </form>
                         </div>
                    </div>

                    <label style="color: red;"><?php if (isset($message)) echo $message; ?> </label>

               </div>
          </div>
     </div>
</section>