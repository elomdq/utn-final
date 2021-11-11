<?php
namespace Views;

$user = $_SESSION['loggedUser'];

?>

<div class="row justify-content-center">
    <div class="col-6">
        <div class="card shadow mb-4">

            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $user->getCompanyName()?></h6>
            </div>

            <!-- Card Body -->
            <div class="row card-body justify-content-center py-2">
                <div class="col-10 m-3">
                    <!-- le estoy pegando a la api ara obtener la descripcion de la carrera, mejorar eso -->
                    <div>Adress: <?php echo $user->getAddress(); ?></div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>City: <?php echo $user->getCity() ?> </div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>CUIT: <?php echo $user->getCuit() ?></div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Email: <?php echo $user->getEmail() ?> </div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Telefono: <?php echo $user->getTelephone() ?> </div>
                </div>
            </div>
        </div>
    </div>
</div>