<?php 

namespace Views;

use Models\Company as Company;

$company = null;

if(isset($_SESSION['company'])){
    $company = $_SESSION['company'];
    unset($_SESSION['company']);
}

?>

<div class="row justify-content-center">
    <div class="col-6">
        <div class="card shadow mb-4">

            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $company->getCompanyName(); ?></h6>
              
                <?php if($_SESSION['userType'] == 1) {?>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "company/editCompany/" . $company->getIdCompany(); ?>">Editar</a>
                    </div>
                </div>
                <?php } ?>
                
            </div>

            <!-- Card Body -->
            <div class="row card-body justify-content-center py-2">
                <div class="col-10 m-3">
                    <div>Telefono: <?php echo $company->getTelephone(); ?></div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Localidad: <?php echo $company->getCity() ?> </div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Direccion: <?php echo $company->getAddress() ?></div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>CUIT: <?php echo $company->getCuit() ?> </div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Email: <?php echo $company->getEmail() ?> </div>
                </div>
                <?php if($_SESSION['userType'] == 1){ ?>
                    <hr class="col-10 m-0">
                    <div class="col-10 m-3">
                        <div>Active: <?php echo $company->getActive(); ?> </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>