<?php

use Models\Company as Company;
use DAO\CompanyDAO as CompanyDAO;

$companyDAO = new CompanyDAO;
$companiesList = array();

//Chequeo si hay una key de busqueda antes de cagar la lista
if(isset($_GET['searchKey']) && $_GET['searchKey']!= null)
{
    foreach($companyDAO->getAll() as $company)
    {
        if(stristr($company->getCompanyName(), $_GET['searchKey']))
        {
            array_push($companiesList, $company); 
        }
    }
    unset($_SESSION['searchKey']);
} else
{
    if($_SESSION['userType'] != 1)
    {
        foreach($companyDAO->getAll() as $company)
        {
            if($company->getActive()){
                array_push($companiesList, $company);
            }
        }
    }
    else
    {
        $companiesList = $companyDAO->getAll();
    }

    
}


?>

<!-- Contenedor -->
<div class="container">
    
<!-- Content Row -->
    <div class="row justify-content-center">
    
        <!-- Topbar Search -->
        <form class="my-3 mb-4 col-8 navbar-search" action=" <?php echo FRONT_ROOT . "Company/listCompanies"; ?> " method="get">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-1" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" name="searchKey">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                        <script>

                        </script>
                    </button>
                </div>
            </div>
        </form>

        <!-- List of Companies -->
        <?php foreach ($companiesList as $company) { ?>
            <!-- <a class="col-xl-8 col-md-8" href="#"> -->
            <div class="col-8  mb-3">
                <div class="card border-left-primary shadow h-100 py-1">
                    <div class="card-body py-2">
                        <div class="row no-gutters align-items-center">
                            
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase">
                                    <?php echo $company->getCompanyName(); ?>
                                </div>
                                <?php if($_SESSION['userType']==1){ ?>
                                    <a href="<?php echo FRONT_ROOT . "company/showCompanyDetails/" . $company->getIdCompany(); ?>" class="stretched-link"></a>        
                                <?php } ?>
                            </div>

                            <?php if($_SESSION['userType'] != 1) { ?>
                            <a href="<?php echo FRONT_ROOT . "company/showCompanyDetails/" . $company->getIdCompany(); ?>" class="stretched-link"> ver más </a>
                            <?php } ?>
                            <!-- <a href="<?php echo FRONT_ROOT . "company/showCompanyDetails/" . $company->getIdCompany(); ?>" class="<?php if($_SESSION['userType'] != 1) { echo "stretched-link" ; } ?> "> ver más </a> -->
                           
                            <?php if ($_SESSION['userType'] == 1) { ?>
                            <a href="<?php echo FRONT_ROOT . "company/editCompany/" . $company->getIdCompany(); ?>" class="mx-2"><i class="fas fa-pencil-alt fa-2x text-blue-400"></i></a>
                            <!-- <a href=" <?php echo FRONT_ROOT . "company/deleteCompany/" . $company->getIdCompany(); ?> " class="mx-2"><i class="far fa-trash-alt fa-2x  text-red-400"></i></a> -->
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </a> -->
        <?php } ?>

        <!--
<div class="container">
    <h2 class="mb-4">Compañias Disponibles</h2>
    <table class="table bg-light-alpha">
        <thead>
            <th>Empresa</th>
            <th>Tel.</th>
            <th>Ciudad</th>
            <th>Direccion</th>
            <th>CUIT</th>
            <th>Email</th>
            <?php if ($_SESSION['userType'] == 1) { ?> <th>Delete</th> <?php } ?>
        </thead>
        <tbody>
            <?php
            if (isset($this->companiesList)) {
                foreach ($this->companiesList as $company) {?>
                    <tr>
                        <td><?php echo $company->getCompanyName(); ?></td>
                        <td><?php echo $company->getTelephone(); ?></td>
                        <td><?php echo $company->getCity(); ?></td>
                        <td><?php echo $company->getAddress(); ?></td>
                        <td><?php echo $company->getCuit(); ?></td>
                        <td><?php echo $company->getEmail(); ?></td>
                        <?php if ($_SESSION['userType'] == 1) { ?> <td><input type="checkbox" name="active" class="form-control" min="0"></td> <?php } ?>
                    </tr>
            <?php
                }
            }?>
        </tbody>
    </table>
</div>
-->