<div class="row justify-content-center">
    <div class="col-5">
        <div class="card shadow mb-4">

            <!-- Card Body -->
            <div class="row card-body .flex-column justify-content-center py-5 " >
                <h1 class="col-12 text-center mb-4">WELCOME!</h1>
                <div class="">
                    <?php if ($_SESSION['userType'] == 0) { ?>
                        <h3 class=""> <?php echo $_SESSION['loggedUser']->getFirstName() . " " . $_SESSION['loggedUser']->getLastName(); ?> </h3>
                    <?php } else if ($_SESSION['userType'] == 1) { ?>
                        <h3 class="text-center mb-4"> Admin </h3>
                        <h3 class="text-center"> You Have The Power </h3>
                    <?php } else { ?>
                        <h3 class=""> <?php echo $_SESSION['loggedUser']->getCompanyName(); ?> </h3>
                    <?php } ?>
                </div>

            </div>

        </div>
    </div>
</div>