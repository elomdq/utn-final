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

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Oferta</h2>
               <form action="<?php echo FRONT_ROOT ?>Offer/createOffer/" method="POST" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="offerTitle">Titulo</label>
                                   <input id="offerTitle" type="text" name="offerTitle" required class="form-control" placeholder="Nombre de empresa">
                              </div>
                         </div>                         
                         <div class="col-lg-2">
                         <label>Puesto</label> 
                         <select class="form-control" name="jobPosition" class="form-control">
                            <?php
                                foreach ($this->listJobsPositions as $puesto) { ?>
                                    <option  value= "<?php echo $puesto->getIdJobPosition(); ?>"> <?php echo $puesto->getDescripcion(); ?> </option>
                            <?php }  ?>
                        </select>
                         </div>
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="offerDesc">Descripcion</label>
                                   <input id="offerDesc" type="text" name="offerDesc" class="form-control" placeholder="Ciudad" min="0">
                              </div>
                         </div>
                         <div class="col-lg-2">
                         <label>Compania</label> 
                         <select class="form-control" name="companyId" class="form-control">
                            <?php
                                foreach ($this->companyList as $company) { ?>
                                    <option  value= "<?php echo $company->getIdCompany(); ?>"> <?php echo $company->getCompanyName(); ?> </option>
                            <?php }  ?>
                        </select>
                        </div>
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="publicationDate">Fecha</label>
                                   <input id="publicationDate" type="date" name="publicationDate" class="form-control" placeholder="Cuit" min="0">
                              </div>
                         </div>
                         <div class="col-lg-2">
                         <label>Carrera</label> 
                         <select class="form-control" name="careerId" class="form-control">
                            <?php
                                foreach ($this->listaCarreras as $carrera) { ?>
                                    <option  value= "<?php echo $carrera->getIdCareer(); ?>"> <?php echo $carrera->getDescription(); ?> </option>
                            <?php }  ?>
                        </select>
                        </div>
                         <div class="col-lg-">
                              <div>
                                   <label for="active">Active</label>
                                   <input id="active" type="checkbox" name="active" class="form-control" min="0">
                              </div>
                         </div>
                    </div>
                    <div class="wrapper">
                        <button  type="submit" class="btn btn-dark botonCentro">Agregar</button>
                    </div>
                    <label style="color: red;"><?php if(isset($message)) echo $message; ?> </label>
               </form>
          </div>
     </section>
</main>