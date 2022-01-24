<!-- Contenedor -->
<div class="container">

    <div class="alert alert-<?php if ($alert != null) echo $alert->getType(); ?> col-6 mx-auto" role="alert"> <?php if ($alert != null) echo $alert->getMessage(); ?> </div>

   
    <div class="row justify-content-center">

       
        <?php foreach ($students as $student) { ?>
           
            <div class="col-8  mb-3">
                <div class="card border-left-primary shadow">
                    <div class="card-body py-2">
                        <div class="row align-items-center">

                            <div class="col-5 mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase">
                                    <?php echo $student->getFirstName() . " " . $student->getLastName(); ?>
                                </div>
                            </div>

                            <div class="col-5 mr-2">
                                <div class="text-md font-weight-bold text-primary">
                                    <p class="strong d-inline">Email : </p>
                                    <p class="small m-0 d-inline"><?php echo $student->getEmail(); ?></p>
                                </div>
                            </div>

                            <?php if ($_SESSION['userType'] == 1) { ?>
                                <div class="col-2 dropdown no-arrow">
                                    <a class="dropdown-toggle float-end" href="#" role="button" id="applicantMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="applicantMenu">
                                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "offer/declineApplicant/" . $offerId . "/" . $student->getStudentId(); ?>">Declinar</a>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
           
        <?php } ?>
    </div>
</div>