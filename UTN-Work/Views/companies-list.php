<section class="company-list">
    <!-- Contenedor -->
    <div class="container mt-5">
    <div class="alert alert-<?php if ($alert != null) echo $alert->getType(); ?> col-8 mx-auto" role="alert"> <?php if ($alert != null) echo $alert->getMessage(); ?> </div>
        <!-- Content Row -->
        <div class="row justify-content-center">

            <!-- Topbar Search -->

            <div class="row justify-content-center">

                <form class="my-3 mb-4 col-8 navbar-search" action="<?php echo FRONT_ROOT . "Company/listCompanies"; ?>" method="post">

                    <div class="input-group">
                        <input type="search" class="form-control bg-light border-1" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" name="searchKey">

                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                            <script>

                            </script>
                        </button>

                    </div>
                </form>

            </div>


            <!-- Lista de Empresas -->
            <?php foreach ($companiesList as $company) { ?>

                <div class="row justify-content-center">

                    <div class="col-8  mb-3">
                        <div class="card border-left-primary shadow h-100 py-1">
                            <div class="card-body py-2">

                                <div class="row no-gutters align-items-center">

                                    <div class="col-10 mr-2">
                                        <div class="text-md font-weight-bold text-primary text-uppercase">
                                            <?php echo $company->getCompanyName(); ?>
                                        </div>
                                        <?php if ($_SESSION['userType'] == 1) { ?>
                                            <a href="<?php echo FRONT_ROOT . "company/showCompanyDetails/" . $company->getIdCompany(); ?>" class="stretched-link"></a>
                                        <?php } ?>
                                    </div>

                                    <?php if ($_SESSION['userType'] == 1) { ?>
                                        <div class="col-2 d-flex justify-content-end">
                                            <a href="<?php echo FRONT_ROOT . "company/editCompany/" . $company->getIdCompany(); ?>" class="mx-2 z-index-up"><i class="fas fa-pencil-alt fa-1x"></i></a>
                                            <a href="<?php echo FRONT_ROOT . "company/deleteCompany/" . $company->getIdCompany(); ?>" class="mx-2 z-index-up"><i class="far fa-trash-alt fa-1x"></i></a>
                                        </div>
                                    <?php } ?>

                                    <?php if ($_SESSION['userType'] != 1) { ?>
                                        <a href="<?php echo FRONT_ROOT . "company/showCompanyDetails/" . $company->getIdCompany(); ?>" class="stretched-link"> ver más </a>
                                    <?php } ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</section>