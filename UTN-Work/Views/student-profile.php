<?php
namespace Views;

use DAO\CareerDAO as CareerDAO;

$careerDAO = new CareerDAO;
$user = $_SESSION['loggedUser'];

?>

<div class="row justify-content-center">
    <div class="col-6">
        <div class="card shadow mb-4">

            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $user->getFirstName() . " " . $user->getLastName(); ?></h6>
            </div>

            <!-- Card Body -->
            <div class="row card-body justify-content-center py-2">
                <div class="col-10 m-3">
                    <!-- le estoy pegando a la api ara obtener la descripcion de la carrera, mejorar eso -->
                    <div>Carrera: <?php echo $careerDAO->getCareerById_Api($user->getCareerId())->getDescription(); ?></div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>DNI: <?php echo $user->getDni() ?> </div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Telefono: <?php echo $user->getPhoneNumber() ?></div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Email: <?php echo $user->getEmail() ?> </div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Genero: <?php echo $user->getGender() ?> </div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Fecha de Nacimiento: <?php echo str_split($user->getBirthDate(),10)[0] ?> </div>
                </div>
            </div>

        </div>
    </div>
</div>