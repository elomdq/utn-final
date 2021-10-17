<?php

use Models\Company as Company;
use DAO\CompanyDAO as CompanyDAO;

$companyDAO = new CompanyDAO;

/*$company1 = new Company;

    $company1->setUserId(300);
    $company1->setCompanyName("Globant");
    $company1->setTelephone("+54 2236480548");
    $company1->setCity("Mar del Plata");
    $company1->setDirection("Colon 400");
    $company1->setCuit("20-3568479-8");
    $company1->setEmail("globant@gmail.com");
    $company1->setActive(true);

    $companyDAO->add($company1);*/

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
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="<?php #echo FRONT_ROOT . "company/showCompanyDetails/" . $company->getUserId(); ?>" class="stretched-link"> ver más </a>
                    </div>
                </div>
            </div>
            <!-- </a> -->
        <?php } ?>

    </div>
</div>