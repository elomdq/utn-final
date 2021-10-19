<?php

use Models\Company as Company;
use DAO\CompanyDAO as CompanyDAO;

$companyDAO = new CompanyDAO;


?>

<div class="container">
    <!-- Content Row -->
    <div class="row justify-content-center">

        <?php foreach ($companyDAO->getAll() as $company) { ?>
            <!-- Earnings (Monthly) Card Example -->
            <!-- <a class="col-xl-8 col-md-8" href="#"> -->
            <div class="col-8  mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-2">
                                    <?php echo $company->getCompanyName(); ?></div>
                                <!-- <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                    <?php #echo $company->getDescription(); ?></div> -->
                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> -->
                            </div>
                            <div class="col-auto">
                               <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                            </div>
                        </div>
                        <a href="<?php #echo FRONT_ROOT . "company/showCompanyDetails/" . $company->getUserId(); ?>" class="stretched-link"> ver más </a>
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
            <?php if($_SESSION['userType'] == 1){ ?> <th>Delete</th> <?php } ?>
        </thead>
        <tbody>
            <?php
            if (isset($this->companiesList)) {
                foreach ($this->companiesList as $company) {
            ?>
                    <tr>
                        <td><?php echo $company->getCompanyName(); ?></td>
                        <td><?php echo $company->getTelephone(); ?></td>
                        <td><?php echo $company->getCity(); ?></td>
                        <td><?php echo $company->getDirection(); ?></td>
                        <td><?php echo $company->getCuit(); ?></td>
                        <td><?php echo $company->getEmail(); ?></td>
                        <?php if($_SESSION['userType'] == 1){ ?> <td><input type="checkbox" name="active" class="form-control" min="0"></td> <?php } ?>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
-->