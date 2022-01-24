<header id="content-wrapper" class="d-flex flex-column">


    <nav class="navbar navbar-expand navbar-light fixed-top mb-4 static-top bg-white shadow topbar px-4">

        <a class="navbar-brand ml-3" href="<?php echo FRONT_ROOT . "home/showHome/"; ?>">
            <img class="ml-2" src="<?php echo FRONT_ROOT . VIEWS_PATH; ?>assets/utn.png" width="" height="75" alt="logo UTN">
        </a>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ms-auto">

            <?php if ($_SESSION['userType'] != 2) { ?>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . "Company/listCompanies"; ?>" id="companies" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Empresas</span>
                    </a>
                </li>
            <?php } ?>

            <li class="nav-item mx-1">
                <a class="nav-link" href="<?php echo FRONT_ROOT . "Offer/showOffersList"; ?>" id="offers" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Ofertas Laborales</span>
                </a>
            </li>

            <li class="nav-item mx-1">
                <a class="nav-link" href="<?php echo FRONT_ROOT . "Home/showHome"; ?>" id="offers" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Home</span>
                </a>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Dropdown -->
            <li class="nav-item dropdown no-arrow">

                <!-- Activador del dropdownmenu-->
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $_SESSION['loggedUser']->getEmail(); ?></span>
                </a>

                <!-- Dropdown menu -->
                <div class="dropdown-menu shadow dropdown-menu-end" aria-labelledby="userDropdown">

                    <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Profile/showProfile"; ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Perfil
                    </a>

                    <?php if ($_SESSION['userType'] == 0) { ?>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Estado Academico
                        </a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Student/historicOfferApplications/" . $_SESSION['loggedUser']->getStudentId(); ?>">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Historial de Postulaciones
                        </a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "File/addView"; ?>">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Subir CV
                        </a>
                    <?php } ?>

                    <?php if ($_SESSION['userType'] == 1) { ?>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Company/addView"; ?>">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Agregar Empresa
                        </a>
                    <?php } ?>

                    <?php if ($_SESSION['userType'] != 0) { ?>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Offer/addView"; ?>">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Agregar Oferta
                        </a>
                    <?php } ?>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="<?php echo FRONT_ROOT . "home/logout"; ?>">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar Sesion
                    </a>

                </div>
            </li>

        </ul>
    </nav>


</header>