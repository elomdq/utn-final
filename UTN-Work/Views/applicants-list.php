<!-- Contenedor -->
<div class="container">
    
<div class="alert alert-<?php if($alert!=null) echo $alert->getType();?> col-6 mx-auto" role="alert"> <?php if($alert!=null) echo $alert->getMessage(); ?> </div>
    
<!-- Content Row -->
    <div class="row justify-content-center">
    
        <!-- List of Companies -->
        <?php foreach ($students as $student) { ?>
            <!-- <a class="col-xl-8 col-md-8" href="#"> -->
            <div class="col-8  mb-3">
                <div class="card border-left-primary shadow h-100 py-1">
                    <div class="card-body py-2">
                        <div class="row no-gutters align-items-center">
                            
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase">
                                    <?php echo $student->getFirstName() ." " . $student->getLastName(); ?>
                                </div>
                            </div>
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase">
                                    <h6 class="d-inline">Email: </h6> <h6 class="m-0"><?php echo $student->getEmail(); ?></h6>
                                </div>
                            </div>

                            <?php if($_SESSION['userType'] == 1) {?>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="applicantMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="applicantMenu">
                                    <a class="dropdown-item" href="<?php echo FRONT_ROOT . "offer/declineApplicant/". $offerId."/" .$student->getStudentId(); ?>">Declinar</a>
                                </div>
                            </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- </a> -->
        <?php } ?>
    </div>
</div>