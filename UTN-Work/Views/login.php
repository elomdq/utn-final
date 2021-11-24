<section id="login">

    <div class="row justify-content-center">

        <div class="card col-5 o-hidden border-0 shadow-lg my-3">

            <div class="card-body px-4 py-4 row justify-content-center">

                <div class="col-12 text-center">
                    <img class="" src="<?php echo FRONT_ROOT . VIEWS_PATH . "assets/utn.png"; ?>" height="80">
                </div>

                <div class="col-12 px-2 py-3">

                        <form class="user" action="<?php echo FRONT_ROOT ?>Home/login" method="post">

                            <div class="form-group col-12 py-2">
                                <label for="inputEmail">Email</label>
                                <input name="email" type="email" class="form-control form-control-user" id="inputEmail" aria-describedby="emailHelp" required>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <label for="loginPassword">Password</label>
                                <input type="password" class="form-control form-control-user" id="loginPassword" name="password" required>
                            </div>

                            <div class="alert alert-<?php if ($alert != null) echo $alert->getType(); ?>" role="alert" <?php if ($alert == null) echo " style=\"display:none;\""; ?> > <?php if ($alert != null) echo $alert->getMessage(); ?> </div>

                            <div class="col-12 pt-4 d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                            </div>

                        </form>

                        <div class="text-center mt-3 mb-0">
                            <a class="small" href="<?php echo FRONT_ROOT . "home/checkEmail" ?>">Registrarse</a>
                        </div>

                </div>
            </div>
        </div>
    </div>

</section>