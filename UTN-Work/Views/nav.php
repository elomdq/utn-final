<!-- <div id="wrapper"> -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light fixed-top bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item no-arrow mx-1">
                <a class="nav-link" href="<?php echo FRONT_ROOT . "Company/listCompanies"; ?>" id="companies" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Empresas</span>
                </a>
            </li>

            <li class="nav-item no-arrow mx-1">
                <a class="nav-link" href="<?php echo FRONT_ROOT . "Offer/showOffersList"; ?>" id="offers" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Ofertas Laborales</span>
                </a>
            </li>

            <!--
            <li class="nav-item no-arrow mx-1">
                <a class="nav-link" href="<?php echo FRONT_ROOT . "Home/logout"; ?>" id="session" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Cerrar Sesión</span>
                </a>
            </li>
            -->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $_SESSION['loggedUser']->getFirstName() . " " . $_SESSION['loggedUser']->getLastName(); ?></span>
                    <!-- <img class="img-profile rounded-circle" src="img/undraw_profile.svg"> -->
                </a>
                
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Profile/showProfile"; ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Perfil
                    </a>

                    <?php if($_SESSION['userType'] == 0) {?>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Estado Academico
                    </a>
                    <?php } ?>

                    <?php if($_SESSION['userType'] == 1) {?>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Company/addView"; ?>">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Agregar Empresa
                        </a>
                    <?php } ?>
                    
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT . "home/logout"; ?>" >
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar Sesion
                    </a>

                </div>
            </li>

        </ul>
    </nav>

</div>

<!-- </div> -->