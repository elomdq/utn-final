<!-- Contenedor -->
<div class="container">
    
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
                            <div class="alert alert-<?php if($alert!=null) echo $alert->getType();?>" role="alert"> <?php if($alert!=null) echo $alert->getMessage(); ?> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </a> -->
        <?php } ?>