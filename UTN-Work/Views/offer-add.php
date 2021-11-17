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

$carriersMap = array();
foreach($listaCarreras as $value){
     $carriersMap[$value->getIdCareer()] = $value->getDescription();
}

$user = $_SESSION['loggedUser'];

?>

<section id="jobOffer-form" class="mb-5">
     <div class="container">
          <div class="row justify-content-center bg-white">
               <div class="col-8 p-2">
                    <div class="card">
                         <h3 class="card-header mb-2">Agregar Oferta</h3>

                         <div class="card-body">
                              <form action="<?php echo FRONT_ROOT?>Offer/createOffer/" method="POST" class="row bg-light-alpha p-3">

                                   <div class="form-group col-12">
                                        <label for="offerTitle">Titulo</label>
                                        <input id="offerTitle" type="text" name="offerTitle" required class="form-control" placeholder="Titulo para la oferta">
                                   </div>

                                   <div class="form-group col-12">
                                        <label>Carrera</label>
                                        <select class="form-select" name="careerId">
                                             <?php foreach ($listaCarreras as $carrera) { ?>
                                                  <option value="<?php echo $carrera->getIdCareer(); ?>"> <?php echo $carrera->getIdCareer()." - ". $carrera->getDescription(); ?> </option>
                                             <?php }  ?>
                                        </select>
                                   </div>

                                   <div class="form-group col-12">
                                        <label for="jobPosition">Puesto</label>
                                        <select id="jobPosition" class="form-select" name="jobPosition">
                                             <?php foreach ($listJobsPositions as $puesto) { ?>
                                                  <option value="<?php echo $puesto->getIdJobPosition(); ?>"> <?php echo $carriersMap[$puesto->getCareerId()] . " - " .$puesto->getDescription(); ?> </option>
                                             <?php } ?>
                                        </select>
                                   </div>

                                   <div class="form-group col-12">
                                        <label>Empresa</label>
                                        <select class="form-select" name="companyId">
                                             <?php foreach ($companyList as $company) { ?>
                                                  <option value="<?php echo $company->getIdCompany();?>"> <?php echo $company->getCompanyName(); ?> </option>
                                             <?php }  ?>
                                        </select>
                                   </div>

                                   <div class="form-group col-12">
                                        <label for="publicationDate">Fecha</label>
                                        <input id="publicationDate" type="date" name="publicationDate" class="form-control" value="<?php echo date("Y-m-d") ?>">
                                   </div>

                                   <div class="form-group col-12">
                                        <label for="dueDays">Oferta abierta por cuantos dias?</label>
                                        <input id="dueDays" type="number" name="dueDays" class="form-control" placeholder="Cantidad de dias" min="0" max="20">
                                   </div>

                                   <div class="form-group col-12">
                                        <label for="offerDesc">Descripcion</label>
                                        <textarea id="offerDesc" name="offerDesc" class="form-control" rows="6" placeholder="Ingrese la descripción de la oferta"></textarea>
                                   </div>

                                   <div class="form-group col-12">

                                        <div class="form-check">
                                             <input id="active" type="checkbox" name="active" class="form-check-input">
                                             <label class="form-check-label" for="active">Active</label>
                                        </div>

                                   </div>
                                   
                                   <input type="submit" class="btn btn-primary btn-user btn-block" value="Confirmar">

                              </form>
                         </div>
                    </div>

                    <div class="alert alert-<?php if($alert!=null) echo $alert->getType();?>" role="alert"> <?php if($alert!=null) echo $alert->getMessage(); ?> </div>

               </div>
          </div>
     </div>
</section>